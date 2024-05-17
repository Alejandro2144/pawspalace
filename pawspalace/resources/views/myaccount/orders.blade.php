@extends('layouts.app')

@section('title', __('My Orders - PawsPalace'))
@section('subtitle', __('My Orders'))

@section('content')
@forelse ($viewData["orders"] as $order)
<div class="card mb-4">
    <div class="card-header user-reviews-bg">
        <strong>{{ __('Order #') }}{{ $order->getId() }}</strong>
    </div>
    <div class="card-body">
        <b>{{ __('Date:') }}</b> {{ $order->getCreatedAt() }}<br />
        <b>{{ __('Total:') }}</b> ${{ $order->getTotal() }}<br />
        <table class="table table-bordered table-striped text-center mt-3">
            <thead>
                <tr>
                    <th scope="col">{{ __('Item ID') }}</th>
                    <th scope="col">{{ __('Name') }}</th>
                    <th scope="col">{{ __('Price') }}</th>
                    <th scope="col">{{ __('Quantity') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->getItems() as $item)
                <tr>
                    <td>{{ $item->getId() }}</td>
                    <td>
                        @if ($item->getProduct())
                        <a class="link-success"
                            href="{{ route('product.show', ['id'=> $item->getProduct()->getId()]) }}">
                            {{ $item->getProduct()->getName() }}
                        </a>
                        @elseif ($item->getAppointment())
                        {{ $item->getAppointment()->getModality() }}
                        @else
                        {{ __('Item not found') }}
                        @endif
                    </td>
                    <td>${{ $item->getPrice() }}</td>
                    <td>{{ $item->getQuantity() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@empty
<div class="alert alert-danger" role="alert">
    {{ __('Seems to be that you have not purchased anything in our store.') }}
</div>
@endforelse
@if(!$viewData["orders"]->isEmpty())
<div class="card mb-4">
    <div class="card-header user-reviews-bg text-center">
        <b>Generate Reports</b>
    </div>
    <div class="table table-bordered table-striped text-center mt-2">
        <p>Choose the report format:</p>
        <form action="{{ route('orders.reports') }}" method="GET">
            <div style="padding-right: 250px; padding-left: 250px">
                <select name="format" id="format" class="form-select text-center border">
                    <option value="pdf">PDF</option>
                    <option value="excel">Excel</option>
                </select>
            </div>
            <button class="custom-button mt-3" type="submit">Generate Report</button>
        </form>
    </div>
</div>
@else
<div class="table table-bordered table-striped mt-2">
    <div class="alert alert-danger" role="alert">
        {{ __('It is not possible to generate a report because you have no orders.') }}
    </div>
</div>
@endif

@endsection