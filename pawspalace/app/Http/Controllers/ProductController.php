<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

    public function saveFavorite(Request $request): RedirectResponse
    {
        if (! Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to mark a product as favorite.');
        }

        $productId = $request->input('productId');
        $user = Auth::user();

        $product = Product::findOrFail($productId);

        if ($product->getFavorite()) {
            $product->setFavorite(false);
            $product->user_id = null;
        } else {
            $product->setFavorite(true);
            $product->user_id = $user->id;
        }

        $product->save();

        return redirect()->back()->with('success', 'Product marked as favorite.');
    }

    public function showFavorites(): View
    {
        if (! Auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to view your favorite products.');
        }

        $user = auth()->user();
        $favorites = $user->favoriteProducts;

        return view('product.favorite', compact('favorites'));
    }
}
