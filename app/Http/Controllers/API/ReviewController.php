<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ReviewController extends Controller
{
    // Danh sách review
   public function index($productId)
    {
        $product = Product::findOrFail($productId);

        $reviews = Review::with('user')
            ->where('product_id', $product->id)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'product_id' => $product->id,
            'reviews' => $reviews
        ]);
    }
    
    // Thêm review mới cho sản phẩm
    public function store(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        $validated = $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string'
        ]);

        $review = Review::create([
            'user_id'    => Auth::id(),
            'product_id' => $product->id,
            'rating'     => $validated['rating'],
            'comment'    => $validated['comment'] ?? null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Đã thêm đánh giá thành công!',
            'review'  => $review->load('user')
        ], 201);
    }
    
    // Xóa review
    public function destroy(Request $request, Review $review)
    {
        if ($review->user_id !== $request->user()->id) {
            return response()->json(['error' => 'Bạn không có quyền xóa đánh giá này'], 403);
        }

        $review->delete();

        return response()->json(['message' => 'Đã xóa đánh giá']);
    }
}
