@extends('layouts.admin')
@section('title', $viewData["title"])
@section('content')
<div class="card mb-4">
    <div class="card-header">
        Create Appointments
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
                <label class="form-label">Status:</label>
                    <select name="status" class="form-control">
                        <option value="">Select modality</option>
                        <option value="Pendiente" {{ old('status') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="Confirmada" {{ old('status') == 'Confirmada' ? 'selected' : '' }}>Confirmada</option>
                        <option value="Cancelada" {{ old('status') == 'Cancelada' ? 'selected' : '' }}>Cancelada</option>
                        <option value="Completada" {{ old('status') == 'Completada' ? 'selected' : '' }}>Completada</option>
                    </select>
                </div>
                <div class="col">
                    <label class="form-label">Price:</label>
                    <input name="price" value="{{ old('price') }}" type="number" class="form-control">
                </div>
                <div class="col">
                    <label class="form-label">Reason:</label>
                    <input name="reason" value="{{ old('reason') }}" type="text" class="form-control">
                </div>
                <div class="col">
                    <label class="form-label">Modality:</label>
                    <select name="modality" class="form-control">
                        <option value="">Select modality</option>
                        <option value="Virtual" {{ old('modality') == 'Virtual' ? 'selected' : '' }}>Virtual
                        </option>
                        <option value="At home" {{ old('modality') == 'At home' ? 'selected' : '' }}>At home</option>
                    </select>
                </div>
                <div class="col">
                    <label class="form-label">Duration:</label>
                    <input name="duration" value="{{ old('duration') }}" type="number" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Image:</label>
                    <input class="form-control" type="file" name="image">
                </div>
                <div class="col"></div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        Manage Appointments
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Reason</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($viewData["appointments"] as $appointment)
                <tr>
                    <td>{{ $appointment->getId() }}</td>
                    <td>{{ $appointment->getReason() }}</td>
                    <td>
                        <a class="btn btn-primary"
                            href="{{route('admin.appointment.edit', ['id'=> $appointment->getId()])}}">Edit</a>
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