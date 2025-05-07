<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;

class OrderController extends Controller
{
    // Render User 'My Orders' page
    public function orders(Request $request, $id = null) {
        $condition = session('condition', 'new');
        if (empty($id)) {
            $orders = Order::with('orders_products')->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->orderBy('id', 'Desc')->get()->toArray();


            return view('front.orders.orders')->with(compact('orders','condition'));

        } else {
            $orderDetails = Order::with('orders_products')->where('id', $id)->first()->toArray();


            return view('front.orders.order_details')->with(compact('orderDetails','condition'));
        }

    }

}
