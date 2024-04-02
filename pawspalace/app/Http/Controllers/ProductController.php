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
        $category = $request->query('category');

        $productsQuery = Product::query();

        if ($query) {
            $productsQuery->where('name', 'LIKE', "%$query%");
        }

        if ($category) {
            $productsQuery->where('category', $category);
        }

        $products = $productsQuery->get();

        $viewData['query'] = $query;
        $viewData['category'] = $category;
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
