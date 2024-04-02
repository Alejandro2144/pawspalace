@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Available Appointments
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Duration</th>
                                <th>Modality</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($viewData["appointments"] as $appointment)
                            <tr>
                                <td>{{ $appointment->getDate() }}</td>
                                <td>{{ $appointment->getTime() }}</td>
                                <td>{{ $appointment->getDuration() }}</td>
                                <td>{{ $appointment->getModality() }}</td>
                                <td>
                                    <form method="POST" action="{{ route('cart.add', ['id'=> $appointment->getId()]) }}">
                                        @csrf
                                        <button class="btn btn-primary">Schedule</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
