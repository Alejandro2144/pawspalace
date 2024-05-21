@extends('layouts.app')

@section('content')

    <h1>Productos Aliados</h1>

    <div>
        <pre>{{ json_encode($viewData['recipes'], JSON_PRETTY_PRINT) }}</pre>
    </div>

@endsection
