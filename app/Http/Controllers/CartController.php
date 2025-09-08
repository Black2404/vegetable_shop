<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;

class CartController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login');
        }

        $cart = Cart::with('items.product')->where('user_id', $user->id)->first();

        return view('cart', [
            'cart' => $cart
        ]);
    }


    public function add(Request $request, $productId)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login');
        }

        $quantity = $request->input('quantity', 1);

        // Tìm hoặc tạo giỏ hàng
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        // Tìm xem sản phẩm đã có trong giỏ chưa
        $item = CartItem::where('cart_id', $cart->id)
                        ->where('product_id', $productId)
                        ->first();

        if ($item) {
            $item->quantity += $quantity;
            $item->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Đã thêm vào giỏ hàng!');
    }



    public function showCart()
    {
        $cart = [];

        if (Auth::check()) {
            $items = CartItem::with('product')->where('user_id', Auth::id())->get();
            foreach ($items as $item) {
                $cart[$item->product_id] = [
                    'name' => $item->product->name,
                    'price' => $item->product->price,
                    'image' => $item->product->image,
                    'quantity' => $item->quantity,
                ];
            }
        } else {
            $cart = session('cart', []);
        }

        return view('cart.index', compact('cart'));
    }

    public function update(Request $request)
    {
        $quantities = $request->input('quantities', []);

        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();
            if ($cart) {
                foreach ($quantities as $productId => $qty) {
                    CartItem::where('cart_id', $cart->id)
                            ->where('product_id', $productId)
                            ->update(['quantity' => $qty]);
                }
            }
        } else {
            $cart = session()->get('cart', []);
            foreach ($quantities as $productId => $qty) {
                if (isset($cart[$productId])) {
                    $cart[$productId]['quantity'] = $qty;
                }
            }
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Cập nhật thành công!');
    }


    public function remove($productId)
    {
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();
            if ($cart) {
                CartItem::where('cart_id', $cart->id)
                        ->where('product_id', $productId)
                        ->delete();
            }
        } else {
            $cart = session()->get('cart', []);
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng');
    }

    public function checkout(Request $request)
{
    $request->validate([
        'address' => 'required|string|max:255',
    ]);

    $user = Auth::user();
    $cart = Cart::with('items.product')->where('user_id', $user->id)->first();

    if (!$cart || $cart->items->count() == 0) {
        return redirect()->back()->with('error', 'Giỏ hàng trống!');
    }

    $order = new Order();
    $order->user_id = $user->id;
    $order->total = $request->total;
    $order->address = $request->address;
    $order->status = 'Đã thanh toán';
    $order->save();

    foreach ($cart->items as $item) {
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $item->product->id,
            'quantity' => $item->quantity,
            'price' => $item->product->price,
        ]);
    }

    $cart->items()->delete();

    return redirect()->route('payment.success');
}

public function paymentSuccess()
{
    return view('payment_success');
}


}
