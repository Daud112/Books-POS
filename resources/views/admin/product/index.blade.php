@extends('dashboard')
@section('content')

<div class="row justify-content-center">
    <div class="table-responsive p-5">
        <table class="table table-hover my-5">
            <thead>
                <tr>
                    <th scope="col">Cover Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">ISBN</th>
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
                            <img src="{{asset('cover_images/'. $product->cover_image_path)}}" class="img-thumbnail rounded float-start" width="200" height="200" alt="Book Cover Image">
                        </th>
                        <td> {{ $product->title }} </th>
                        <td> {{ $product->isbn }} </th>
                        <td> {{ $product->sale_price }} </th>    
                        <td> {{ $product->disc }} </th>
                        <td> {{ $product->quantity }} </th>
                        <td>
                            <button type="button" class="btn btn-dark d-flex my-1">
                                <a href="{{ route('show-product', [$product->id]) }}">View</a>
                            </button>
                            <button type="button" class="btn btn-dark">
                                <a href="{{ route('show-product', [$product->id]) }}">Edit</a>
                            </button>
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection