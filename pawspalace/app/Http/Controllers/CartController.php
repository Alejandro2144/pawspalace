<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $total = 0;
        $productsInCart = [];
        $appointmentsInCart = [];

        $productsInSession = $request->session()->get('products');
        $appointmentsInSession = $request->session()->get('appointments');

        if ($productsInSession) {
            $productsInCart = Product::findMany(array_keys($productsInSession));
            $total += Product::sumPricesByQuantities($productsInCart, $productsInSession);
        }

        if ($appointmentsInSession) {
            $appointmentsInCart = Appointment::findMany(array_keys($appointmentsInSession));
            foreach ($appointmentsInCart as $appointment) {
                $total += $appointment->getPrice();
            }
        }

        $viewData = [
            'title' => 'Cart - PawsPalace',
            'subtitle' => 'Shopping Cart',
            'total' => $total,
            'products' => $productsInCart,
            'appointments' => $appointmentsInCart,
        ];

        return view('cart.index')->with('viewData', $viewData);
    }

    public function addProduct(Request $request, $id)
    {
        $product = Product::find($id);

        if ($product) {
            $cart = $request->session()->get('products', []);
            $cart[$id] = isset($cart[$id]) ? $cart[$id] + 1 : 1;
            $request->session()->put('products', $cart);

            return redirect()->route('cart.index');
        } else {
            return redirect()->route('cart.index')->with('error', 'Product not found.');
        }
    }

    public function addAppointment(Request $request, $id)
    {
        $appointment = Appointment::find($id);

        if ($appointment) {
            $cart = $request->session()->get('appointments', []);
            $cart[$id] = isset($cart[$id]) ? $cart[$id] + 1 : 1;
            $request->session()->put('appointments', $cart);

            return redirect()->route('cart.index');
        } else {
            return redirect()->route('cart.index')->with('error', 'Appointment not found.');
        }
    }

    public function delete(Request $request)
    {
        $request->session()->forget('products');
        $request->session()->forget('appointments');

        return back();
    }

    public function remove(Request $request, $id)
    {
        $products = $request->session()->get('products');
        $appointments = $request->session()->get('appointments');

        unset($products[$id]);
        unset($appointments[$id]);

        $request->session()->put('products', $products);
        $request->session()->put('appointments', $appointments);

        return back();
    }

    public function purchase(Request $request)
    {
        $productsInSession = $request->session()->get('products', []);
        $appointmentsInSession = $request->session()->get('appointments', []);

        $order = new Order();
        $order->setUserId(Auth::id());
        $order->setTotal(0);

        $order->save();

        $total = 0;

        foreach ($productsInSession as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {

                $item = new Item();
                $item->setQuantity($quantity);
                $item->setPrice($product->getPrice());
                $item->setProductId($productId);
                $item->setOrderId($order->getId());
                $item->save();

                $total += $product->getPrice() * $quantity;
            }
        }

        foreach ($appointmentsInSession as $appointmentId => $quantity) {
            $appointment = Appointment::find($appointmentId);
            if ($appointment) {
                $item = new Item();
                $item->setQuantity($quantity);
                $item->setPrice($appointment->getPrice());
                $item->setAppointmentId($appointmentId);
                $item->setOrderId($order->getId());
                $item->save();

                $total += $appointment->getPrice() * $quantity;
            }
        }

        $order->setTotal($total);
        $order->save();

        $user = Auth::user();
        $user->setBalance($user->getBalance() - $total);
        $user->save();

        $request->session()->forget(['products', 'appointments']);

        $viewData = [
            'title' => 'Purchase - PawsPalace',
            'subtitle' => 'Purchase Status',
            'order' => $order,
        ];

        return view('cart.purchase')->with('viewData', $viewData);
    }
}
