<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function create(int $productId): RedirectResponse|View
    {
        $product = Product::find($productId);

        if (! $product) {
            return redirect()->route('product.index')->with('error', 'Product not found.');
        }

        $existingReview = Review::where('product_id', $productId)->where('user_id', Auth::id())->first();
        if ($existingReview) {
            return redirect()->route('review.show', ['id' => $existingReview->getId()]);
        }

        $viewData = [
            'subtitle' => 'Create Review',
            'productId' => $productId,
        ];

        return view('review.create')->with('viewData', $viewData);
    }

    public function save(Request $request): RedirectResponse
    {
        try {
            $productId = $request->input('productId');
            $userId = Auth::id();
            Review::validate($request);
            Review::create([
                'comment' => $request->input('comment'),
                'rating' => $request->input('rating'),
                'product_id' => $productId,
                'user_id' => $userId,
            ]);

            return back()->with('success', 'Review created successfully');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors());
        }
    }

    public function show(int $id): View
    {
        $review = Review::with('product')->findOrFail($id);

        $viewData = [
            'subtitle' => 'Review Details',
            'review' => $review,
            'product' => $review->product,
        ];

        return view('review.show')->with('viewData', $viewData);
    }

    public function edit($id)
    {
        $review = Review::findOrFail($id);

        $viewData = [
            'subtitle' => 'Review Edit',
            'title' => 'Admin Page - Edit Review - PawsPalace',
            'review' => $review,
        ];

        return view('review.edit')->with('viewData', $viewData);
    }

    public function update(Request $request, $id)
    {
        Review::validate($request);

        $review = Review::findOrFail($id);
        $review->setComment($request->input('comment'));
        $review->setRating($request->input('rating'));

        $review->save();

        return redirect()->route('review.show', ['id' => $id])->with('success', 'Review updated successfully');
    }

    public function delete(int $id): View
    {
        $review = Review::findOrFail($id);

        $review->delete();

        $viewData = [
            'title' => 'Products - PawsPalace',
            'subtitle' => 'List of products',
            'products' => Product::all(),
        ];

        return view('product.index')->with('viewData', $viewData);
    }

    public function list(int $productId): View
    {
        $product = Product::findOrFail($productId);
        $reviews = Review::where('product_id', $productId)->get();

        $viewData = [
            'subtitle' => 'List of reviews for '.$product->getName(),
            'reviews' => $reviews,
            'product' => $product,
        ];

        return view('review.list')->with('viewData', $viewData);
    }
}
