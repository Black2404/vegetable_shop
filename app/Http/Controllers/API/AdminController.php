<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Đếm số lượng đơn hàng
        $totalOrders = Order::count();

        // Tổng doanh thu (giả sử cột total_price trong bảng orders)
        $totalRevenue = Order::sum('total');

        // Đếm sản phẩm
        $totalProducts = Product::count();

        // Đếm người dùng
        $totalUsers = User::count();

        return response()->json([
            'totalOrders'   => $totalOrders,
            'totalRevenue'  => $totalRevenue,
            'totalProducts' => $totalProducts,
            'totalUsers'    => $totalUsers,
        ]);
    }
}
