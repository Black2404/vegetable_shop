<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class AdminUserPageController extends Controller
{
    // Danh sách người dùng

    public function index(Request $request)
    {
        $token = session('token'); // nếu có JWT hoặc Bearer token
        $page = $request->query('page', 1);

        // Gọi API (backend thật)
        $response = Http::withToken($token)
                        ->get(env('API_URL') . '/admin/users?page=' . $page);

        if (!$response->successful()) {
            return back()->with('error', 'Không thể lấy danh sách người dùng!');
        }

        $data = $response->json()['data']; // lấy phần "data" từ JSON
        $usersArray = $data['data'];       // danh sách người dùng

        // ⚙ Tạo paginator từ dữ liệu API
        $users = new LengthAwarePaginator(
            $usersArray,                  // dữ liệu người dùng hiện tại
            $data['total'],               // tổng số người dùng
            $data['per_page'],            // số người mỗi trang
            $data['current_page'],        // trang hiện tại
            [
                'path'  => $request->url(), 
                'query' => $request->query() // để giữ query string ?page=...
            ]
        );

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
