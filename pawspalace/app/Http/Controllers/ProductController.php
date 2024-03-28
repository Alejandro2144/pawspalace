<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {

        $viewData = [
            'title' => 'Products - PawsPalace',
            'subtitle' => 'List of products',
            'products' => Product::all(),
        ];

        return view('product.index')->with('viewData', $viewData);
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
