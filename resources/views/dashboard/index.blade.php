@extends('dashboard')
@section('content')
    <div class="row text-center justify-content-center m-5">
        <a class="col-4 p-5 m-2 bg-primary text-white fs-3" href="{{ route('create-sale') }}">POS</a>
        <a class="col-4 p-5 m-2 bg-warning text-white fs-3" href="{{ route('products') }}">Products</a>
        <a class="col-4 p-5 m-2 bg-success text-white fs-3" href="{{ route('users') }}">Users</a>
        <a class="col-4 p-5 m-2 bg-danger text-white fs-3" href="{{ route('customers') }}">Customers</a>
    </div>
@endsection