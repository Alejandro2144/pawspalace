@extends('layouts.admin')
@section('title', $viewData["title"])
@section('content')

<div class="card">
    <div class="card-header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Admin Panel - Home Page</h2>
    </div>
    <div class="card-body">
        <p class="text-lg">Welcome to the Admin Panel! Here, you have access to various functionalities to manage the
            system efficiently.</p>
        <p class="text-lg">Feel free to navigate through the options provided in the sidebar to accomplish your tasks
            effectively.</p>
    </div>
</div>
@endsection