<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
{
    if (!$request->user() || $request->user()->role !== 'admin') {

        // Nếu request là API (đường dẫn /api/...)
        if ($request->is('api/*')) {
            return response()->json([
                'message' => 'Bạn không có quyền truy cập!'
            ], 403);
        }

        // Nếu là request web (từ trình duyệt)
        return redirect()->route('home')->with('error', 'Bạn không có quyền truy cập!');
    }

    return $next($request);
}

}
