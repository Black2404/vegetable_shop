<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class AdminController extends Controller
{
    // Trang dashboard
    public function index()
    {
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total');
        $totalProducts = Product::count();
        $totalUsers = User::where('role', 'user')->count();

        return view('admin.dashboard', compact(
            'totalOrders', 'totalRevenue', 'totalProducts', 'totalUsers'
        ));
    }

    // Danh sách người dùng
    public function users()
    {
        $users = User::paginate(6);
        return view('admin.users', compact('users'));
    }

    // Thêm người dùng
    public function storeUser(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'address'  => 'nullable|string',
            'password' => 'required|min:6',
            'role'     => 'nullable|string' 
        ]);

        $data['password'] = bcrypt($data['password']);
        User::create($data);

        return back()->with('success', 'Thêm người dùng thành công');
    }

    // Form chỉnh sửa người dùng
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users_edit', compact('user'));
    }

    // Cập nhật người dùng
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email,'.$user->id,
            'address'  => 'nullable|string',
            'password' => 'nullable|min:6',
            'role'     => 'nullable|string'
        ]);

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('admin.users')->with('success', 'Cập nhật thành công');
    }

    // Xóa người dùng
    public function deleteUser($id)
    {
        User::destroy($id);
        return back()->with('success', 'Xóa người dùng thành công');
    }

    // Trang danh sách sản phẩm
    public function products()
    {
        $products = Product::paginate(3);
        return view('admin.products', compact('products'));
    }

    // Thêm sản phẩm
    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            // Tạo tên file duy nhất
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            // Lưu file vào public/images
            $request->file('image')->move(public_path('images'), $imageName);
        }

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imageName, // chỉ lưu tên file
        ]);

        return redirect()->route('admin.products')->with('success', 'Thêm sản phẩm thành công');
    }


    // Sửa sản phẩm
    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products_edit', compact('product'));
    }

    // Cập nhật sản phẩm
    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.products')->with('success', 'Cập nhật sản phẩm thành công');
    }

    // Xóa sản phẩm
    public function deleteProduct($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->route('admin.products')->with('success', 'Xóa sản phẩm thành công');
    }

    // Quản lý đơn hàng
    public function orders()
    {
        $orders = Order::with('user')->latest()->get();
        $orders = Order::with('items.product')->get();
        $orders = Order::paginate(9);
        return view('admin.orders', compact('orders'));
    }

    // Chỉnh sửa đơn hàng 
    public function editOrder(Order $order)
    {
        $order->load(['user', 'items.product']);
        return view('admin.orders_edit', compact('order'));
    }

    // Cập nhật đơn hàng
    public function updateOrder(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|string',
        ]);

        $order->status = $validated['status'];
        $order->save();

        return redirect()->route('admin.orders')->with('success', 'Cập nhật đơn hàng thành công');
    }

    // Xóa đơn hàng
    public function deleteOrder(Order $order)
    {
        $order->items()->delete();
        $order->delete();

        return redirect()->route('admin.orders')->with('success', 'Xóa đơn hàng thành công');
    }
}
