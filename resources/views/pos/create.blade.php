@extends('pos')
@section('content')
<main class="main-pos px-4">
    <div class="row d-flex justify-content-center my-3">
        <div class="text-success text-center fw-bold fs-3 my-2">POS</div>
        <span class="my-3 mx-5" >@include('layouts.partials.error')</span>
        <span class="my-3 mx-5" >@include('layouts.partials.success')</span>
        <div class="col-md-8 my-4">
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
        <div class="col-md-4 my-4 ">
          <div class="text-success text-center fw-bold fs-5 my-2">Billing</div>
          <div class="card">
            <div class="card-header">
              <div class="row">
                <span class="col-md-4"> Product </span>
                <span class="col-md-2"> Price </span>
                <span class="col-md-2"> Disc </span>
                <span class="col-md-2"> Qty </span>
                <span class="col-md-2"> Total </span>
              </div>
            </div>
            <div class="list-group list-group-flush">
              <form class="row" action="{{route('store.sale')}}" method="POST">
                @csrf
                @foreach($sale_products as $sale_product)
                  <div class="row bill-items-list bill-items-list-{{$sale_product->id}}">
                    <input type="hidden" class="form-control" name="saleproductId" value="{{$sale_product->id}}">
                    <span class="list-group-item col-md-4"> {{ $sale_product->title }} </span>
                    <span class="list-group-item col-md-2 bill-item-sale-price--{{$sale_product->id}}"> {{ $sale_product->sale_price }} </span>
                    <span class="list-group-item col-md-2 px-1">
                      <input type="number" id="inputsaleproductDisc" min="{{$sale_product->disc}}" class="form-control bill-item-disc--{{$sale_product->id}} item-disc" name="saleproductDisc" placeholder="1" value="{{$sale_product->disc}}">
                    </span>
                    <span class="list-group-item col-md-2 px-1"> 
                      <input type="number" id="inputsaleproductQty" class="form-control bill-item-qty--{{$sale_product->id}} item-qty" min="1" max="" name="saleproductQty" placeholder="1" value="{{ $sale_product->quantity }}">
                    </span>
                    <span class="list-group-item col-md-2 bill-item-total--{{$sale_product->id}} item-total"> {{ ($sale_product->sale_price-$sale_product->disc)*$sale_product->quantity }} </span>
                  </div>
                @endforeach
              </form>
                <div class="row bill-items-list">
                  <span class="list-group-item col-md-4"></span>
                  <span class="list-group-item col-md-2 bill-item-sale-price"> {{ $saletotal['total_product_price'] }} </span>
                  <span class="list-group-item col-md-2 bill-item-disc" > {{ $saletotal['total_disc'] }} </span>
                  <span class="list-group-item col-md-2 bill-item-qty"> {{ $saletotal['total_qty'] }} </span>
                  <span class="list-group-item col-md-2 bill-item-total"> {{ $saletotal['total_sale_price'] }} </span>
                </div>
            </div>
          </div>  
        </div>
    </div>
</main>
@endsection