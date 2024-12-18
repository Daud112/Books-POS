@extends('dashboard')
@section('content')

<div class="row justify-content-center my-4">
    <div class="col-md-4 product-cover-image">
        <img src="{{asset('cover_images/'. $product->cover_image_path)}}" class="rounded" width="100%" height="600px" alt="Book Cover Image">
    </div>
    <div class="col-md-8">
        <div class="fs-3 text-dark text-center fw-bold my-3">{{ $product->title }}</div>
        <div class="fs-4 text-dark text-left fw-bold my-3">General Info:</div>
        <table class="table table-striped table-hover">
            <tbody>
                <tr>
                    <td> <span class="fw-bold">Code/ISBN</span> </td>
                    <td> {{ $product->isbn }} </td>
                </tr>
                @if($product->author)
                    <tr>
                        <td> <span class="fw-bold">Author</span> </td>
                        <td> {{ $product->author }} </td>
                    </tr>
                    @if($product->genre)
                        <tr>
                            <td> <span class="fw-bold">Genre</span> </td>
                            <td> {{ $product->genre }} </td>
                        </tr>
                    @endif
                    @if($product->publisher)
                        <tr>
                            <td> <span class="fw-bold">Publisher</span> </td>
                            <td> {{ $product->publisher }} </td>
                        </tr>
                    @endif
                    @if($product->published_date)
                        <tr>
                            <td> <span class="fw-bold">Published Date</span> </td>
                            <td> {{ $product->published_date }} </td>
                        </tr>
                    @endif
                    
                @endif
                <tr>
                    <td> <span class="fw-bold">Status</span> </td>
                    <td> {{ $product->status }} </td>
                </tr>
                <tr>
                    <td> <span class="fw-bold">Created at</span> </td>
                    <td> {{ $product->created_at }} </td>
                </tr>
                <tr>
                    <td> <span class="fw-bold">Updated at</span> </td>
                    <td> {{ $product->updated_at }} </td>
                </tr>
            </tbody>
        </table>
        <div class="alert alert-secondary my-4 app-buttons-text fw-bold fs-5" role="alert">
            <span class="">Avaible Stock:</span> 
            @if($product->type == 'custom')
            <span class="border rounded-5 px-3 py-2  app-buttons text-white">Fix</span>
            @else
                {{ $product->quantity }}
            @endif
        </div>
        <div class="card my-5 text-center fw-bold fs-6">
            <div class="card-header ">
              Price & Profit
            </div>
            <div class="card-body row ">
                <div class="col-md-4 ">
                    <div>Your Buy Price</div>
                    <div class="app-buttons-text fs-4 mt-3">Rs {{ $product->buy_price }} </div>
                </div>
                <div class="col-md-4 ">
                    <div>Your Sale Price</div>
                    <div class="app-buttons-text fs-4 mt-3">Rs {{ $product->sale_price }} </div>
                </div>
                {{-- <div class="col-md-3 ">
                    <div>Discount on Sale</div>
                    <div class="app-buttons-text fs-4 mt-3">Rs {{ $product->disc ?? 0}} </div>
                </div> --}}
                @if($product->type !== 'custom')
                    <div class="col-md-4 ">
                        <div>Your Profit</div>
                        <div class="app-buttons-text fs-4 mt-3">Rs {{ ($product->sale_price-$product->buy_price-$product->disc)*$product->quantity }} </div>
                    </div>
                @endif
            </div>
          </div>
    </div>
</div>
<div class="row d-flex align-items-center justify-content-center">
    <div class="col-1">
        @if($auth_user->hasPermissionTo('edit product'))
            <button type="button" class="btn btn-success w-100">
                <a href="{{ route('edit-product', [$product->id]) }}">Edit</a>
            </button>
        @endif
    </div>
    {{-- <div class="col-1">
        <button type="button" class="btn btn-danger w-100">Delete</button>
    </div> --}}
</div>
@endsection