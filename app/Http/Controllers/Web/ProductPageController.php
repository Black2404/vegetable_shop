<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductPageController extends Controller
{
    // Trang danh sách sản phẩm
    public function index(Request $request)
    {
        $response = Http::get(env('API_URL') . '/products', [
            'keyword' => $request->keyword,
            'price_range' => $request->price_range,
            'page' => $request->page,
        ]);

        $products = $response->successful() ? $response->json() : [];

        return view('products', compact('products'));
    }

    // Xem chi tiết sản phẩm
    public function show($id)
    {
        $token = Session::get('token');
        $response = $token
            ? Http::withToken($token)->get(env('API_URL') . "/product/{$id}")
            : Http::get(env('API_URL') . "/product/{$id}");

        if (!$response->successful()) {
            abort(404, 'Sản phẩm không tìm thấy');
        }

        $product = $response->json();
        $user = Session::get('user');

        return view("product_detail", compact('product', 'user'));
    }

}
