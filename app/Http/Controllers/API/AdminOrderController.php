<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    // Lấy danh sách đơn hàng (JSON)
    public function index()
    {
        $orders = Order::with(['user', 'items.product'])
                        ->orderBy('created_at', 'desc')
                        ->get();

        return response()->json($orders);
    }

    // Xem chi tiết đơn hàng
    public function show($id)
    {
        $order = Order::with(['user', 'items.product'])->findOrFail($id);
        return response()->json($order);
    }

    // Cập nhật trạng thái đơn hàng
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => $request->input('status')]);
        return response()->json(['message' => 'Cập nhật thành công']);
    }

    // Xóa đơn hàng
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return response()->json(['message' => 'Đã xóa đơn hàng']);
    }
}
