@extends('layouts.admin')
@section('title', $viewData["title"])

@section('content')
<div class="card mb-4">
    <div class="card-header">
        {{ __('Edit Appointment') }}
    </div>
    <div class="card-body">
        @if($errors->any())
        <ul class="alert alert-danger list-unstyled">
            @foreach($errors->all() as $error)
            <li>- {{ $error }}</li>
            @endforeach
        </ul>
        @endif

        <form method="POST" action="{{ route('admin.appointment.update', ['id'=> $viewData['appointment']->getId()]) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">{{ __('Status') }}:</label>
                    <select name="status" class="form-control">
                        <option value="">{{ __('Select status') }}</option>
                        <option value="Pendiente"
                            {{ ($viewData['appointment']->getStatus() == 'Pendiente' || old('status') == 'Pendiente') ? 'selected' : '' }}>
                            {{ __('Pending') }}</option>
                        <option value="Confirmada"
                            {{ ($viewData['appointment']->getStatus() == 'Confirmada' || old('status') == 'Confirmada') ? 'selected' : '' }}>
                            {{ __('Confirmed') }}</option>
                        <option value="Cancelada"
                            {{ ($viewData['appointment']->getStatus() == 'Cancelada' || old('status') == 'Cancelada') ? 'selected' : '' }}>
                            {{ __('Canceled') }}</option>
                        <option value="Completada"
                            {{ ($viewData['appointment']->getStatus() == 'Completada' || old('status') == 'Completada') ? 'selected' : '' }}>
                            {{ __('Completed') }}</option>
                    </select>
                </div>
                <div class="col">
                    <label class="form-label">{{ __('Price') }}:</label>
                    <input name="price" value="{{ $viewData['appointment']->getPrice() }}" type="number"
                        class="form-control">
                </div>
                <div class="col">
                    <label class="form-label">{{ __('Date') }}:</label>
                    <input name="date" value="{{ $viewData['appointment']->getDate() }}" type="text"
                        class="form-control">
                </div>
                <div class="col">
                    <label class="form-label">{{ __('Time') }}:</label>
                    <input name="time" value="{{ $viewData['appointment']->getTime() }}" type="text"
                        class="form-control">
                </div>
                <div class="col">
                    <label class="form-label">{{ __('Duration (minutes)') }}:</label>
                    <input name="duration" value="{{ $viewData['appointment']->getDuration() }}" type="number"
                        class="form-control">
                </div>
                <div class="col">
                    <label class="form-label">{{ __('Modality') }}:</label>
                    <select name="modality" class="form-control">
                        <option value="">{{ __('Select modality') }}</option>
                        <option value="Virtual"
                            {{ ($viewData['appointment']->getModality() == 'Virtual' || old('modality') == 'Virtual') ? 'selected' : '' }}>
                            {{ __('Virtual') }}</option>
                        <option value="At home"
                            {{ ($viewData['appointment']->getModality() == 'At home' || old('modality') == 'At home') ? 'selected' : '' }}>
                            {{ __('At home') }}</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('Edit') }}</button>
        </form>
    </div>
</div>
@endsection