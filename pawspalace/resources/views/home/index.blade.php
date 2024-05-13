@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center mb-4">{{ __('Highlighted Products by Review Ratings') }}</h2>

            <div class="row">
                @foreach ($viewData['highlightedProducts'] as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('/storage/'.$product->getImage()) }}" class="card-img-top mx-auto d-block"
                            alt="{{ $product->name }}" style="max-width: 50%;">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $product->getName() }}</h5>
                            <p class="card-text ">{{ __('Average Rating') }}:
                                {{ number_format($product->average_rating, 1) }}</p>
                            <a href="{{ route('product.show', ['id' => $product->id]) }}" class="custom-button"
                                style="text-decoration: none;">{{ __('View Details') }}</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection