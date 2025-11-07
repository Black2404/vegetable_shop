<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    // Lấy giỏ hàng của user
    public function index(Request $request)
    {
        $cart = Cart::firstOrCreate(['user_id' => $request->user()->id]);

        $items = $cart->items()->with('product')->get();

        return response()->json([
            'cart_id' => $cart->id,
            'items' => $items
        ]);
    }

    // Thêm sản phẩm vào giỏ
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1'
        ]);

        $cart = Cart::firstOrCreate(['user_id' => $request->user()->id]);

        $item = CartItem::where('cart_id', $cart->id)
                        ->where('product_id', $request->product_id)
                        ->first();

        if ($item) {
            $item->quantity += $request->quantity;
            $item->save();
        } else {
            $item = CartItem::create([
                'cart_id'    => $cart->id,
                'product_id' => $request->product_id,
                'quantity'   => $request->quantity
            ]);
        }

        return response()->json(['message' => 'Đã thêm vào giỏ hàng', 'item' => $item]);
    }

    // Cập nhật số lượng
    public function updateItem(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $item = CartItem::findOrFail($id);
        $item->update(['quantity' => $request->quantity]);

        return response()->json(['message' => 'Đã cập nhật số lượng', 'item' => $item]);
    }

    // Xóa sản phẩm khỏi giỏ
    public function remove($id)
    {
        $item = CartItem::findOrFail($id);
        $item->delete();

        return response()->json(['message' => 'Đã xóa sản phẩm khỏi giỏ']);
    }

    // Thanh toán
    public function checkout(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'address' => 'required|string|max:255'
    ], [
        'address.required' => 'Vui lòng nhập địa chỉ nhận hàng'
    ]);

        // Lấy giỏ hàng
    $cart = Cart::with('items.product')->where('user_id', $user->id)->first();

    if (!$cart || $cart->items->isEmpty()) {
        return response()->json([
            'success' => false,
            'message' => 'Giỏ hàng trống'
        ], 400);
    }

    DB::beginTransaction();
    try {
        $total = $cart->items->sum(fn($i) => $i->quantity * $i->product->price);

        // Tạo order
        $order = Order::create([
            'user_id' => $user->id,
            'address' => $request->address,
            'total'   => $total,
            'status'  => 'Đang xử lý'
        ]);

        // Tạo order items
        foreach ($cart->items as $cartItem) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity'   => $cartItem->quantity,
                'price'      => $cartItem->product->price,
            ]);
        }

        // Xóa giỏ hàng sau khi checkout
        $cart->items()->delete();
        $cart->delete();

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Thanh toán thành công',
            'order'   => $order->load('items.product')
        ]);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'success' => false,
            'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
        ], 500);
    }
}

}
