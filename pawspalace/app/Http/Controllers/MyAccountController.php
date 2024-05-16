<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class MyAccountController extends Controller
{
    public function orders()
    {
        $viewData = [];
        $viewData['title'] = 'My Orders - PawsPalace';
        $viewData['subtitle'] = 'My Orders';

        $orders = Order::with('items.product')->where('user_id', Auth::id())->get();

        foreach ($orders as $order) {
            $total = 0;
            foreach ($order->items as $item) {
                $total += $item->price * $item->quantity; 
            }
            $order->total = $total; 
        }

        $viewData['orders'] = $orders;

        return view('myaccount.orders')->with('viewData', $viewData);
    }
}
