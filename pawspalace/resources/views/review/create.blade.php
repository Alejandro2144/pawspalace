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

<form action="{{ route('review.save') }}" method="POST">
    @csrf
    <input type="hidden" name="productId" value="{{ $viewData['productId'] }}">
    <input type="text" class="form-control mb-2" placeholder="Enter Comment" name="comment"
        value="{{ old('comment') }}" />
    <input type="number" min="1" max="5" class="form-control mb-2" placeholder="Enter Rating (1-5)" name="rating"
        value="{{ old('rating') }}" />
    <input type="submit" class="btn btn-primary" value="Create Review" />
</form>

@endsection