@extends('layouts.admin')
@section('title', $viewData["title"])

@section('content')
<div class="card mb-4">
    <div class="card-header">
        {{ __('Edit Product') }}
    </div>
    <div class="card-body">
        @if($errors->any())
        <ul class="alert alert-danger list-unstyled">
            @foreach($errors->all() as $error)
            <li>- {{ $error }}</li>
            @endforeach
        </ul>
        @endif

        <form method="POST" action="{{ route('admin.product.update', ['id'=> $viewData['product']->getId()]) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">{{ __('Name') }}:</label>
                    <input name="name" value="{{ $viewData['product']->getName() }}" type="text" class="form-control">
                </div>
                <div class="col">
                    <label class="form-label">{{ __('Price') }}:</label>
                    <input name="price" value="{{ $viewData['product']->getPrice() }}" type="number"
                        class="form-control">
                </div>
                <div class="col">
                    <label class="form-label">{{ __('Stock') }}:</label>
                    <input name="stock" value="{{ $viewData['product']->getStock() }}" type="number"
                        class="form-control">
                </div>
                <div class="col">
                    <label class="form-label">{{ __('Category') }}:</label>
                    <select name="category" class="form-control">
                        <option value="">{{ __('Select category') }}</option>
                        <option value="Alimentos"
                            {{ ($viewData['product']->getCategory() == 'Alimentos' || old('category') == 'Alimentos') ? 'selected' : '' }}>
                            {{ __('Food') }}</option>
                        <option value="Medicamentos"
                            {{ ($viewData['product']->getCategory() == 'Medicamentos' || old('category') == 'Medicamentos') ? 'selected' : '' }}>
                            {{ __('Medicines') }}</option>
                        <option value="Accesorios"
                            {{ ($viewData['product']->getCategory() == 'Accesorios' || old('category') == 'Accesorios') ? 'selected' : '' }}>
                            {{ __('Accessories') }}</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">{{ __('Image') }}:</label>
                    <input class="form-control" type="file" name="image">
                </div>
                <div class="col">&nbsp;</div>
            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('Description') }}</label>
                <textarea class="form-control" name="description"
                    rows="3">{{ $viewData['product']->getDescription() }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Edit') }}</button>
        </form>
    </div>
</div>
@endsection