<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    //Thanh tìm kiếm và bộ lọc giá
    public function index(Request $request){
        $query = Product::query();

        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        if ($request->filled('price_range')) {
            switch ($request->price_range) {
                case '1':
                    $query->where('price', '<', 50000);
                    break;
                case '2':
                    $query->whereBetween('price', [50000, 100000]);
                    break;
                case '3':
                    $query->where('price', '>', 100000);
                    break;
            }
        }

        $products = $query->paginate(6);

        return view('products', compact('products'));
    }

    // Xem chi tiết
    public function show($id){
        $product = Product::with('reviews')->findOrFail($id);
        return view('product_detail', compact('product'));
    }


}
