@extends('layouts.app')
@section('subtitle', $viewData['subtitle'])
@section('content')
<div class="row">
    @foreach ($viewData["reviews"] as $review)
    <div class="col-md-4 col-lg-3 mb-2">
        <div class="card">
            <div class="card-body text-center">
                <p>Rating: {{ $review->getRating() }}</p>
                <p>Comment: {{ $review->getComment() }}</p>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection