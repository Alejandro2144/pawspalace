@extends('layouts.admin')

@section('title', $viewData["title"])

@section('content')
<div class="bg-gray-100 min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="card shadow-lg rounded-lg overflow-hidden">
            <div class="card-header bg-gradient-to-r from-blue-500 to-purple-600 p-6">
                <h2 class="font-semibold text-2xl text-black leading-tight text-center">
                    {{ __('Admin Panel - Home Page') }}</h2>
            </div>
            <div class="card-body bg-white p-6">
                <p class="text-lg text-gray-700 mb-4">
                    {{ __('Welcome to the Admin Panel! Here, you have access to various functionalities to manage the system efficiently.') }}
                </p>
                <p class="text-lg text-gray-700">
                    {{ __('Feel free to navigate through the options provided in the sidebar to accomplish your tasks effectively.') }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection