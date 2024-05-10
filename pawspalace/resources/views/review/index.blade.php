@extends('layouts.app')
@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="card text-center">
                <div class="card-header">
                    Review Options
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('review.create') }}"
                                class="btn btn-outline-primary btn-lg btn-block mb-3"> Create Review </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('review.list') }}" class="btn btn-outline-info btn-lg btn-block"> List
                                Reviews
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection