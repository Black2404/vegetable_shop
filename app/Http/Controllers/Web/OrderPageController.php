<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderPageController extends Controller
{
    public function index()
    {
        $token = Session::get('token');
        $page = request()->get('page', 1);

        $response = Http::withToken($token)->get(env('API_URL') . '/orders', [
            'page' => $page
        ]);

        $orders = collect();
        $pagination = [];

        if ($response->successful()) {
            $data = $response->json()['orders'];
            $orders = collect($data['data'] ?? []);
            $pagination = $data; // gồm: current_page, last_page, per_page, total
        }

        return view('order', compact('orders', 'pagination'));
    }


    public function show($id)
    {
        $token = Session::get('token');
        $response = Http::withToken($token)->get(env('API_URL') . '/orders/' . $id);

        $order = $response->successful() ? $response->json()['order'] : null;
        return view('order_detail', compact('order'));
    }
}