@extends('layouts.app')

@section('title', __('Product Details - PawsPalace'))
@section('subtitle', __('Product Details'))

@section('content')

    <h1>Productos Aliados</h1>
    
    <ul>
        @foreach($viewData['recipes'] as $recipe)
            <li>{{ $recipe['name'] }} - {{ $recipe['description'] }}</li>
        @endforeach
    </ul>

@endsection
