<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthPageController extends Controller
{
    public function index()
{
    // Kiểm tra quyền admin
    if (session('user.role') !== 'admin') {
        return redirect()->route('home')->with('error', 'Bạn không có quyền truy cập!');
    }

    // Load giao diện dashboard (ví dụ: resources/views/admin/dashboard.blade.php)
    return view('admin.dashboard');
}

    public function home()
{
    $response = Http::get(env('API_URL') . '/products');

    $products = [];
    if ($response->successful()) {
        $products = $response->json()['data'] ?? [];
    }

    return view('/home', compact('products'));
}

    public function showLogin()
        {
            return view('login');
        }

    public function login(Request $request)
{
    $response = Http::post(env('API_URL') . '/login', [
        'email' => $request->email,
        'password' => $request->password,
    ]);

    if ($response->successful()) {
    $data = $response->json();

    // Log dữ liệu trả về để debug
    logger($data);

    // Lưu token và user vào session
    session([
        'token' => $data['token'],
        'user'  => $data['user'],
    ]);

    // Kiểm tra role để chuyển hướng đúng
    if ($data['user']['role'] === 'admin') {
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('home');
    }
}



    return back()->with('error', 'Sai tài khoản hoặc mật khẩu');
}

    public function showRegister()
    {
        return view('register'); 
    }

    public function register(Request $request)
{
    $response = Http::post(env('API_URL') . '/register', [
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => $request->password,
    ]);

    if ($response->successful()) {
        return redirect('/login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }

    return back()->with('error', 'Đăng ký thất bại, vui lòng thử lại.');
}


    public function logout(Request $request)
    {
        $token = session('token');

        if ($token) {
            Http::withToken($token)->post(env('API_URL') . '/logout');
        }

        $request->session()->flush();
        return redirect('/login')->with('success', 'Đăng xuất thành công');
    }
}
