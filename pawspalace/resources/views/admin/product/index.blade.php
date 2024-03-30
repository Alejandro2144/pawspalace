@extends('layouts.admin')
@section('title', $viewData["title"])
@section('content')
<div class="card mb-4">
    <div class="card-header">
        Create Products
    </div>
    <div class="card-body">
        @if($errors->any())
        <ul class="alert alert-danger list-unstyled">
            @foreach($errors->all() as $error)
            <li>- {{ $error }}</li>
            @endforeach
        </ul>
        @endif
        <form method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Name:</label>
                    <input name="name" value="{{ old('name') }}" type="text" class="form-control">
                </div>
                <div class="col">
                    <label class="form-label">Price:</label>
                    <input name="price" value="{{ old('price') }}" type="number" class="form-control">
                </div>
                <div class="col">
                    <label class="form-label">Category:</label>
                    <select name="category" class="form-control">
                        <option value="">Select category</option>
                        <option value="Alimentos" {{ old('category') == 'Alimentos' ? 'selected' : '' }}>Alimentos
                        </option>
                        <option value="Medicamentos" {{ old('category') == 'Medicamentos' ? 'selected' : '' }}>
                            Medicamentos</option>
                        <option value="Accesorios" {{ old('category') == 'Accesorios' ? 'selected' : '' }}>Accesorios
                        </option>
                    </select>
                </div>
                <div class="col">
                    <label class="form-label">Stock:</label>
                    <input name="stock" value="{{ old('stock') }}" type="number" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Image:</label>
                    <input class="form-control" type="file" name="image">
                </div>
                <div class="col"></div>
            </div>
            <div class="mb-3">
                <label class="form-label">Description:</label>
                <textarea class="form-control" name="description" rows="3">{{ old('description') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        Manage Products
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($viewData["products"] as $product)
                <tr>
                    <td>{{ $product->getId() }}</td>
                    <td>{{ $product->getName() }}</td>
                    <td>
                        <a class="btn btn-primary"
                            href="{{route('admin.product.edit', ['id'=> $product->getId()])}}">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('admin.product.delete', $product->getId())}}" method="POST">
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