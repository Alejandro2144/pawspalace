<?php

namespace App\Http\Controllers;

use App\Implementations\FinancialFeaturesImplementation;
use App\Models\Order;
use Illuminate\Http\Request;
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
                $total += $item->getPrice() * $item->getQuantity();
            }
            $order->setTotal($total);
        }

        $viewData['orders'] = $orders;

        return view('myaccount.orders')->with('viewData', $viewData);
    }

    public function generateReports(Request $request): View
    {
        $format = $request->input('format', 'pdf');

        $ordersData = [];
        $orders = Order::with('items.product', 'items.appointment')->where('user_id', Auth::id())->get();

        foreach ($orders as $order) {
            $orderInfo = [
                'id' => $order->getId(),
                'date' => $order->getCreatedAt(),
                'total' => $order->getTotal(),
                'items' => [],
            ];
            foreach ($order->getItems() as $item) {
                $itemInfo = [];
                if ($item->getProduct()) {
                    $itemInfo['type'] = 'product';
                    $itemInfo['name'] = $item->getProduct()->getName();
                    $itemInfo['price'] = $item->getProduct()->getPrice();
                } elseif ($item->getAppointment()) {
                    $itemInfo['type'] = 'appointment';
                    $itemInfo['modality'] = $item->getAppointment()->getModality();
                    $itemInfo['price'] = $item->getAppointment()->getPrice();
                }
                $itemInfo['quantity'] = $item->getQuantity();
                $orderInfo['items'][] = $itemInfo;
            }
            $ordersData[] = $orderInfo;
        }
        $financialFeatures = new FinancialFeaturesImplementation();
        if ($format === 'pdf') {
            $financialFeatures->generatePDFReport($ordersData);
        } elseif ($format === 'excel') {
            $financialFeatures->generateExcelReport($ordersData);
        }

        return view('myaccount.orders');
    }
}
