@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center mb-4">Highlighted Products by Review Ratings</h2>

            <div class="row">
                @foreach ($viewData['highlightedProducts'] as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('/storage/'.$product->getImage()) }}" class="card-img-top img-fluid"
                            alt="{{ $product->name }}" style="max-width: 50%;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->getName() }}</h5>
                            <p class="card-text">Average Rating: {{ number_format($product->average_rating, 1) }}</p>
                            <a href="{{ route('product.show', ['id' => $product->id]) }}" class="btn btn-primary">View
                                Details</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection