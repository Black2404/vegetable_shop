<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    // Danh sách người dùng
    public function index(Request $request)
        {
            $users = User::where('role', '!=', 'admin')
                        ->orderBy('id', 'desc')
                        ->paginate(6); // mỗi trang 6 người

            return response()->json([
                'status' => true,
                'data'   => $users,
            ]);
        }
    // Thêm người dùng mới
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'address' => 'nullable|string|max:255',
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'address'  => $data['address'] ?? '',
            'role'     => 'user',
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Thêm người dùng thành công!',
            'data' => $user
        ]);
    }
public function show($id)
{
    $user = User::find($id);

    if (!$user) {
        return response()->json([
            'status' => false,
            'message' => 'Không tìm thấy người dùng!',
        ], 404);
    }

    return response()->json([
        'status' => true,
        'data' => $user
    ]);
}
    // Cập nhật thông tin người dùng
    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $data = $request->validate([
        'name'    => 'required|string|max:255',
        'email'   => "required|email|unique:users,email,{$user->id}",
        'address' => 'nullable|string|max:255',
        'role'    => 'required|in:user,admin', 
    ]);

    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $user->update($data); 

    return response()->json([
        'status'  => true,
        'message' => 'Cập nhật người dùng thành công!',
        'data'    => $user
    ]);
}


    // Xóa người dùng
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->role === 'admin') {
            return response()->json([
                'status' => false,
                'message' => 'Không thể xóa tài khoản admin!',
            ], 403);
        }

        $user->delete();

        return response()->json([
            'status' => true,
            'message' => 'Xóa người dùng thành công!'
        ]);
    }
}
