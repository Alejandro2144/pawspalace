<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $highlightedProducts = Product::with('reviews')
            ->select('products.id', 'products.name', 'products.description', 'products.category', 'products.price', 'products.stock', 'products.image', DB::raw('AVG(reviews.rating) as average_rating'))
            ->join('reviews', 'products.id', '=', 'reviews.product_id')
            ->groupBy('products.id', 'products.name', 'products.description', 'products.category', 'products.price', 'products.stock', 'products.image')
            ->orderByDesc('average_rating')
            ->take(5)
            ->get();

        $viewData = [
            'title' => 'Home Page - PawsPalace',
            'highlightedProducts' => $highlightedProducts,
        ];

        return view('home.index')->with('viewData', $viewData);
    }

    public function about(): View
    {
        $viewData = [];
        $viewData['title'] = 'About us - PawsPalace';
        $viewData['subtitle'] = 'About us';
        $viewData['description'] = 'PawsPalace es una página web dedicada a la venta de productos para mascotas,
        con una sección de consultas y asesorías personalizadas con veterinarios de la tienda. ';
        $viewData['author'] = 'Developed by: PawsPalace Team';

        return view('home.about')->with('viewData', $viewData);
    }
}
