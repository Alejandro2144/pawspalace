@extends('layouts.app')

@section('title', __('Cart - PawsPalace'))
@section('subtitle', __('Shopping Cart'))

@section('content')
<div class="card">
    <div class="card-header">
        {{ __('Purchase Completed') }}
    </div>
    <div class="card-body">
        <div class="alert alert-success" role="alert">
            {{ __('Congratulations, purchase completed. Order number is') }} <b>#{{ $viewData["order"]->getId() }}</b>
        </div>
    </div>
</div>
@endsection