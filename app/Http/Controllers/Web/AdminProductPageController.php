<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class AdminProductPageController extends Controller
{
    // Trang danh sách sản phẩm (có phân trang)
    public function index(Request $request)
    {
        $token = session('token');
        $page  = $request->query('page', 1);

        // Gọi API thật
        $response = Http::withToken($token)
                        ->get(env('API_URL') . '/admin/products?page=' . $page);

        if (!$response->successful()) {
            return back()->with('error', 'Không thể lấy danh sách sản phẩm!');
        }

        $data = $response->json()['data']; // dữ liệu phân trang
        $productsArray = $data['data'];    // danh sách sản phẩm

        $products = new LengthAwarePaginator(
            $productsArray,
            $data['total'],
            $data['per_page'],
            $data['current_page'],
            [
                'path'  => $request->url(),
                'query' => $request->query(),
            ]
        );

        return view('admin.products', compact('products'));
    }
    

    // Thêm sản phẩm
    public function store(Request $request)
    {
        $token = session('token');

        $response = Http::withToken($token)
            ->attach(
                'image',
                $request->file('image'),
                $request->file('image')->getClientOriginalName()
            )
            ->post(env('API_URL') . '/admin/products', [
                'name'  => $request->name,
                'price' => $request->price,
            ]);

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Thêm sản phẩm thành công!');
        }

        return redirect()->back()->with('error', 'Thêm sản phẩm thất bại!');
    }

    // Trang sửa sản phẩm
    public function edit($id)
    {
        $token = session('token');
        $response = Http::withToken($token)->get(env('API_URL') . "/admin/products/$id");

        if ($response->failed()) {
            return redirect()->route('admin.products')->with('error', 'Không tìm thấy sản phẩm');
        }

        $data = $response->json();
        $product = $data['data'] ?? $data;

        return view('admin.products_edit', compact('product'));
    }

    // Cập nhật sản phẩm
    public function update(Request $request, $id)
    {
        $token = session('token');

        $data = [
            'name'  => $request->name,
            'price' => $request->price,
        ];

        if ($request->hasFile('image')) {
            $response = Http::withToken($token)
                ->attach(
                    'image',
                    $request->file('image'),
                    $request->file('image')->getClientOriginalName()
                )
                ->post(env('API_URL') . "/admin/products/$id?_method=PUT", $data);
        } else {
            $response = Http::withToken($token)
                ->put(env('API_URL') . "/admin/products/$id", $data);
        }

        if ($response->successful()) {
            return redirect()->route('admin.products')->with('success', 'Cập nhật sản phẩm thành công!');
        }

        return redirect()->back()->with('error', 'Cập nhật thất bại!');
    }

    // Xóa sản phẩm
    public function destroy($id)
    {
        $token = session('token');
        $response = Http::withToken($token)->delete(env('API_URL') . "/admin/products/$id");

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Xóa sản phẩm thành công!');
        }

        return redirect()->back()->with('error', 'Xóa sản phẩm thất bại!');
    }
}
