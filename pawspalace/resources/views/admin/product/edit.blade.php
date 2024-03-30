@extends('layouts.admin')
@section('title', $viewData["title"])

@section('content')
<div class="card mb-4">
    <div class="card-header">
        Edit Product
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
                    <label class="form-label">Name:</label>
                    <input name="name" value="{{ $viewData['product']->getName() }}" type="text" class="form-control">
                </div>
                <div class="col">
                    <label class="form-label">Price:</label>
                    <input name="price" value="{{ $viewData['product']->getPrice() }}" type="number"
                        class="form-control">
                </div>
                <div class="col">
                    <label class="form-label">Stock:</label>
                    <input name="stock" value="{{ $viewData['product']->getStock() }}" type="number"
                        class="form-control">
                </div>
                <div class="col">
                    <label class="form-label">Category:</label>
                    <select name="category" class="form-control">
                        <option value="">Select category</option>
                        <option value="Alimentos"
                            {{ ($viewData['product']->getCategory() == 'Alimentos' || old('category') == 'Alimentos') ? 'selected' : '' }}>
                            Alimentos</option>
                        <option value="Medicamentos"
                            {{ ($viewData['product']->getCategory() == 'Medicamentos' || old('category') == 'Medicamentos') ? 'selected' : '' }}>
                            Medicamentos</option>
                        <option value="Accesorios"
                            {{ ($viewData['product']->getCategory() == 'Accesorios' || old('category') == 'Accesorios') ? 'selected' : '' }}>
                            Accesorios</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Image:</label>
                    <input class="form-control" type="file" name="image">
                </div>
                <div class="col">&nbsp;</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description"
                    rows="3">{{ $viewData['product']->getDescription() }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Edit</button>
        </form>
    </div>
</div>
@endsection