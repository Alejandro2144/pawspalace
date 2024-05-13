<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $viewData = [
            'title' => Lang::get('controllers.product_index_title'),
            'subtitle' => Lang::get('controllers.product_index_subtitle'),
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

    public function show(string $productId): RedirectResponse|View
    {
        $product = Product::findOrFail($productId);
        $reviews = Review::where('product_id', $productId)->get();

        if (! $product) {
            return redirect()->route('product.index')->with('error', Lang::get('controllers.product_show_product_not_found'));
        }

        $existingReview = Review::where('product_id', $productId)->where('user_id', Auth::id())->first();

        $viewData = [
            'title' => Lang::get('controllers.product_show_title'),
            'subtitle' => Lang::get('controllers.product_show_subtitle'),
            'product' => $product,
            'reviews' => $reviews,
            'existingReview' => $existingReview,
        ];

        return view('product.show')->with('viewData', $viewData);
    }

    public function saveFavorite(Request $request): RedirectResponse
    {
        $user = Auth::user();
    
        if (! $user) {
            return redirect()->route('login')->with('error', Lang::get('controllers.product_save_favorite_login'));
        }
    
        $productId = $request->input('productId');
        $product = Product::findOrFail($productId);
    
        $user->favoriteProducts()->toggle($product->id);
    
        return redirect()->back()->with('success', Lang::get('controllers.product_save_favorite_success'));
    }   

    public function showFavorites(): View
    {
        if (! Auth()->check()) {
            return redirect()->route('login')->with('error', Lang::get('controllers.product_show_favorites_login'));
        }

        $user = auth()->user();
        $favorites = $user->favoriteProducts;

        return view('product.favorite', compact('favorites'));
    }
}