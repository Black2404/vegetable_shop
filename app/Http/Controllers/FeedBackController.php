<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FeedBack;

class FeedBackController extends Controller
{
    public function store(Request $request)
    {
        // validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // lưu vào database
        FeedBack::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);


        // redirect lại với thông báo
        return redirect()->back()->with('success', 'Cảm ơn bạn đã gửi đánh giá!');
    }
}
