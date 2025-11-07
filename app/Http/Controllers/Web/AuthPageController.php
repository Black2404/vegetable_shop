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
    try {
        $response = Http::timeout(5)->post(env('API_URL') . '/login', [
            'email'    => $request->email,
            'password' => $request->password,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            session(['token' => $data['token'], 'user' => $data['user']]);
            return $data['user']['role'] === 'admin'
                ? redirect()->route('admin.dashboard')
                : redirect()->route('home');
        }

        return back()->with('error', in_array($response->status(), [401, 422])
            ? 'Sai tài khoản hoặc mật khẩu!'
            : 'Đăng nhập thất bại. Máy chủ API lỗi!');

    } catch (\Illuminate\Http\Client\ConnectionException $e) {
        return back()->with('error', 'Không thể kết nối đến API! Vui lòng thử lại sau.');
    } catch (\Exception $e) {
        return back()->with('error', 'Đã xảy ra lỗi không xác định.');
    }
}

    public function showRegister()
    {
        return view('register'); 
    }


public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email',
        'password' => 'required|string|min:6|confirmed',
    ]);

    try {
        $payload = $request->only('name', 'email', 'password', 'password_confirmation');

        $response = Http::timeout(10)->post(env('API_URL') . '/register', $payload);

        $status = $response->status();
        $json = $response->json() ?? [];

        // Thành công
        if (in_array($status, [200, 201]) && !empty($json['status']) && $json['status'] === true) {
            return redirect('/login')->with('success', $json['message'] ?? 'Đăng ký thành công!');
        }

        // Lỗi validation
        if ($status === 422) {
            $errors = $json['errors'] ?? [];
            if (!empty($errors)) {
                $firstKey = array_key_first($errors);
                $message = $errors[$firstKey][0] ?? 'Dữ liệu không hợp lệ';
            } elseif (!empty($json['message'])) {
                $message = $json['message'];
            } else {
                $message = 'Dữ liệu không hợp lệ';
            }

            return redirect('/register')->withInput()->with('error', $message);
        }

        // Lỗi khác
        $apiMessage = $json['message'] ?? 'Đăng ký thất bại. Máy chủ API lỗi!';
        return redirect('/register')->withInput()->with('error', $apiMessage);

    } catch (\Illuminate\Http\Client\ConnectionException $e) {
        return redirect('/register')->withInput()->with('error', 'Không thể kết nối tới máy chủ API. Vui lòng thử lại sau.');
    } catch (\Exception $e) {
        \Log::error('❌ API Register Unexpected Error: ' . $e->getMessage());
        \Log::error('Payload: ' . json_encode($payload));
        return redirect('/register')->withInput()->with('error', 'Đã xảy ra lỗi không xác định. Vui lòng thử lại.');
    }
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
