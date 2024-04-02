<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
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

    public function show(string $productId): RedirectResponse|View
    {
        $product = Product::findOrFail($productId);
        $reviews = Review::where('product_id', $productId)->get();

        if (! $product) {
            return redirect()->route('product.index')->with('error', 'Product not found.');
        }

        $existingReview = Review::where('product_id', $productId)->where('user_id', Auth::id())->first();

        $viewData = [
            'title' => 'Product Details - PawsPalace',
            'subtitle' => 'Product Details',
            'product' => $product,
            'reviews' => $reviews,
            'existingReview' => $existingReview,
        ];

        return view('product.show')->with('viewData', $viewData);
    }
}
