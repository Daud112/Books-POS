@extends('pos')
@section('content')

@php
  $productData = [];

  foreach ($products as $product) {
    $productData["Product_" . $product->id]["id"] = $product->id;
    $productData["Product_" . $product->id]["title"] = $product->title;
    $productData["Product_" . $product->id]["qty"] = $product->quantity;
  }
@endphp
<main class="main-pos px-4">
    <div class="row d-flex justify-content-center my-3">
        <div class="text-success text-center fw-bold fs-3 my-2">POS</div>
        <span class="my-3 mx-5" >@include('layouts.partials.error')</span>
        <span class="my-3 mx-5" >@include('layouts.partials.success')</span>
        <div class="col-md-8 my-4">
          <div class="row">
            <div class="input-group mb-5">
              <input type="text" id="search_product" name="search_product" class="form-control" placeholder="Search Product by Title or ISBN">
            </div>
          </div>
          {{-- CSRF token for JS to search product --}} @csrf
          <div id="products-listing" class="row">
            @foreach ($products as $product)
              <div class="card sale-product p-0 mb-3 mx-1 border border-3 border-success rounded">
                <img src="{{asset('cover_images/'. $product->cover_image_path)}}" width="100%" class="img-fluid rounded-start border-bottom rounded product-img" alt="...">
                <div class="row">
                  <div class="card-body">
                    <div class="col-md-12 card-title fw-bold text-success text-center"> <a href="{{ route('show-product', [$product->id]) }}"> {{ $product->title }} </a></div>
                    <div class="col-md-12 card-isbn"><span class="fw-bold">ISBN:</span> {{ $product->isbn }}</div>
                    <div class="col-md-12 card-price">
                      <span class="fw-bold">Price:</span>
                      @if($product->disc>0)
                        <span class="fs-6 text-decoration-line-through">Rs {{$product->sale_price }}</span>
                        <span class="fs-4 text-success text-decoration-none">Rs {{ $product->sale_price-$product->disc }}</span>
                      @else
                        <span class="fs-4 text-success text-decoration-none">Rs {{ $product->sale_price-$product->disc }}</span>
                      @endif
                    </div>
                    <form class="row" action="{{route('store.sale')}}" method="POST">
                      @csrf
                      <input type="hidden" class="form-control" name="productId" value="{{$product->id}}"> 
                        @if($product->quantity>0)       
                          <span class="fw-bold">Quantity:</span>
                          <div class="col-8 col-sm-8 col-md-8 d-flex card-qty">  
                            <input type="number" id="inputQuantity" min="1" max="{{ $product->quantity }}" class="form-control w-50" name="productQty" placeholder="1" value="1"> 
                            <span class="d-flex"> <span>/</span> {{ $product->quantity }}</span>
                          </div>
                          <button type="submit" class="col-4 col-sm-4 col-md-4 button d-flex justify-content-end pe-3">
                            <img src="{{asset('icons/product-add-icon.svg')}}" width="40%" height="40%" class="" alt="Product-Add-Icon">
                          </button>
                        @else
                          <div class="col-8 col-sm-8 col-md-8 d-flex card-qty">
                            <div class="text-danger fw-bold">OUT OF STOCK</div>
                          </div>
                        @endif
                    </form>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
        <div class="col-md-4 my-4 ">
          <div class="text-success text-center fw-bold fs-5 my-2">Billing</div>
          <div class="text-success fw-bold fs-6">Customer Details:</div>
          <form action="{{route('completesale.sale',[$draft_sale->id])}}" method="POST">
            @csrf
            <div class="my-4">
              <div class="input-group mb-2">
                <input type="text" id="customer_name" name="customer_name" class="form-control" placeholder="Customer Name">
              </div>
              <div class="input-group mb-2">
                <input type="number" id="customer_phone" name="customer_phone" min="11"  class="form-control" placeholder="Customer Phone">
              </div>
              <select id="customerSelect" name="selectedCustomerId" class="form-control form-select" aria-label="customer">
                <option selected value="0">Select a customer</option>
              </select>
            </div>
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
                @if($sale_products)
                <input type="hidden" class="form-control" name="saleId" value="{{$draft_sale->id}}">
                  @foreach($sale_products as $sale_product)
                    <div class="row bill-items-list bill-items-list-{{$sale_product->id}}">
                      <span class="list-group-item col-md-4 text-success"> 
                        <a href="{{ route('show-product', [$sale_product->product_id]) }}"> 
                          {{ $productData['Product_' . $sale_product->product_id]['title'] }}
                        </a>
                      </span>
                      <span class="list-group-item col-md-2 bill-item-sale-price--{{$sale_product->id}}"> {{ $sale_product->sale_price }} </span>
                      <span class="list-group-item col-md-2 px-1">
                        <input type="number" id="inputsaleproductDisc" min="{{$sale_product->disc}}" max="{{ $sale_product->sale_price }}" class="form-control bill-item-disc--{{$sale_product->id}} item-disc" name="saleproductDisc_{{$sale_product->id}}" placeholder="1" value="{{$sale_product->disc}}">
                      </span>
                      <span class="list-group-item col-md-2 px-1">
                        <input type="number" id="inputsaleproductQty" class="form-control bill-item-qty--{{$sale_product->id}} item-qty" min="1" max="{{ $productData['Product_' . $sale_product->product_id]['qty'] }}" name="saleproductQty_{{$sale_product->id}}" placeholder="1" value="{{ $sale_product->quantity }}">
                      </span>
                      <span class="list-group-item col-md-2 bill-item-total--{{$sale_product->id}} item-total"> {{ ($sale_product->sale_price-$sale_product->disc)*$sale_product->quantity }} </span>
                    </div>
                  @endforeach
                @endif
                  <div class="row bill-items-list">
                    <span class="list-group-item col-md-4"></span>
                    <span class="list-group-item col-md-2 bill-item-sale-price"> {{ $saletotal['total_product_price'] }} </span>
                    <span class="list-group-item col-md-2 bill-item-disc" > {{ $saletotal['total_disc'] }} </span>
                    <span class="list-group-item col-md-2 bill-item-qty"> {{ $saletotal['total_qty'] }} </span>
                    <span class="list-group-item col-md-2 bill-item-total"> {{ $saletotal['total_sale_price'] }} </span>
                  </div>
              </div>
            </div>
            <div class="d-flex justify-content-center my-4">
              <button type="submit" class="btn btn-success">Create Sale</button>
            </div>
          </form>
        </div>
    </div>
</main>
@endsection