@extends('dashboard')
@section('content')

<div class="row justify-content-center">
    <h1 class="fs-3 text-dark text-center fw-bold my-5">Products List</h1>
    <div class="px-5 pt-5 d-flex justify-content-end">
        <button type="button" class="btn btn-primary">
            <a class="m-2 m-sm-2 m-md-3 m-xl-3" href="{{ route('product-create') }}">+ Add Product</a>
        </button>
    </div>
    @include('layouts.partials.error')
    @include('layouts.partials.success')
    <div class="table-responsive p-5">
        <table class="table table-hover my-5">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">ISBN/Barcode</th>
                    <th scope="col">Sale Price</th>
                    <th scope="col">Disc</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td> 
                            <img src="{{asset('cover_images/'. $product->cover_image_path)}}" class="img-thumbnail rounded float-start" width="100" height="100" alt="Book Cover Image">
                        </th>
                        <td> {{ $product->title }} </th>
                        <td> {{ $product->isbn }} </th>
                        <td> {{ $product->sale_price }} </th>    
                        <td> {{ $product->disc }} </th>
                        <td> 
                            @if($product->quantity == -1)
                                <span class="border rounded-5 p-2 bg-success text-white">Fix</span>
                            @else
                                <span class="border rounded-5 px-3 py-1 bg-success text-white"> {{ $product->quantity }} </span>
                            @endif
                        </th>
                        <td>
                            <button type="button" class="btn btn-dark d-flex my-1">
                                <a href="{{ route('show-product', [$product->id]) }}">View</a>
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