<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Feedback;


class AdminFeedbackController extends Controller
{
    // API trả dữ liệu JSON (nếu cần cho web/app)
    public function index()
    {
        $feedbacks = Feedback::orderBy('created_at', 'desc')->paginate(10);
        return response()->json($feedbacks);
    }

    // API xóa phản hồi
    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();
        return response()->json(['message' => 'Xóa phản hồi thành công']);
    }
}
