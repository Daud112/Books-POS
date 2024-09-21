@extends('dashboard')
@section('content')

<div class="row justify-content-center my-4">
    @include('layouts.partials.error')
    @include('layouts.partials.success')
    <div class="col-md-12">
        @foreach ($sale as $sale)
            <div class="fs-4 text-dark text-left fw-bold my-4">Sales Info:</div>
            <table class="table table-striped table-hover">
                <tbody>
                    <tr>
                        <td> <span class="fw-bold">Receipt No. #</span> </td>
                        <td> {{ $sale->id }} </td>
                    </tr>
                    <tr>
                        <td> <span class="fw-bold">Status</span> </td>
                        <td> {{ $sale->status }} </td>
                    </tr>
                    <tr>
                        <td> <span class="fw-bold">Date</span> </td>
                        <td> {{ $sale->sale_datetime }} </td>
                    </tr>
                </tbody>
            </table>
            @if(isset($sale->customer->name) || isset($sale->customer->phone))
                <div class="fs-4 text-dark text-left fw-bold my-4">Customer Info:</div>
                <table class="table table-striped table-hover">
                    <tbody>
                        <tr>
                            <td> <span class="fw-bold">Customer Name</span> </td>
                            <td> {{ $sale->customer->name }} </td>
                            <td> <span class="fw-bold">Customer Phone</span> </td>
                            <td> {{ $sale->customer->phone }} </td>
                        </tr>
                    </tbody>
                </table>
            @endif
            @if(isset($sale->user))

            <div class="fs-4 text-dark text-left fw-bold my-4">Seller Info:</div>
            <table class="table table-striped table-hover">
                <tbody>
                    <tr>
                        <td> <span class="fw-bold">Name</span> </td>
                        <td class="text-dark fw-bold"> <a class="app-buttons-text" href="{{ route('show-user', [$sale->user_id]) }}">{{ $sale->user->name }}</a> </td>
                        <td> <span class="fw-bold">Phone</span> </td>
                        <td> {{ $sale->user->phone }} </td>
                    </tr>
                    <tr>
                        <td> <span class="fw-bold">Email</span> </td>
                        <td> {{ $sale->user->email }} </td>
                        <td> <span class="fw-bold">Role</span> </td>
                        <td> {{ $sale->user->role }} </td>
                    </tr>
                </tbody>
            </table>
            @endif
            <div class="fs-4 text-dark text-left fw-bold my-4">Sold Products:</div>
            <?php $is_return = 0 ?>
            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th scope="col" class="text-start">Title</th>
                        <th scope="col">Buy Price</th>
                        <th scope="col">Sale Price</th>
                        <th scope="col">Disc</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                        <th scope="col">Profit</th>
                        @if($auth_user->hasPermissionTo('return sale'))
                            <th scope="col">Select Return's</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    <form action="{{ route('return.saledproduct',[$sale->id]) }}" method="POST">
                        @foreach ($sale->productSales as $product)
                            @csrf
                            <tr>
                                <td class="fw-bold text-start">
                                    <a class="app-buttons-text" href="{{ route('show-product', [$product->product_id]) }}">{{ $product->title }}</a>
                                </td>
                                <td> {{ $product->buy_price }} </td>    
                                <td> {{ $product->sale_price }} </td>    
                                <td> {{ $product->disc }} </td>
                                <td> {{ $product->quantity }} </td>
                                <td> {{($product->sale_price-$product->disc)*$product->quantity}}</td>
                                <td> {{(($product->sale_price-$product->disc)-$product->buy_price)*$product->quantity}}</td>
                                @if($auth_user->hasPermissionTo('return sale') && $product->quantity > 0)
                                    <td> 
                                        <style>
                                            .custom-checkbox.custom-control-input {
                                                width: 1.5em;
                                                height: 1.5em;
                                            }
                                        </style>
                                        <input type="number" class="text-white text-center bg-dark p-2" name="return_stock_{{$product->id}}" min="1" max="{{ $product->quantity }}" value="1">
                                        <input type="checkbox" 
                                        class="custom-checkbox custom-control-input" 
                                        name="return_product_{{$product->id}}" 
                                        value="0" 
                                        onclick="this.value = this.checked ? 1 : 0;" 
                                        {{ old('return_' . $product->id) ? 'checked' : '' }}>
                                    </td>
                                    <?php $is_return = 1 ?>
                                @else
                                    <td>
                                        <div class="alert alert-info px-0 mx-0" role="alert">All returend.</div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                            
                        <tr>
                            <td></td>
                            <td class="fw-bold"> <span class="text-dark">{{$saletotal['total_buy_price'] }}</span> </td>
                            <td class="fw-bold"> <span class="text-dark">{{ $saletotal['total_price'] }}</span>  </td>
                            <td class="fw-bold"> <span class="text-dark">{{ $saletotal['total_disc'] }}</span>  </td>
                            <td class="fw-bold"> <span class="text-dark">{{ $saletotal['total_qty'] }}</span>  </td>
                            <td class="fw-bold"> <span class="text-dark">{{ $saletotal['total_sale_price'] }}</span>  </td>
                            <td class="fw-bold"> <span class="text-dark">{{ $saletotal['total_profilt'] }}</span>  </td>
                            @if($auth_user->hasPermissionTo('return sale'))
                                <td>
                                    <button type="submit" class="btn btn-primary" {{ $is_return ? '' : 'disabled' }}>Return</button>
                                </td>
                            @endif
                        </tr>
                    </form>
                </tbody>
            </table>
        @endforeach
    </div>
</div>
<div class="row text-center d-flex align-items-center justify-content-center">
    @if(!$is_return)
    <div class="col-6 mx-5">
        <div class="alert alert-info" role="alert">All stock has returend.</div>
    </div>
    @endif
</div>
<div class="row d-flex align-items-center justify-content-center">
    @if($auth_user->hasPermissionTo('edit sale'))
        {{-- <div class="col-1">
            <button type="button" class="btn btn-success w-100">
                <a href="{{ route('edit-sale', [$sale->id]) }}">Edit</a>
            </button>
        </div> --}}
    @endif
    <div class="col-1">
        <button type="button" class="btn btn-danger w-100">
            <a href="{{ route('sales.print', [$sale->id]) }}" target="_blank">Print</a>
        </button>
    </div>
</div>
@endsection