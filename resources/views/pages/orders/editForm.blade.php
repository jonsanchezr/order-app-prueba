@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('orders.index')}}">Orders</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{isset($show) ? 'Show' : 'Edit'}}</li>
    </ol>
</nav>

<div class="row">
    <div class="col-12 col-xl-12 mb-4 mb-lg-0">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('orders.update', $order)}}">
                    @method('put')
                    @csrf

                    <div class="row">
                        <div class="col-6 col-xl-6 mb-4 mb-lg-0">
                            <div class="mb-3">
                                <label for="seller_id" class="form-label">Seller</label>
                                <select name="seller_id" id="seller_id" class="form-control" {{isset($show) ? 'disabled' : ''}} required>
                                    @foreach ($sellers as $seller)
                                    <option value="{{$seller->id}}" {{$seller->id == $order->seller_id ? 'selected' : ''}}>{{$seller->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-6 col-xl-6 mb-4 mb-lg-0">
                            <div class="mb-3">
                                <label for="order_state_id" class="form-label">Order State</label>
                                <select name="order_state_id" id="order_state_id" class="form-control" {{isset($show) ? 'disabled' : ''}} required>
                                    @foreach ($orderStates as $orderState)
                                    <option value="{{$orderState->id}}" {{$orderState->id == $order->order_state_id ? 'selected' : ''}}>{{$orderState->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 col-xl-6 mb-4 mb-lg-0">
                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount</label>
                                <input name="amount" type="number" class="form-control" id="amount" step="any" value="{{$order->amount}}" {{isset($show) ? 'disabled' : ''}} required>
                            </div>
                        </div>

                        <div class="col-6 col-xl-6 mb-4 mb-lg-0">
                            <div class="mb-3">
                                <label for="date_expiration" class="form-label">Date expiration</label>
                                <input name="date_expiration" type="date" class="form-control" id="date_expiration" value="{{substr($order->date_expiration, 0, 10)}}" {{isset($show) ? 'disabled' : ''}}>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-xl-12 mb-4 mb-lg-0">
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea id="description" name="description" rows="2" maxlength="255" class="form-control" {{isset($show) ? 'disabled' : ''}} required>{{$order->description}}</textarea>
                            </div>
                        </div>
                    </div>

                    <a href="{{route('orders.index')}}" class="btn btn-secondary">Return</a>
                    @if (!isset($show))
                    <button type="submit" class="btn btn-primary">Update</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
