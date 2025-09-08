<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class ChatbotController extends Controller
{
    public function chat(Request $request)
    {
        $message = trim($request->input('message'));
        $msgLower = mb_strtolower($message);

        // Nếu user xác nhận "có" hoặc "xem chi tiết"
        if (in_array($msgLower, ['có', 'ok', 'yes', 'ừ', 'xem chi tiết'])) {
            $lastProductId = session('last_product_id');
            if ($lastProductId) {
                $product = DB::table('products')->find($lastProductId);
                if ($product) {
                    return response()->json([
                        'reply' => "Chi tiết sản phẩm <b>{$product->name}</b>:<br>
                                    {$product->description}<br>
                                    Giá: " . number_format($product->price, 0) . " VNĐ."
                    ]);
                }
            }
        }

        // Bước 1: Rule-based check trước
        if ($this->isProductQuestion($message)) {
            $ruleReply = $this->handleProductQuery($message);
            if ($ruleReply) {
                return $ruleReply;
            }
        }

        // Bước 2: Nếu rule không tìm thấy → nhờ Gemini extract keyword
        $keyword = $this->extractKeyword($message);

        if ($keyword !== "unknown") {
            $product = DB::table('products')
                ->where('name', 'LIKE', '%' . $keyword . '%')
                ->first();

            if ($product) {
                // Lưu context
                session(['last_product_id' => $product->id]);

                return response()->json([
                    'reply' => "Có phải bạn đang quan tâm tới <b>{$product->name}</b>?<br>
                                Giá: " . number_format($product->price, 0) . " VNĐ.<br>
                                Bạn muốn xem chi tiết/công dụng không?"
                ]);
            }
        }

        // Bước 3: Nếu vẫn không có → để Gemini trả lời tự do
        return $this->askGemini($message);
    }

    private function isProductQuestion($message)
    {
        $keywords = ['sản phẩm', 'giá', 'bao nhiêu', 'còn hàng', 'loại', 'công dụng', 'xem chi tiết', 'thông tin', 'danh sách'];
        foreach ($keywords as $word) {
            if (stripos($message, $word) !== false) {
                return true;
            }
        }

        $exists = DB::table('products')->where('name', 'LIKE', '%' . $message . '%')->exists();
        return $exists;
    }

    private function handleProductQuery($message)
    {
        $msg = mb_strtolower(trim($message));

        // 1. Tổng số sản phẩm
        if (str_contains($msg, 'bao nhiêu sản phẩm') || str_contains($msg, 'tổng sản phẩm')) {
            $count = DB::table('products')->count();
            return response()->json(['reply' => "Hiện tại cửa hàng có $count sản phẩm."]);
        }

        // 2. Danh sách sản phẩm
        if (str_contains($msg, 'danh sách sản phẩm') || str_contains($msg, 'có những sản phẩm nào')) {
            $products = DB::table('products')->pluck('name')->toArray();
            if ($products) {
                return response()->json(['reply' => "Danh sách sản phẩm:<br>" . implode("<br>", $products)]);
            }
            return response()->json(['reply' => "Hiện tại chưa có sản phẩm nào."]);
        }

        // 3. Giá sản phẩm
        if (str_contains($msg, 'giá') || str_contains($msg, 'bao nhiêu tiền') || str_contains($msg, 'mấy tiền')) {
            $keyword = trim(str_ireplace(['giá', 'bao nhiêu tiền', 'mấy tiền'], '', $msg));
            if ($keyword) {
                $products = DB::table('products')->where('name', 'LIKE', "%$keyword%")->get();
                if ($products->count()) {
                    $reply = "Giá sản phẩm:<br>";
                    foreach ($products as $p) {
                        $reply .= "{$p->name}: " . number_format($p->price, 0) . " VNĐ<br>";
                    }
                    return response()->json(['reply' => $reply]);
                }
            }
        }

        // 4. Công dụng/thông tin
        if (str_contains($msg, 'công dụng') || str_contains($msg, 'xem chi tiết') || str_contains($msg, 'thông tin')) {
            $keyword = trim(str_ireplace(['công dụng', 'xem chi tiết', 'thông tin'], '', $msg));
            if ($keyword) {
                $products = DB::table('products')->where('name', 'LIKE', "%$keyword%")->get();
                if ($products->count()) {
                    $reply = "Thông tin sản phẩm:<br>";
                    foreach ($products as $p) {
                        $reply .= "<b>{$p->name}</b>: {$p->description}<br>";
                        // lưu sản phẩm cuối cùng vào session
                        session(['last_product_id' => $p->id]);
                    }
                    return response()->json(['reply' => $reply]);
                }
            }
        }

        // 5. Người dùng chỉ gõ tên sản phẩm
        $product = DB::table('products')->where('name', 'LIKE', "%$msg%")->first();
        if ($product) {
            session(['last_product_id' => $product->id]);
            return response()->json([
                'reply' => "Bạn muốn xem chi tiết sản phẩm <b>{$product->name}</b> không?"
            ]);
        }

        return null;
    }

    private function extractKeyword($message)
    {
        try {
            $res = Http::post(
                "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=" . env("GEMINI_API_KEY"),
                [
                    "contents" => [[
                        "parts" => [[
                            "text" => "Đọc câu hỏi: \"$message\"\n
                            Trích duy nhất tên sản phẩm chính (1-2 từ).\n
                            Nếu không thấy sản phẩm thì trả lời: unknown."
                        ]]
                    ]]
                ]
            );

            $data = $res->json();
            $keyword = strtolower(trim($data["candidates"][0]["content"]["parts"][0]["text"] ?? "unknown"));
            return $keyword;
        } catch (\Exception $e) {
            return "unknown";
        }
    }

    private function askGemini($message)
    {
        try {
            $res = Http::post(
                "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=" . env("GEMINI_API_KEY"),
                [
                    "contents" => [[
                        "parts" => [[ "text" => $message ]]
                    ]]
                ]
            );

            $data = $res->json();
            $reply = $data["candidates"][0]["content"]["parts"][0]["text"] ?? "Xin lỗi, tôi chưa hiểu.";
            return response()->json(['reply' => $reply]);
        } catch (\Exception $e) {
            return response()->json(['reply' => "Lỗi gọi Gemini: " . $e->getMessage()]);
        }
    }
}
