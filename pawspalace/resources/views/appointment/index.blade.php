@extends('layouts.app')
@section('title', __('Appointment - PawsPalace'))
@section('subtitle', __('Schedule appointmens'))

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-center header-cream">
                <strong>{{ __('Available Appointments') }}</strong>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Time') }}</th>
                                <th>{{ __('Duration') }}</th>
                                <th>{{ __('Modality') }}</th>
                                <th>{{ __('Actions') }}</th>
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
                                    <form method="POST"
                                        action="{{ route('cart.add.appointment', ['id'=> $appointment->getId()]) }}">
                                        @csrf
                                        <button class="custom-button">{{ __('Schedule') }}</button>
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