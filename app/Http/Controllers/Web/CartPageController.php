<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
class CartPageController extends Controller
{
    public function index()
{
    $token = session('token');
    $response = Http::withToken($token)->get(env('API_URL') . '/cart');

    $data = $response->successful() ? $response->json() : [];

    // Ép dữ liệu về array chuẩn
    $items = $data['items'] ?? [];
    $total = 0;
    $cartCount = 0;

    foreach ($items as $item) {
        if (isset($item['product'])) {
            $total += ($item['product']['price'] ?? 0) * ($item['quantity'] ?? 0);
            $cartCount += $item['quantity'] ?? 0;
        }
    }

    // Lưu vào session để dùng trên navbar
    session(['cartCount' => $cartCount]);

    return view('cart', compact('items', 'total'));
}



    public function add(Request $request, $id)
    {
        $token = session('token');
        if (!$token) {
            return redirect('/login')->with('error', 'Vui lòng đăng nhập');
        }

        Http::withToken($token)->post(env('API_URL') . '/cart/add', [
            'product_id' => $id,
            'quantity'   => $request->quantity ?? 1
        ]);

        return redirect('/cart')->with('success', 'Đã thêm vào giỏ hàng');
    }

    public function remove($id)
    {
        $token = session('token');
        Http::withToken($token)->delete(env('API_URL') . "/cart/remove/$id");

        return redirect('/cart')->with('success', 'Đã xóa sản phẩm');
    }

    public function update(Request $request, $id)
{
    $token = session('token');
    Http::withToken($token)->put(env('API_URL') . "/cart/update/$id", [
        'quantity' => max(1, (int)$request->quantity)
    ]);

    return redirect('/cart')->with('success', 'Số lượng đã được cập nhật');
}

public function checkout(Request $request)
{
    $request->validate([
        'address' => 'required|string|max:255'
    ], [
        'address.required' => 'Vui lòng nhập địa chỉ nhận hàng'
    ]);

    $token = Session::get('token');

    $response = Http::withToken($token)->post(env('API_URL') . '/cart/checkout', [
        'address' => $request->address
    ]);

    if ($response->successful() && $response['success']) {
        return redirect()->route('cart.index')->with('success', 'Thanh toán thành công! Đơn hàng đã được tạo.');
    }

    return redirect()->back()->withErrors([
        'address' => $response['message'] ?? 'Thanh toán thất bại'
    ]);
}



}
