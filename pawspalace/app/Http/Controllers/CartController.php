<?php

namespace App\Http\Controllers;

use App\Interfaces\FinancialFeaturesInterface;
use App\Models\Appointment;
use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class CartController extends Controller
{
    protected $financialFeatures;

    public function __construct(FinancialFeaturesInterface $financialFeatures)
    {
        $this->financialFeatures = $financialFeatures;
    }

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
            'title' => Lang::get('controllers.cart_index_title'),
            'subtitle' => Lang::get('controllers.cart_index_subtitle'),
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
            $quantity = $request->input('quantity');
            $cart = $request->session()->get('products', []);
            $cart[$id] = isset($cart[$id]) ? $cart[$id] + $quantity : $quantity;
            $request->session()->put('products', $cart);

            return redirect()->route('cart.index');
        } else {
            return redirect()->route('cart.index')->with('error', Lang::get('controllers.cart_product_not_found'));
        }
    }

    public function addAppointment(Request $request, $id)
    {
        $appointment = Appointment::find($id);

        if ($appointment) {
            $cart = $request->session()->get('appointments', []);

            $cart[$id] = isset($cart[$id]) ? $cart[$id] + 1 : 1;
            $request->session()->put('appointments', $cart);

            $appointment->setStatus('confirmada');
            $appointment->save();

            return redirect()->route('cart.index');
        } else {
            return redirect()->route('cart.index')->with('error', Lang::get('controllers.cart_appointment_not_found'));
        }
    }

    public function delete(Request $request)
    {
        $appointments = $request->session()->get('appointments', []);

        foreach ($appointments as $appointmentId => $quantity) {
            $appointment = Appointment::find($appointmentId);
            if ($appointment) {
                $appointment->setStatus('pendiente');
                $appointment->save();
            }
        }

        $request->session()->forget(['products', 'appointments']);

        return back();
    }

    public function remove(Request $request, $id)
    {

        $products = $request->session()->get('products', []);
        $appointments = $request->session()->get('appointments', []);

        if (isset($appointments[$id])) {
            $appointment = Appointment::find($id);
            if ($appointment) {
                $appointment->setStatus('pendiente');
                $appointment->save();
            }
            unset($appointments[$id]);
            $request->session()->put('appointments', $appointments);

            return back();

        }
        if (isset($products[$id])) {
            unset($products[$id]);
            $request->session()->put('products', $products);
        }

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
            'title' => Lang::get('controllers.cart_purchase_title'),
            'subtitle' => Lang::get('controllers.cart_purchase_subtitle'),
            'order' => $order,
        ];

        return view('cart.purchase')->with('viewData', $viewData);
    }
}
