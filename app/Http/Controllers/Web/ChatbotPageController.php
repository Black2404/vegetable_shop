<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotPageController extends Controller
{
    public function index()
    {
        return view('chatbot');
    }

    // Gửi tin nhắn tới API Chatbot thật
    public function handleMessage(Request $request)
    {
        $message = $request->input('message');

        try {
            $response = Http::post(env('API_URL') . '/chat', [
                'message' => $message
            ]);

            if ($response->successful()) {
                return response()->json($response->json());
            } else {
                return response()->json(['reply' => 'Lỗi: API không phản hồi đúng.']);
            }
        } catch (\Exception $e) {
            return response()->json(['reply' => 'Không thể kết nối API: ' . $e->getMessage()]);
        }
    }
}
