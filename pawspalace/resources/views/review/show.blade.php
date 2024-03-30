@extends('layouts.app')
@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="card mb-3">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="{{ asset('/storage/'.$viewData["product"]->getImage()) }}" class="img-fluid rounded-start">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h4 class="card-title"> Product: {{ $viewData["product"]->getName() }}</h4>
                <h6 class="card-text"> Rating: {{ $viewData["review"]->getRating() }}</h6>
                <h6 class="card-text"> Comment: {{ $viewData["review"]->getComment() }}</h6>
            </div>
            <a class="btn btn-primary mr-2" href="{{route('review.edit', ['id' => $viewData["review"]["id"]])}}">Edit
                Review</a>
            <form class="d-inline" action="{{ route('review.delete', ['id' => $viewData["review"]["id"]]) }}"
                method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete Review</button>
            </form>
        </div>
    </div>
</div>
@endsection