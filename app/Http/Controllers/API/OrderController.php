<?php 

 namespace App\Http\Controllers\Api; 

 use App\Http\Controllers\Controller; 
 use Illuminate\Http\Request; 
 use App\Models\Order; 
 use Illuminate\Support\Facades\Auth; 

 class OrderController extends Controller 
 { 
     // Danh sách đơn hàng (có phân trang) 
     public function index() 
 { 
     $user = Auth::user(); 

     $orders = Order::with('items.product') 
         ->where('user_id', $user->id) 
         ->orderBy('created_at', 'desc') 
         ->paginate(9);  

     return response()->json([ 
         'success' => true, 
         'orders' => $orders 
     ]); 
 } 


     // Chi tiết 1 đơn hàng 
     public function show($id) 
     { 
         $user = Auth::user(); 

         $order = Order::with('items.product') 
             ->where('user_id', $user->id) 
             ->findOrFail($id); 

         return response()->json([ 
             'success' => true, 
             'order' => $order 
         ]); 
     } 
 }
