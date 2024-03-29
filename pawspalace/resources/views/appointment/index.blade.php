@extends('layouts.app')

@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])

@section('content')
<div class="row">
    @foreach ($viewData['appointments'] as $appointment)
    <div class="col-md-4 col-lg-3 mb-2">
        <div class="card">
            <img src="https://mir-s3-cdn-cf.behance.net/project_modules/1400/e1dd5c19815449.562e0bbe27e94.png" class="card-img-top img-card">
            <div class="card-body">
                <p>{{ $appointment->getReason() }}</p>
                <p>{{ $appointment->getModality() }}</p>
                <a href="{{ route('appointment.show', ['id'=> $appointment->getId()]) }}" class="btn bg-primary text-black">show details</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection