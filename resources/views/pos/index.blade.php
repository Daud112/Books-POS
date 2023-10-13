@extends('dashboard')
@section('content')

<div class="row justify-content-center">
    <h1 class="fs-3 text-dark text-center fw-bold my-5">Sales</h1>
    @include('layouts.partials.error')
    @include('layouts.partials.success')
    <div class="table-responsive p-5">
        <table class="table table-hover my-5">
            <thead>
                <tr>
                    <th scope="col">Products</th>
                    <th scope="col">Date</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Seller</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $sale)
                    <tr>
                        <td> 
                          @foreach($sale->productSales as $product) 
                            <div>{{$product->title}}</div>
                          @endforeach
                        </th>
                        <td> {{ $sale->sale_datetime }} </th>    
                        <td> {{ $sale->customer->name }} </th>
                        <td> {{ $sale->user->name }} </th>
                        <td>
                            <button type="button" class="btn btn-dark d-flex my-1">
                                <a href="{{ route('show-sale',[$sale->id]) }}">View</a>
                            </button>
                            <button type="button" class="btn btn-success">
                                <a href="{{ route('edit-product', [$product->id]) }}">Edit</a>
                            </button>
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection