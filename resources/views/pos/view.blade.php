@extends('dashboard')
@section('content')

<div class="row justify-content-center my-4">
    <div class="col-md-12">
        @foreach ($sale as $sale)
            <div class="fs-4 text-success text-left fw-bold my-4">Sales Info:</div>
            <table class="table table-striped table-hover">
                <tbody>
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
            <div class="fs-4 text-success text-left fw-bold my-4">Customer Info:</div>
            <table class="table table-striped table-hover">
                <tbody>
                    <tr>
                        <td> <span class="fw-bold">Customer Name</span> </td>
                        <td> {{ $sale->customer->name }} </td>
                        <td> <span class="fw-bold">Customer Email</span> </td>
                        <td> {{ $sale->customer->email }} </td>
                    </tr>
                </tbody>
            </table>
            <div class="fs-4 text-success text-left fw-bold my-4">Seller Info:</div>
            <table class="table table-striped table-hover">
                <tbody>
                    <tr>
                        <td> <span class="fw-bold">Name</span> </td>
                        <td class="text-success fw-bold"> <a class="app-buttons-text" href="{{ route('show-user', [$sale->user_id]) }}">{{ $sale->user->name }}</a> </td>
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
            <div class="fs-4 text-success text-left fw-bold my-4">Sold Products:</div>
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
                        <th scope="col">Select Return's</th>
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
                                <td> 
                                    <input type="number" name="return_stock_{{$product->id}}" min="1" max="{{ $product->quantity }}" value="1">
                                    <input type="checkbox" name="product_id[]" value="{{ $product->id }}">
                                </td>
                            </tr>
                        @endforeach
                            
                        <tr>
                            <td></td>
                            <td class="fw-bold"> <span class="text-success">{{$saletotal['total_buy_price'] }}</span> </td>
                            <td class="fw-bold"> <span class="text-success">{{ $saletotal['total_price'] }}</span>  </td>
                            <td class="fw-bold"> <span class="text-success">{{ $saletotal['total_disc'] }}</span>  </td>
                            <td class="fw-bold"> <span class="text-success">{{ $saletotal['total_qty'] }}</span>  </td>
                            <td class="fw-bold"> <span class="text-success">{{ $saletotal['total_sale_price'] }}</span>  </td>
                            <td class="fw-bold"> <span class="text-success">{{ $saletotal['total_profilt'] }}</span>  </td>
                            <td>
                                <button type="submit" class="btn btn-primary">Return</button>
                            </td>
                        </tr>
                    </form>
                </tbody>
            </table>
        @endforeach
    </div>
</div>
<div class="row d-flex align-items-center justify-content-center">
    <div class="col-1">
        <button type="button" class="btn btn-success w-100">
            <a href="{{ route('edit-sale', [$sale->id]) }}">Edit</a>
        </button>
    </div>
    <div class="col-1">
        <button type="button" class="btn btn-danger w-100">
            <a href="{{ route('sales.print', [$sale->id]) }}" target="_blank">Print</a>
        </button>
    </div>
</div>
@endsection