<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Lấy thông tin người dùng
    public function getProfile(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Token không hợp lệ hoặc người dùng chưa đăng nhập.',
            ], 401);
        }

        return response()->json([
            'status' => true,
            'data' => $user,
        ]);
    }

    // Cập nhật thông tin người dùng
    public function updateProfile(Request $request)
{
    $user = $request->user();

    if (!$user) {
        return response()->json([
            'status' => false,
            'message' => 'Token không hợp lệ hoặc người dùng chưa đăng nhập.',
        ], 401);
    }

    $data = $request->validate([
        'name' => 'sometimes|string|max:255',
        'address' => 'nullable|string|max:255',
        'password' => 'nullable|string|min:6',
    ]);

    // Chỉ cập nhật mật khẩu nếu người dùng nhập vào
    if (!empty($data['password'])) {
        $data['password'] = bcrypt($data['password']);
    } else {
        unset($data['password']); // Xóa key này nếu trống để không ảnh hưởng DB
    }

    $user->update($data);

    return response()->json([
        'status' => true,
        'message' => 'Cập nhật thông tin thành công',
        'data' => $user,
    ]);
}

}
