@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', "Información de reseña")
@section('content')
<div class="card mb-3">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="https://mascolombia.com/wp-content/uploads/2023/07/colombia-ahora-produce-mas-productos-para-mascotas-y-crecen-las-oportunidades-para-exportar.jpg"
                class="img-fluid rounded-start">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">Valoración: {{ $viewData["review"]->getRating() }}</h5>
                <p class="card-text"> Comentario: {{ $viewData["review"]->getComment() }}</p>
            </div>
            <form action="{{ route('review.delete', ['id' => $viewData["review"]["id"]]) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger" style="margin-left: 15px;">Borrar</button>
            </form>
        </div>
    </div>
</div>
@endsection