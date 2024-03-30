@extends('layouts.app')
@section('subtitle', $viewData["subtitle"])
@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<form method="POST" action="{{ route('review.update', ['id' => $viewData['review']->getId()]) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Comment:</label>
        <input type="text" class="form-control" placeholder="Enter Comment" name="comment"
            value="{{ $viewData['review']->getComment() }}" />
    </div>
    <div class="mb-3">
        <label class="form-label">Rating:</label>
        <input type="number" min="1" max="5" class="form-control" placeholder="Enter Rating (1-5)" name="rating"
            value="{{ $viewData['review']->getRating() }}" />
    </div>

    <button type="submit" class="btn btn-primary">Edit Review</button>
</form>

@endsection