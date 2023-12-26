@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('sellers.index')}}">Sellers</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{isset($show) ? 'Show' : 'Edit'}}</li>
    </ol>
</nav>

<div class="row">
    <div class="col-12 col-xl-12 mb-4 mb-lg-0">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('sellers.update', $seller)}}">
                    @method('put')
                    @csrf

                    <div class="row">
                        <div class="col-6 col-xl-6 mb-4 mb-lg-0">
                            <div class="mb-3">
                                <label for="name" class="form-label">name</label>
                                <input name="name" type="text" class="form-control" id="name" value="{{$seller->name}}" {{isset($show) ? 'disabled' : ''}} required>
                            </div>
                        </div>

                        <div class="col-6 col-xl-6 mb-4 mb-lg-0">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input name="email" type="email" class="form-control" id="email" value="{{$seller->email}}" {{isset($show) ? 'disabled' : ''}}>
                            </div>
                        </div>
                    </div>

                    <a href="{{route('sellers.index')}}" class="btn btn-secondary">Return</a>
                    @if (!isset($show))
                    <button type="submit" class="btn btn-primary">Update</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
