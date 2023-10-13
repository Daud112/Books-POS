@extends('dashboard')
@section('content')

<div class="row justify-content-center my-4">
    <div class="col-md-12">
        @foreach ($sale as $sale)
            <div class="fs-4 text-dark text-left fw-bold my-4">Sales Info:</div>
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
            <div class="fs-4 text-dark text-left fw-bold my-4">Customer Info:</div>
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
            <div class="fs-4 text-dark text-left fw-bold my-4">Seller Info:</div>
            <table class="table table-striped table-hover">
                <tbody>
                    <tr>
                        <td> <span class="fw-bold">Name</span> </td>
                        <td class="text-success fw-bold"> <a href="{{ route('show-user', [$sale->user_id]) }}">{{ $sale->user->name }}</a> </td>
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
            <div class="fs-4 text-dark text-left fw-bold my-4">Products:</div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Buy Price</th>
                        <th scope="col">Sale Price</th>
                        <th scope="col">Disc</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                        <th scope="col">Profit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sale->productSales as $product)
                        <tr>
                            <td class="text-success fw-bold">
                                <a href="{{ route('show-product', [$product->product_id]) }}">{{ $product->title }}</a>
                            </td>
                            <td> {{ $product->buy_price }} </td>    
                            <td> {{ $product->sale_price }} </td>    
                            <td> {{ $product->disc }} </td>
                            <td> {{ $product->quantity }} </td>
                            <td> {{($product->sale_price-$product->disc)*$product->quantity}}</td>
                            <td> {{(($product->sale_price-$product->disc)-$product->buy_price)*$product->quantity}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td> {{ $saletotal['total_buy_price'] }} </td>
                        <td> {{ $saletotal['total_price'] }} </td>
                        <td > {{ $saletotal['total_disc'] }} </td>
                        <td> {{ $saletotal['total_qty'] }} </td>
                        <td> {{ $saletotal['total_sale_price'] }} </td>
                        <td> {{ $saletotal['total_profilt'] }} </td>
                    </tr>
                </tbody>
            </table>
        @endforeach
    </div>
</div>
<div class="row d-flex align-items-center justify-content-center">
    <div class="col-1">
        <button type="button" class="btn btn-success w-100">
            {{-- <a href="{{ route('edit-product', [$product->id]) }}">Edit</a> --}}
        </button>
    </div>
    <div class="col-1">
        <button type="button" class="btn btn-danger w-100">Delete</button>
    </div>
</div>
@endsection