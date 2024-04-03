@extends('layouts.app')
@section('title', $viewData['title'])
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Book now</div>
          <div class="card-body">
            @if($errors->any())
            <ul id="errors" class="alert alert-danger list-unstyled">
              @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
            @endif

            <form method="POST" action="{{ route('appointment.save') }}">
              @csrf
              <input type="text" class="form-control mb-2" placeholder="enter date for appointment" name="date" value="{{ old('date') }}" />
              <input type="text" class="form-control mb-2" placeholder="enter status for appointment" name="status" value="{{ old('status') }}" />
              <input type="text" class="form-control mb-2" placeholder="enter duration for appointment" name="duration" value="{{ old('duration') }}" />
              <input type="text" class="form-control mb-2" placeholder="enter price for appointment" name="price" value="{{ old('price') }}" />
              <input type="text" class="form-control mb-2" placeholder="enter modality of appointment" name="modality" value="{{ old('modality') }}" />
              <input type="submit" class="btn btn-primary" value="Send" />
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection