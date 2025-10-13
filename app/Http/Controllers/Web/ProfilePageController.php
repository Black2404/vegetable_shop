<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProfilePageController extends Controller
{
    // Hiển thị trang thông tin cá nhân
    public function showProfile()
    {
        $token = session('token');

        if (!$token) {
            return redirect('/login')->with('error', 'Vui lòng đăng nhập');
        }

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->get(env('API_URL') . '/profile');

        if ($response->successful()) {
            $user = $response->json()['data'] ?? [];
            return view('profile', compact('user'));
        }

        return redirect('/home')->with('error', 'Không thể tải thông tin người dùng');
    }

    // Cập nhật thông tin cá nhân
    public function updateProfile(Request $request)
    {
        $token = session('token');

        if (!$token) {
            return redirect('/login')->with('error', 'Vui lòng đăng nhập');
        }

        $url = env('API_URL') . '/profile/update';

        // Gửi request cập nhật đến API
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->post($url, [
            'name' => $request->name,
            'address' => $request->address,
            'password' => $request->password,
        ]);

        if ($response->successful()) {
            // Lưu user mới vào session
            session(['user' => $response->json()['data'] ?? []]);
            return redirect()->route('profile.show')->with('success', 'Cập nhật thành công');
        }

        // Nếu lỗi 401 → token hết hạn hoặc không hợp lệ
        if ($response->status() === 401) {
            session()->forget(['token', 'user']);
            return redirect('/login')->with('error', 'Phiên đăng nhập đã hết hạn, vui lòng đăng nhập lại');
        }

        return back()->with('error', 'Cập nhật thất bại');
    }
}
