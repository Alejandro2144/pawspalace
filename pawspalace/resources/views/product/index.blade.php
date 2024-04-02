@extends('layouts.app')

@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])

@section('content')
<div class="row justify-content-end mb-3">
    <div class="col-md-4 col-lg-3">
        <form class="form-inline my-2 my-lg-0 float-right">
        <input name="query" class="form-control mr-sm-2" type="search" placeholder="Search by name" aria-label="Search" value="{{ $viewData['query'] }}">
            <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</div>

<div class="row">
    @foreach ($viewData["products"] as $product)
    <div class="col-md-4 col-lg-3">
        <div class="card">
            <img src="{{ asset('/storage/'.$product->getImage()) }}" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title">{{ $product->getName() }}</h5>
                <div class="text-center mb-2">
                    <a href="{{ route('product.show', ['id'=> $product->getId()]) }}" class="btn btn-primary btn-sm">View Product</a>
                </div>
                <div class="text-center">
                    <a href="{{ route('review.create', ['productId' => $product->getId()]) }}" class="btn btn-primary btn-sm">Manage Review</a>
                    <a href="{{ route('review.list', ['product_id' => $product->getId()]) }}" class="btn btn-primary btn-sm">Product Reviews</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
