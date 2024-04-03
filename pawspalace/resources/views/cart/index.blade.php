@extends('layouts.app')

@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])

@section('content')
<div class="card">
    <div class="card-header">
        Products and Appointments in Cart
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($viewData["products"] as $product)
                <tr>
                    <td>{{ $product->getId() }}</td>
                    <td>{{ $product->getName() }}</td>
                    <td>${{ $product->getPrice() }}</td>
                    <td>{{ session('products')[$product->getId()] }}</td>
                    <td>
                        <form method="POST" action="{{ route('cart.remove', ['id'=> $product->getId()]) }}">
                            @csrf
                            <button class="btn btn-danger">Remove</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @foreach ($viewData["appointments"] as $appointment)
                <tr>
                    <td>{{ $appointment->getId() }}</td>
                    <td>{{ $appointment->getModality() }}</td>
                    <td>${{ $appointment->getPrice() }}</td>
                    <td>1</td>
                    <td>
                        <form method="POST" action="{{ route('cart.remove', ['id'=> $appointment->getId()]) }}">
                            @csrf
                            <button class="btn btn-danger">Remove</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="text-end">
            <a class="btn btn-outline-secondary mb-2"><b>Total to pay:</b> ${{ $viewData["total"] }}</a>
            @if (count($viewData["products"]) > 0 || count($viewData["appointments"]) > 0)
                <a href="{{ route('cart.purchase') }}" class="custom-button">Purchase</a>
                <a href="{{ route('cart.delete') }}">
                    <button class="btn btn-danger mb-2">
                        Remove all products and appointments from Cart
                    </button>
                </a>
            @endif  
            </div>
        </div>
    </div>
</div>
@endsection
