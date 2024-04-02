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

        $orders = Order::with(['items.product', 'items.appointment'])->where('user_id', Auth::user()->getId())->get();

        foreach ($orders as $order) {
            $appointmentsTotal = $order->items->filter(function ($item) {
                return ! is_null($item->appointment);
            })->sum(function ($item) {
                return $item->quantity * $item->price;
            });
            $order->setAppointmentsTotal($appointmentsTotal);
        }

        $viewData['orders'] = $orders;

        return view('myaccount.orders')->with('viewData', $viewData);
    }
}
