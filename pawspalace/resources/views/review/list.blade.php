@extends('layouts.app')
@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="row">
    @foreach ($viewData["reviews"] as $review)
    <div class="col-md-4 col-lg-3 mb-2">
        <div class="card">
            <img src="https://mascolombia.com/wp-content/uploads/2023/07/colombia-ahora-produce-mas-productos-para-mascotas-y-crecen-las-oportunidades-para-exportar.jpg"
                class="card-img-top img-card">
            <div class="card-body text-center">
                <a href="{{ route('review.show', ['id'=> $review["id"]])}}" class="btn bg-primary text-white"> ID:
                    {{ $review->getId() }} <br> Rating: {{ $review->getRating() }}</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection