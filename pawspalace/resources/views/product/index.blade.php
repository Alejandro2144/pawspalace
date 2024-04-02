@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])

@section('content')
<div class="row">
    @foreach ($viewData["products"] as $product)
    <div class="col-md-4 col-lg-3">
        <div class="card h-100">
            <img src="{{ asset('/storage/'.$product->getImage()) }}" class="card-img-top" style="height: 200px;">
            <div class="card-body d-flex flex-column justify-content-between align-items-center">
                <div class="text-center mb-auto">
                    <h5 class="card-title">{{ $product->getName() }}</h5>
                </div>
                <div>
                    <a href="{{ route('product.show', ['id'=> $product->getId()]) }}"
                        class="btn bg-primary text-black">View
                        Product</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection