@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])

@section('content')
<div class="row">
    @foreach ($viewData["products"] as $product)
    <div class="col-md-4 col-lg-3">
        <div class="card">
            <img src="{{ asset('/storage/'.$product->getImage()) }}" class="card-img-top">
            <div class="card-body text-center">
                <a href="{{ route('product.show', ['id'=> $product->getId()]) }}"
                    class="btn bg-primary text-black">{{ $product->getName() }}</a>
            </div>
            <div class="card-body text-center">
                <a href="{{ route('review.create', ['productId' => $product->getId()]) }}"
                    class="btn bg-primary text-black mb-2">Manage review</a>
            </div>
            <div class="card-body text-center">
                <a href="{{ route('review.list', ['product_id' => $product->getId()]) }}"
                    class="btn bg-primary text-black mb-2">Product reviews</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection