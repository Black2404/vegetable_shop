<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;

class AdminFeedbackPageController extends Controller
{
    // Hiển thị danh sách phản hồi (phân trang)
    public function index(Request $request)
{
    $token = session('token'); // nếu có JWT/Bearer token
    $page  = $request->query('page', 1);

    $response = Http::withToken($token)
                    ->get(env('API_URL') . '/admin/feedbacks?page=' . $page);

    if (!$response->successful()) {
        return back()->with('error', 'Không thể lấy danh sách phản hồi!');
    }

    $data = $response->json();
    $feedbacksArray = array_map(function ($item) {
        $obj = (object) $item;
        if (!empty($obj->created_at)) {
            $obj->created_at = Carbon::parse($obj->created_at);
        }
        return $obj;
    }, $data['data'] ?? []);

    $feedbacks = new LengthAwarePaginator(
        $feedbacksArray,
        $data['total'] ?? count($feedbacksArray),
        $data['per_page'] ?? 8,
        $data['current_page'] ?? 1,
        [
            'path'  => $request->url(),
            'query' => $request->query(),
        ]
    );


    return view('admin.feedback', compact('feedbacks'));
}

    // Xóa phản hồi
    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();
        return redirect()->route('admin.feedbacks')->with('success', 'Xóa phản hồi thành công!');

    }

    
}
