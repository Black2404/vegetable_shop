<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class AdminOrderPageController extends Controller
{
    // Hiển thị danh sách đơn hàng
    public function index()
    {
        $orders = Order::with(['user', 'items.product'])
                        ->orderBy('created_at', 'desc')
                        ->paginate(8);

        return view('admin.orders', compact('orders'));
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