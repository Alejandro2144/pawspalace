@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center mb-4">{{ __('Highlighted Products by Review Ratings') }}</h2>

            <div class="row">
                @foreach ($viewData['highlightedProducts'] as $product)
                <div class="col-md-4 col-lg-3">
                    <div class="card h-100">
                        <img src="{{ asset('/storage/'.$product->getImage()) }}" class="card-img-top"
                            style="width: 100%; height: 100%; object-fit: contain; max-height: 180px;">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $product->getName() }}</h5>
                            <p class="card-text ">{{ __('Average Rating') }}:
                                {{ number_format($product->average_rating, 1) }}</p>
                            <a href="{{ route('product.show', ['id' => $product->getId()]) }}" class="custom-button"
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