@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('sellers.index')}}">Sellers</a></li>
        <li class="breadcrumb-item active" aria-current="page">List</li>
    </ol>
</nav>
<h1 class="h2 mb-4">List Sellers</h1>
<div class="row">
    <div class="col-12 col-xl-12 mb-4 mb-lg-0">
        <div class="card">


            <div class="card-header">
              <div class="row">
                <div class="col-3 col-xl-3 mb-4 mb-lg-0" style="padding-right: 0">
                  <h5 class="card-header">Latest transactions <a href="{{route('sellers.create')}}" class="btn btn-primary">New +</a></h5>
                </div>
                <div class="col-9 col-xl-9 mb-4 mb-lg-0 card-header">
                  <form method="GET" action="{{route('sellers.index')}}">
                    
                    <div class="row">
                    
                      <div class="col-6 col-xl-6 mb-4 mb-lg-0">
                      </div>

                      <div class="col-3 col-xl-3 mb-4 mb-lg-0">
                        <input name="name" type="text" class="form-control" id="id" placeholder="Name Seller" value="{{request()->get('name')}}">
                      </div>

                      <div class="col-3 col-xl-3 mb-4 mb-lg-0">
                        <div class="row">
                          <div class="col-8 col-xl-8 mb-4 mb-lg-0">
                            <input name="id" type="number" class="form-control" id="id" placeholder="ID Seller" value="{{request()->get('id')}}">
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
                            <th scope="col">SellerId</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($sellers as $seller)
                          <tr>
                            <th scope="row">{{$seller->id}}</th>
                            <td>{{$seller->name}}</td>
                            <td>{{$seller->email}}</td>
                            <td style="text-align: right">
                              <a href="{{route('sellers.show', $seller)}}" class="btn btn-sm btn-secondary">view</a>
                              <a href="{{route('sellers.edit', $seller)}}" class="btn btn-sm btn-primary">edit</a>

                              <form method="POST" action="{{route('sellers.destroy', $seller)}}" style="display: inline">
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
