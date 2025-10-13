<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;

class AdminUserPageController extends Controller
{
    // Danh sách người dùng
    public function index()
    {
        $users = User::where('role', '!=', 'admin')
                    ->orderBy('id', 'desc')
                    ->paginate(6);

        return view('admin.users', compact('users'));
    }

    // Thêm người dùng
    public function store(Request $request)
    {
        $token = session('token');
        $response = Http::withToken($token)->post(env('API_URL') . '/admin/users', [
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password,
            'address'  => $request->address,
        ]);

        if ($response->successful()) {
            return redirect()->route('admin.users')->with('success', 'Thêm người dùng thành công!');
        }

        return back()->with('error', 'Không thể thêm người dùng!');
    }

    // Hiển thị form sửa
    public function edit($id)
    {
        $token = session('token');
        $response = Http::withToken($token)->get(env('API_URL') . "/admin/users/{$id}");

        if ($response->successful()) {
            $data = $response->json()['data'] ?? [];
            $user = (object) $data; // ⚙️ ép về object để dùng $user->id trong Blade
            return view('admin.users_edit', compact('user'));
        }

        return redirect()->route('admin.users')->with('error', 'Không tìm thấy người dùng!');
    }

    // Cập nhật người dùng
    public function update(Request $request, $id)
    {
        $token = session('token');

        $response = Http::withToken($token)->put(env('API_URL') . "/admin/users/{$id}", [
            'name'    => $request->name,
            'email'   => $request->email,
            'address' => $request->address,
            'role'    => $request->role,
        ]);

        if ($response->successful()) {
            return redirect()->route('admin.users')->with('success', 'Cập nhật người dùng thành công!');
        }

        return back()->with('error', 'Cập nhật thất bại!');
    }

    // Xóa người dùng
    public function delete($id)
    {
        $token = session('token');
        $response = Http::withToken($token)->delete(env('API_URL') . '/admin/users/' . $id);

        if ($response->successful()) {
            return redirect()->route('admin.users')->with('success', 'Xóa thành công!');
        }

        return back()->with('error', 'Không thể xóa người dùng!');
    }
}
