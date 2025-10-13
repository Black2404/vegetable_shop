<?php

namespace App\Http\Controllers\Web;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Models\Review;

class ReviewPageController extends Controller
{
    // Thêm đánh giá
    public function store(Request $request, $id)
    {
        $token = Session::get('token');

        $response = Http::withToken($token)->post(env('API_URL') . "/products/{$id}/reviews", [
            'comment' => $request->comment,
            'rating' => $request->rating,
        ]);

        if ($response->failed()) {
            return back()->with('error', 'Không thể thêm đánh giá');
        }

        return back();
    }

    // Xóa đánh giá
    public function destroy($id)
    {
        $token = Session::get('token');

        $response = Http::withToken($token)->delete(env('API_URL') . "/reviews/{$id}");

        if ($response->failed()) {
            return back()->with('error', 'Không thể xóa đánh giá');
        }

        return back();
    }
}
