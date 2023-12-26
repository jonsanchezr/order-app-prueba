@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('orders.index')}}">Orders</a></li>
        <li class="breadcrumb-item active" aria-current="page">List</li>
    </ol>
</nav>
<h1 class="h2 mb-4">List Orders</h1>
<div class="row">
    <div class="col-12 col-xl-12 mb-4 mb-lg-0">
        <div class="card">


            <div class="card-header">
              <div class="row">
                <div class="col-3 col-xl-3 mb-4 mb-lg-0" style="padding-right: 0">
                  <h5 class="card-header">Latest transactions <a href="{{route('orders.create')}}" class="btn btn-primary">New +</a></h5>
                </div>
                <div class="col-9 col-xl-9 mb-4 mb-lg-0 card-header">
                  <form method="GET" action="{{route('orders.index')}}">
                    
                    <div class="row">
                    
                      <div class="col-3 col-xl-3 mb-4 mb-lg-0">
                        <select name="seller_id" id="seller_id" class="form-control">
                          <option value="">Select Seller</option>
                            @foreach ($sellers as $seller)
                            <option value="{{$seller->id}}" {{$seller->id == request()->get('seller_id') ? 'selected' : ''}}>{{$seller->name}}</option>
                            @endforeach
                        </select>
                      </div>

                      <div class="col-3 col-xl-3 mb-4 mb-lg-0">
                        <select name="order_state_id" id="order_state_id" class="form-control">
                          <option value="">Select Order State</option>
                            @foreach ($orderStates as $orderState)
                            <option value="{{$orderState->id}}" {{$orderState->id == request()->get('order_state_id') ? 'selected' : ''}}>{{$orderState->name}}</option>
                            @endforeach
                        </select>
                      </div>

                      <div class="col-3 col-xl-3 mb-4 mb-lg-0">
                        <input name="date_expiration" type="date" class="form-control" id="date_expiration" value="{{request()->get('date_expiration')}}">
                      </div>

                      <div class="col-3 col-xl-3 mb-4 mb-lg-0">
                        <div class="row">
                          <div class="col-8 col-xl-8 mb-4 mb-lg-0">
                            <input name="id" type="number" class="form-control" id="id" placeholder="ID Order" value="{{request()->get('id')}}">
                          </div>
                          <div class="col-4 col-xl-4 mb-4 mb-lg-0">
                            <button type="submit" class="btn btn-primary">Search</button>
                          </div>
                      </div>
                    
                    </div>
                  </form>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">OrderId</th>
                            <th scope="col">Seller</th>
                            <th scope="col">Order State</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Created</th>
                            <th scope="col">Date expiration</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($orders as $order)
                          <tr>
                            <th scope="row">{{$order->id}}</th>
                            <td>{{$order->seller->name}}</td>
                            <td>{{$order->orderState->name}}</td>
                            <td>{{$order->amount}}</td>
                            <td>{{$order->created_at}}</td>
                            <td>{{$order->date_expiration}}</td>
                            <td style="text-align: right">
                              <a href="{{route('orders.show', $order)}}" class="btn btn-sm btn-secondary">view</a>
                              <a href="{{route('orders.edit', $order)}}" class="btn btn-sm btn-primary">edit</a>

                              <form method="POST" action="{{route('orders.destroy', $order)}}" style="display: inline">
                                  @method('DELETE')
                                  @csrf
                                  <button type="submit" class="btn btn-sm btn-danger">delete</button>
                              </form>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
