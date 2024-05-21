@extends('layouts.admin')
@section('title', $viewData["title"])
@section('content')
<div class="card mb-4">
    <div class="card-header text-black">
        {{ __('Create Appointments') }}
    </div>
    <div class="card-body">
        @if($errors->any())
        <ul class="alert alert-danger list-unstyled">
            @foreach($errors->all() as $error)
            <li>- {{ $error }}</li>
            @endforeach
        </ul>
        @endif
        <form method="POST" action="{{ route('admin.appointment.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">{{ __('Status') }}:</label>
                    <select name="status" class="form-control">
                        <option value="">{{ __('Select Status') }}</option>
                        <option value="Pendiente" {{ old('status') == 'Pendiente' ? 'selected' : '' }}>
                            {{ __('Pending') }}</option>
                        <option value="Confirmada" {{ old('status') == 'Confirmada' ? 'selected' : '' }}>
                            {{ __('Confirmed') }}</option>
                        <option value="Cancelada" {{ old('status') == 'Cancelada' ? 'selected' : '' }}>
                            {{ __('Canceled') }}</option>
                        <option value="Completada" {{ old('status') == 'Completada' ? 'selected' : '' }}>
                            {{ __('Completed') }}</option>
                    </select>
                </div>
                <div class="col">
                    <label class="form-label">{{ __('Price') }}:</label>
                    <input name="price" value="{{ old('price') }}" type="number" class="form-control">
                </div>
                <div class="col">
                    <label class="form-label">{{ __('Date') }}:</label>
                    <input name="date" value="{{ old('date') }}" type="text" class="form-control">
                </div>
                <div class="col">
                    <label class="form-label">{{ __('Time') }}:</label>
                    <input name="time" value="{{ old('time') }}" type="text" class="form-control">
                </div>
                <div class="col">
                    <label class="form-label">{{ __('Modality') }}:</label>
                    <select name="modality" class="form-control">
                        <option value="">{{ __('Select modality') }}</option>
                        <option value="Virtual" {{ old('modality') == 'Virtual' ? 'selected' : '' }}>{{ __('Virtual') }}
                        </option>
                        <option value="At home" {{ old('modality') == 'At home' ? 'selected' : '' }}>{{ __('At home') }}
                        </option>
                    </select>
                </div>
                <div class="col">
                    <label class="form-label">{{ __('Duration (minutes)') }}:</label>
                    <input name="duration" value="{{ old('duration') }}" type="number" class="form-control">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ __('Manage Appointments') }}
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">{{ __('ID') }}</th>
                    <th scope="col">{{ __('Modality') }}</th>
                    <th scope="col">{{ __('Edit') }}</th>
                    <th scope="col">{{ __('Delete') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($viewData["appointments"] as $appointment)
                <tr>
                    <td>{{ $appointment->getId() }}</td>
                    <td>{{ $appointment->getModality() }}</td>
                    <td>
                        <a class="btn btn-primary"
                            href="{{route('admin.appointment.edit', ['id'=> $appointment->getId()])}}">{{ __('Edit') }}</a>
                    </td>
                    <td>
                        <form action="{{ route('admin.appointment.delete', $appointment->getId())}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger"><i class="bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection