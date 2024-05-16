@extends('layouts.app')

@section('title', __('Products - PawsPalace'))
@section('subtitle', __('List of products'))
@section('content')

<div class="breadcrumb">
    <ul>
        <li><a href="{{ route('home.index') }}">Inicio</a></li>
        <li>Productos</li>
    </ul>
</div>
<div class="row justify-content-between mb-3">
    <div class="col-md-4 col-lg-3">
        <form class="form-inline my-2 my-lg-0">
            <select name="category" id="category" class="form-control mr-2">
                <option value="">{{ __('Filter by Category') }}</option>
                <option value="alimentos">{{ __('Food') }}</option>
                <option value="medicamentos">{{ __('Medicine') }}</option>
                <option value="accesorios">{{ __('Accessories') }}</option>
            </select>
            <button class="custom-button" type="submit">{{ __('Filter') }}</button>
        </form>
    </div>
    <div class="col-md-4 col-lg-3">
        <form class="form-inline my-2 my-lg-0">
            <input name="query" class="form-control mr-sm-2" type="search" placeholder="{{ __('Search by name') }}"
                aria-label="{{ __('Search') }}" value="{{ $viewData['query'] }}">
            <button class="custom-button" type="submit">{{ __('Search') }}</button>
        </form>
    </div>
</div>
<div class="row">
    @foreach ($viewData["products"] as $product)
    <div class="col-md-4 col-lg-3">
        <div class="card h-100">
            <img src="{{ asset('/storage/'.$product->getImage()) }}" class="card-img-top"
                style="width: 100%; height: 100%; object-fit: contain; max-height: 180px;">
            <div class="card-body d-flex flex-column justify-content-between align-items-center">
                <div class="text-center mb-auto">
                    <h5 class="card-title">{{ $product->getName() }}</h5>
                </div>
                <div><br>
                    <a href="{{ route('product.show', ['id'=> $product->getId()]) }}" class="custom-button"
                        style="text-decoration: none;">{{ __('View Product') }}</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection