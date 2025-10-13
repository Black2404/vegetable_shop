<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class AdminFeedbackPageController extends Controller
{
    // Hiển thị danh sách phản hồi (phân trang)
    public function index()
    {
        $feedbacks = Feedback::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.feedback', compact('feedbacks'));
    }

    // Xóa phản hồi
    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();
        return redirect()->route('admin.feedback')->with('success', 'Xóa phản hồi thành công!');
    }

    // API trả dữ liệu JSON (nếu cần cho web/app)
    public function apiIndex()
    {
        $feedbacks = Feedback::orderBy('created_at', 'desc')->paginate(10);
        return response()->json($feedbacks);
    }

    // API xóa phản hồi
    public function apiDestroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();
        return response()->json(['message' => 'Xóa phản hồi thành công']);
    }
}
