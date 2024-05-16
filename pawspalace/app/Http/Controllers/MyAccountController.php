<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\View\View;

class MyAccountController extends Controller
{
    public function orders(): View
    {
        $viewData = [];
        $viewData['title'] = Lang::get('controllers.myaccount_orders_title');
        $viewData['subtitle'] = Lang::get('controllers.myaccount_orders_subtitle');

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
