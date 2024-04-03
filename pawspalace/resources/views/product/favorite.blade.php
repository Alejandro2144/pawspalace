@extends('layouts.app')

@section('title', 'Favorite Products')

@section('content')
<div class="container">
    <h1>Your Favorite Products</h1>

    @if ($favorites->isEmpty())
    <p>No favorite products found.</p>
    @else
    <div class="row">
        @foreach ($favorites as $favorite)
        <div class="col-md-3 mb-4">
            <div class="card">
                <img src="{{ asset('/storage/' . $favorite->image) }}" class="card-img-top" alt="{{ $favorite->name }}" style="width: 100%; height: 100%; object-fit: contain; max-height: 180px;">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $favorite->name }}</h5>
                    <a href="{{ route('product.show', ['id' => $favorite->id]) }}" class="custom-button">View
                        Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection