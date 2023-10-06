@extends('dashboard')
@section('content')
<main class="main-pos">
    <div class="row d-flex justify-content-center my-3">
        <h1 class="fs-3 text-dark text-center fw-bold my-2">Create New Product</h1>
        @include('layouts.partials.error')
        @include('layouts.partials.success')
        <div class="row my-4">
          <div class="col-md-8 ">
            <div class="row">
              @foreach ($products as $product)
                <div class="card sale-product p-0 mb-3 mx-1 border border-3 border-success rounded">
                  <img src="{{asset('cover_images/'. $product->cover_image_path)}}" width="100%" class="img-fluid rounded-start border-bottom rounded product-img" alt="...">
                  <div class="row">
                    <div class="card-body">
                      <div class="col-md-12 card-title fw-bold text-success text-center"> <a href="{{ route('show-product', [$product->id]) }}"> {{ $product->title }} </a></div>
                      <div class="col-md-12 card-isbn"><span class="fw-bold">ISBN:</span> {{ $product->isbn }}</div>
                      <div class="col-md-12 card-price">
                        <span class="fw-bold">Price:</span>
                        <span class="fs-6 text-decoration-line-through">Rs {{$product->sale_price }}</span>
                        <span class="fs-4 text-success text-decoration-none">Rs {{ $product->sale_price-$product->disc }}</span>
                      </div>
                      <form class="row" action="{{route('store.sale')}}" method="POST">
                        @csrf
                        <input type="hidden" class="form-control" name="productId" value="{{$product->id}}"> 
                        <span class="fw-bold">Quantity:</span>
                        <div class="col-8 col-sm-8 col-md-8 d-flex card-qty">
                          @if($product->quantity>0)         
                            <input type="number" id="inputQuantity" min="1" max="{{ $product->quantity }}" class="form-control w-50" name="productQty" placeholder="1" value="1"> 
                            <span class="d-flex"> <span>/</span> {{ $product->quantity }}</span>
                          @else
                            <div class="text-danger fw-bold">OUT OF STOCK</div>
                          @endif
                        </div>
                        <button type="submit" class="col-4 col-sm-4 col-md-4 button d-flex justify-content-end pe-3">
                          <img src="{{asset('icons/product-add-icon.svg')}}" width="40%" height="40%" class="" alt="Product-Add-Icon">
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
          <div class="col-md-4">Bill</div>
        </div>
    </div>
</main>
@endsection