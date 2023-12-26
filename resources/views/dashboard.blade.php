@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Overview</li>
    </ol>
</nav>
<h1 class="h2">Dashboard</h1>
<p>This is the homepage of a simple admin interface which is part of a test written Jonathan Sanchez</p>
<div class="row my-4">
    <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0">
        <div class="card">
            <h5 class="card-header">Orders</h5>
            <div class="card-body">
              <h5 class="card-title">Total: {{$countOrdersAll}}</h5>
            </div>
          </div>
    </div>
    <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
        <div class="card">
            <h5 class="card-header">Orders Pending</h5>
            <div class="card-body">
              <h5 class="card-title">{{$countOrdersPending}}</h5>
            </div>
          </div>
    </div>
    <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
        <div class="card">
            <h5 class="card-header">Orders Success</h5>
            <div class="card-body">
              <h5 class="card-title">{{$countOrdersSuccess}}</h5>
            </div>
          </div>
    </div>
    <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
        <div class="card">
            <h5 class="card-header">Sellers</h5>
            <div class="card-body">
              <h5 class="card-title">Total: {{$countSellersAll}}</h5>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-xl-12 mb-4 mb-lg-0">
        <div class="card">
            <h5 class="card-header">Latest transactions</h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">OrderId</th>
                            <th scope="col">Seller</th>
                            <th scope="col">Order State</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Date expiration</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($ordersLatest as $order)
                          <tr>
                            <th scope="row">{{$order->id}}</th>
                            <td>{{$order->seller->name}}</td>
                            <td>{{$order->orderState->name}}</td>
                            <td>{{$order->amount}}</td>
                            <td>{{$order->date_expiration}}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                </div>
                <a href="#" class="btn btn-block btn-light">View all</a>
            </div>
        </div>
    </div>
</div>
@endsection
