<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class AdminPageController extends Controller
{
    public function index()
    {
        // 1. Kiểm tra đăng nhập và quyền
        $user = session('user');
        $token = session('token');

        if (!$user || $user['role'] !== 'admin') {
            return redirect()->route('home')->with('error', 'Bạn không có quyền truy cập!');
        }

        if (!$token) {
            return redirect()->route('login')->with('error', 'Phiên đăng nhập đã hết hạn!');
        }

        // 2. Gọi API
        $url = env('API_URL') . '/admin/dashboard';
        $response = Http::withToken($token)->get($url);

        // Debug lỗi
        \Log::info('Admin dashboard API', [
            'url' => $url,
            'status' => $response->status(),
            'body' => $response->body(),
            'token' => $token ? 'yes' : 'no',
        ]);

        if ($response->successful()) {
            $data = $response->json();
        } else {
            $data = [
                'totalOrders' => 0,
                'totalRevenue' => 0,
                'totalProducts' => 0,
                'totalUsers' => 0,
            ];
        }

        return view('admin.dashboard', $data);
    }
}
