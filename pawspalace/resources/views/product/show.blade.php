@extends('layouts.app')

@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])

@section('content')
<div class="card mb-3">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="{{ asset('/storage/'.$viewData["product"]->getImage()) }}" class="img-fluid rounded-start">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">
                    {{ $viewData["product"]->getName() }} (${{ $viewData["product"]->getPrice() }})
                </h5>
                <p class="card-text">{{ $viewData["product"]->getDescription() }}</p>
                <form method="POST" action="{{ route('cart.add', ['id'=> $viewData['product']->getId()]) }}">
                    @csrf
                    <div class="row">
                        <div class="col-auto">
                            <div class="input-group col-auto">
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
            </div>
        </div>
    </div>
</div>
@endsection