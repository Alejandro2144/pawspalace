<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ReviewController extends Controller
{
    public function save(Request $request): RedirectResponse
    {
        if (! Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to perform this action');
        }
        try {
            $productId = $request->input('productId');
            $userId = Auth::id();
            Review::validate($request);
            $review = Review::create([
                'comment' => $request->input('comment'),
                'rating' => $request->input('rating'),
                'product_id' => $productId,
                'user_id' => $userId,
            ]);

            $product = Product::find($productId);
            $product->reviews()->save($review);
            $user = User::find($userId);
            $user->reviews()->save($review);

            return back()->with('success', 'Review created successfully');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors());
        }
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        Review::validate($request);

        $review = Review::findOrFail($id);
        $review->setComment($request->input('comment'));
        $review->setRating($request->input('rating'));

        $review->save();

        return back()->with('success', 'Review created successfully');
    }

    public function delete(int $id): RedirectResponse
    {
        $review = Review::findOrFail($id);

        $review->delete();

        $viewData = [
            'title' => 'Products - PawsPalace',
            'subtitle' => 'List of products',
            'products' => Product::all(),
        ];

        return back()->with('viewData', $viewData);
    }
}
