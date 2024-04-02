<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $viewData = [
            'title' => 'Products - PawsPalace',
            'subtitle' => 'List of products',
        ];

        $query = $request->query('query');

        $products = Product::where('name', 'LIKE', "%$query%")->get();

        $viewData['query'] = $query;
        $viewData['products'] = $products;

        return view('product.index', ['viewData' => $viewData]);
    }

    public function show(string $id): View|RedirectResponse
    {
        $product = Product::find($id);

        if (! $product) {
            return redirect()->route('home.index');
        }

        $viewData = [
            'title' => $product->getName().' - PawsPalace',
            'subtitle' => $product->getName().' - Product Information',
            'product' => $product,
        ];

        return view('product.show')->with('viewData', $viewData);
    }
}
