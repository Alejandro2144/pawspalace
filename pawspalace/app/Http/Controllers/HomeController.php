<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
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
            'title' => Lang::get('controllers.home_index_title'),
            'highlightedProducts' => $highlightedProducts,
        ];

        return view('home.index')->with('viewData', $viewData);
    }

    public function about(): View
    {
        $viewData = [];
        $viewData['title'] = Lang::get('controllers.home_about_title');
        $viewData['subtitle'] = Lang::get('controllers.home_about_subtitle');
        $viewData['description'] = Lang::get('controllers.home_about_description');
        $viewData['author'] = Lang::get('controllers.home_about_author');

        return view('home.about')->with('viewData', $viewData);
    }
}