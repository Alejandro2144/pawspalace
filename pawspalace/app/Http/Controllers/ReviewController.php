<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function index(): View
    {
        $viewData = [
            'subtitle' => 'What do you want to do with the reviews?',
        ];

        return view('review.index')->with('viewData', $viewData);
    }

    public function list(): View
    {

        $viewData = [
            'subtitle' => 'List of reviews',
            'reviews' => Review::all(),
        ];

        return view('review.list')->with('viewData', $viewData);
    }

    public function create(): View
    {
        $viewData = [
            'subtitle' => 'Create Review',
        ];

        return view('review.create')->with('viewData', $viewData);
    }

    public function show(int $id): View
    {
        $review = Review::findOrFail($id);
        $viewData = [
            'subtitle' => 'Review information',
            'reviews' => $review,
        ];         

        return view('review.show')->with('viewData', $viewData);
    }

    public function save(Request $request): RedirectResponse
    {
        try {
            Review::validateReview($request->all());
            Review::create($request->all());

            return back()->with('success', 'Review creada satisfactoriamente');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors());
        }
    }

    public function delete(int $id): RedirectResponse
    {
        $review = Review::findOrFail($id);

        $review->delete();

        return redirect()->route('review.list')->with('success', 'Revisión eliminada correctamente');
    }
}