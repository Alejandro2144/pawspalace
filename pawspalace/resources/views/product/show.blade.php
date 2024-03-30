@extends('layouts.app')

@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <img src="{{ asset('/storage/'.$viewData["product"]->getImage()) }}"
                            class="img-fluid rounded-start">
                    </div>
                </div>
                <h5 class="card-title mt-3 text-center">
                    {{ $viewData["product"]->getName() }} (${{ $viewData["product"]->getPrice() }})
                </h5>
                <p class="card-text text-center">
                    {{ $viewData["product"]->getDescription() }}
                </p>
                <form method="POST" action="{{ route('cart.add', ['id'=> $viewData['product']->getId()]) }}">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-auto">
                            <div class="input-group">
                                <div class="input-group-text">Quantity</div>
                                <input type="number" min="1" max="10" class="form-control quantity-input"
                                    name="quantity" value="1">
                            </div>
                        </div>
                        <div class="col-auto">
                            <button class="btn bg-primary text-black" type="submit">Add to cart</button>
                        </div>
                    </div>
                </form>
                <hr>
                @if (!$viewData["existingReview"])
                <h4 class="text-center">Create Review</h4>
                @else
                <h4 class="text-center">Edit Your Review</h4>
                @endif

                {{-- Formulario de creación o edición de revisión --}}
                @if (!$viewData["existingReview"])
                <form action="{{ route('review.save') }}" method="POST">
                    @csrf
                    <input type="hidden" name="productId" value="{{ $viewData['product']->getId() }}">
                    <input type="text" class="form-control mb-2" placeholder="Enter Comment" name="comment"
                        value="{{ old('comment') }}" />
                    <input type="number" min="1" max="5" class="form-control mb-2" placeholder="Enter Rating (1-5)"
                        name="rating" value="{{ old('rating') }}" />
                    <input type="submit" class="btn btn-primary d-block mx-auto" value="Create Review">
                </form>
                @else
                <form method="POST"
                    action="{{ route('review.update', ['id' => $viewData['existingReview']->getId()]) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Comment:</label>
                        <input type="text" class="form-control" placeholder="Enter Comment" name="comment"
                            value="{{ $viewData['existingReview']->getComment() }}" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rating:</label>
                        <input type="number" min="1" max="5" class="form-control" placeholder="Enter Rating (1-5)"
                            name="rating" value="{{ $viewData['existingReview']->getRating() }}" />
                    </div>
                    <button type="submit" class="btn btn-primary d-block mx-auto">Edit Review</button>
                </form>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card" style="max-width: 600px;">
            <div class="card-header">User Reviews</div>
            <div class="card-body">
                <div class="row row-cols-1 g-4">
                    @foreach ($viewData["reviews"] as $review)
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">User: {{ $review->user->name }}</h6>
                                <p class="card-text">Rating: {{ $review->getRating() }}</p>
                                <p class="card-text">Comment: {{ $review->getComment() }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection