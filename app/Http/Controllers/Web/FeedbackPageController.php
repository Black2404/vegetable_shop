<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FeedBackPageController extends Controller
{
    public function store(Request $request)
    {
        // Validate dữ liệu trước khi gửi API
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);

        $url = env('API_URL') . '/feedback';

        // Gọi API POST
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->post($url, [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        if ($response->successful()) {
            return redirect()->back()->with('success', $response->json('message'));
        }

        return redirect()->back()->with('error', 'Gửi đánh giá thất bại');
    }
}
