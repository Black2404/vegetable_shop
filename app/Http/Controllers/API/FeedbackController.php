<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeedBack;

class FeedBackController extends Controller
{
    // Lưu feedback từ API
    public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'message' => 'required|string|max:1000',
    ]);

    $feedback = FeedBack::create($data);

    return response()->json([
        'status' => true,
        'message' => 'Gửi đánh giá thành công',
        'data' => $feedback
    ], 201);
}


    // Nếu muốn lấy danh sách feedback
    public function index()
    {
        $feedbacks = FeedBack::latest()->get();

        return response()->json([
            'status' => true,
            'data' => $feedbacks
        ]);
    }
}
