<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Danh sách sản phẩm + tìm kiếm + lọc
    public function index(Request $request)
{
    $query = Product::query();

    if ($request->keyword) {
        $query->where('name', 'like', '%' . $request->keyword . '%');
    }

    if ($request->price_range) {
        switch ($request->price_range) {
            case '1': $query->where('price', '<', 50000); break;
            case '2': $query->whereBetween('price', [50000, 100000]); break;
            case '3': $query->where('price', '>', 100000); break;
        }
    }

    $products = $query->paginate(6);

    return response()->json([
        'data' => $products->items(),
        'current_page' => $products->currentPage(),
        'last_page' => $products->lastPage(),
        'total' => $products->total()
    ]);
}

    // Chi tiết sản phẩm
public function show($id)
{
    $product = Product::with('reviews.user')->find($id);

    if (!$product) {
        return response()->json(['error' => 'Không tìm thấy sản phẩm'], 404);
    }

    return response()->json($product);
}

}
