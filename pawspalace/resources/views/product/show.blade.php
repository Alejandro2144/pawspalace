@extends('layouts.app')

@section('title', __('Product Details - PawsPalace'))
@section('subtitle', __('Product Details'))

@section('content')

<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="pawspalace\resources\js\heart.js"></script>
</head>

<div class="breadcrumb">
    <ul>
        @foreach ($viewData['breadcrumbs'] as $breadcrumb)
            <li><a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['nombre'] }}</a></li>
        @endforeach
        <li>{{ __('Detalles del Producto') }}</li>
    </ul>
</div>

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
                <form method="POST" action="{{ route('cart.add.product', ['id'=> $viewData['product']->getId()]) }}">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-auto">
                            <div class="input-group">
                                <div class="input-group-text user-reviews-bg">{{ __('Quantity') }}</div>
                                <input type="number" min="1" max="10" class="form-control quantity-input"
                                    name="quantity" value="1">
                            </div>
                        </div>
                        <div class="col-auto">
                            <button class="custom-button" type="submit">{{ __('Add to cart') }}</button>
                        </div>
                    </div>
                </form>
                <form method="POST" action="{{ route('product.saveFavorite') }}">
                    @csrf
                    <input type="hidden" name="productId" value="{{ $viewData['product']->getId() }}">
                    <div class="col-auto mt-1 text-center">
                        <button type="submit"
                            class="btn heart-btn {{ $viewData['product']->favoritedByUsers()->where('user_id', auth()->id())->exists() ? 'clicked' : '' }}">
                            <i class="fas fa-heart heart-icon fa-lg"></i>
                        </button>
                    </div>
                </form>
                <hr>
                @if (!$viewData["existingReview"])
                <h4 class="text-center">{{ __('Create Review') }}</h4>
                @else
                <h4 class="text-center">{{ __('Edit Your Review') }}</h4>
                @endif

                @if (!$viewData["existingReview"])
                <form action="{{ route('review.save') }}" method="POST">
                    @csrf
                    <input type="hidden" name="productId" value="{{ $viewData['product']->getId() }}">
                    <input type="text" class="form-control mb-2" placeholder="{{ __('Enter Comment') }}" name="comment"
                        value="{{ old('comment') }}" />
                    <input type="number" min="1" max="5" class="form-control mb-2"
                        placeholder="{{ __('Enter Rating (1-5)') }}" name="rating" value="{{ old('rating') }}" />
                    <input type="submit" class="custom-button" value="{{ __('Create Review') }}">
                </form>
                @else
                <form method="POST"
                    action="{{ route('review.update', ['id' => $viewData['existingReview']->getId()]) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="productId" value="{{ $viewData['product']->getId() }}">
                    <div class="mb-3">
                        <label class="form-label">{{ __('Comment') }}:</label>
                        <input type="text" class="form-control" placeholder="{{ __('Enter Comment') }}" name="comment"
                            value="{{ $viewData['existingReview']->getComment() }}" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Rating') }}:</label>
                        <input type="number" min="1" max="5" class="form-control"
                            placeholder="{{ __('Enter Rating (1-5)') }}" name="rating"
                            value="{{ $viewData['existingReview']->getRating() }}" />
                    </div>
                    <button type="submit" class="custom-button">{{ __('Edit Review') }}</button>
                </form>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card" style="max-width: 600px;">
            <div class="card-header user-reviews-bg"><strong>{{ __('User Reviews') }}</strong></div>
            <div class="card-body">
                <div class="row row-cols-1 g-4">
                    @foreach ($viewData["reviews"] as $review)
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">{{ __('User') }}: {{ $review->user->getName() }}</h6>
                                <p class="card-text">{{ __('Rating') }}: {{ $review->getRating() }}</p>
                                <p class="card-text">{{ __('Comment') }}: {{ $review->getComment() }}</p>
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