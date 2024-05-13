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
