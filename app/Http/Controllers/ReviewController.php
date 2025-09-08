<?php
namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;

class ReviewController extends Controller{
    public function submit(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Review::create([
            'product_id' => $id,
            'user_id' => auth()->id(),
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'comment' => $request->input('comment'),
            'rating' => $request->rating
        ]);

        return redirect()->back()->with('success', 'Cảm ơn bạn đã đánh giá sản phẩm!');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        // Kiểm tra quyền xóa: chỉ cho phép người tạo review mới được xóa
        if ($review->user_id !== auth()->id()) {
            abort(403, 'Không có quyền xóa đánh giá này.');
        }

        $review->delete();

        return redirect()->back()->with('success', 'Đã xóa đánh giá.');
    }

}

