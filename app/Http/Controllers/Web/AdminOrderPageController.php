<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;

class AdminOrderPageController extends Controller
{
    // Hiển thị danh sách đơn hàng
    public function index(Request $request)
    {
        $token = session('token');
        $page = $request->query('page', 1);

        // Gọi API backend thật
        $response = Http::withToken($token)
                        ->get(env('API_URL') . '/admin/orders?page=' . $page);

        if ($response->successful()) {
            $json = $response->json();
            $data = $json['data'] ?? [];
            $pagination = $json['pagination'] ?? [];

            // Ép từng item thành object và parse Carbon cho created_at
            $ordersArray = array_map(function ($item) {
                $obj = json_decode(json_encode($item));

                if (isset($obj->created_at)) {
                    try {
                        $obj->created_at = Carbon::parse($obj->created_at);
                    } catch (\Exception $e) {
                        // Nếu lỗi parse, giữ nguyên chuỗi
                    }
                }

                return $obj;
            }, $data);

            // Giữ phân trang Laravel
            $orders = new LengthAwarePaginator(
                $ordersArray,
                $pagination['total'] ?? count($data),
                $pagination['per_page'] ?? 8,
                $pagination['current_page'] ?? 1,
                [
                    'path'  => $request->url(),
                    'query' => $request->query(),
                ]
            );

            return view('admin.orders', compact('orders'));
        }

        return back()->with('error', 'Không thể tải danh sách đơn hàng!');
    }

    // Trang sửa đơn hàng
    public function edit($id)
    {
        $order = Order::with(['user', 'items.product'])->findOrFail($id);
        return view('admin.orders_edit', compact('order'));
    }

    // Cập nhật trạng thái đơn hàng
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update([
            'status' => $request->input('status')
        ]);

        return redirect()->route('admin.orders')->with('success', 'Cập nhật đơn hàng thành công!');
    }

    // Xóa đơn hàng
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders')->with('success', 'Đã xóa đơn hàng!');
    }
}