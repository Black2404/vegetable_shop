<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Http;
use App\Models\Product;

class AuthController extends Controller
{
    //Trang chủ
    public function home()
    {
        $products = Product::latest()->take(6)->get();

        return response()->json([
            'data' => $products
        ]);
    }

    //Đăng ký
    public function register(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:6|confirmed', // 'confirmed' sẽ check password_confirmation
    ], [
        'email.unique' => 'Email đã tồn tại',
        'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
        'password.confirmed' => 'Mật khẩu nhập lại không khớp',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'message' => 'Validation lỗi',
            'errors' => $validator->errors()
        ], 422);
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'user',
    ]);

    $token = $user->createToken('api-token')->plainTextToken;

    return response()->json([
        'status' => true,
        'message' => 'Đăng ký thành công',
        'user' => $user,
        'token' => $token,
    ], 201);
}

    //Đăng nhập
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            return response()->json([
                'status'  => false,
                'message' => 'Sai email hoặc mật khẩu!',
            ], 401); // 401 Unauthorized
        }


        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'message' => 'Đăng nhập thành công',
            'user' => $user,
            'token' => $token,
        ]);
    }

    //Đăng xuất
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Đăng xuất thành công']);
    }
}
