<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\ValidationException;

class ReviewController extends Controller
{
    public function save(Request $request): RedirectResponse
    {
        if (! Auth::check()) {
            return redirect()->route('login')->with('error', Lang::get('controllers.review_save_login_error'));
        }
        try {
            $productId = $request->input('productId');
            $userId = Auth::id();

            $existingReview = Review::where('user_id', $userId)->where('product_id', $productId)->exists();
            if ($existingReview) {
                return back()->with('error', 'You have already reviewed this product');
            }

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

            return back()->with('success', Lang::get('controllers.review_save_success'));
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors());
        }
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        Review::validate($request);

        $productId = $request->input('productId');
        $review = Product::findOrFail($productId)->reviews()->findOrFail($id);
        $review->setComment($request->input('comment'));
        $review->setRating($request->input('rating'));

        $review->save();

        return back()->with('success', Lang::get('controllers.review_update_success'));
    }
}
