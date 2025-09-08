<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Hiển thị form đăng nhập
    public function showLogin()
    {
        return view('login');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') return redirect()->route('admin.dashboard');

            return redirect()->intended('/'); // về trang chủ
        }

        return back()->with('error', 'Email hoặc mật khẩu không đúng');
    }

    // Hiển thị form đăng ký
    public function showRegister()
    {
        return view('register');
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            // 'role' => 'user', // nếu phân quyền
        ]);

        return redirect()->route('login')->with('success', 'Đăng ký thành công, hãy đăng nhập');
    }

    // Đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    // Đổi mật khẩu
    public function updateProfile(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:100',
        'address' => 'nullable|string|max:255',
        'password' => 'nullable|min:6|confirmed',
    ]);

    $user->name = $request->name;
    $user->address = $request->address;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return back()->with('success', 'Cập nhật thông tin thành công.');
}

}
