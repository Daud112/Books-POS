@extends('dashboard')
@section('content')

<div class="row justify-content-center">
    <h1 class="fs-3 text-dark text-center fw-bold my-5">Sales</h1>
    @include('layouts.partials.error')
    @include('layouts.partials.success')
    <form class="row g-3" action="{{ route('sales-filter') }}" method="GET">
        @csrf
        <div class="col-md-6">
            <label for="inputcustomername" class="form-label">Receipt No. #</label>
            <input type="number" id="inputReceiptNo" class="form-control" placeholder="Receipt No." name="receipt-no">
        </div>
        <div class="col-md-6">
            <label for="inputcustomername" class="form-label">Customer Name</label>
            <input type="text" id="inputName" class="form-control" placeholder="Name" name="customer-name">
        </div>
        <div class="col-md-6">
            <label for="inputPhone" class="form-label">Custom Phone</label>
            <input type="number" id="inputPhone" class="form-control" name="customer-phone" placeholder="03**********">
        </div>
        <div class="col-md-6">
            <label for="inputEndDate" class="form-label">User</label>
            <select id="userSelect" name="selectedUserId" class="form-control form-select" aria-label="user">
                <option @if($user_id === 0) selected @endif value="0">Select a user</option>
                <option @if($user_id === "all") selected @endif value="all">All</option>
                @foreach($users as $user)
                    <option @if($user_id == $user->id) selected @endif value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
              </select>
            @if ($errors->has('user'))
                <span class="text-danger">{{ $errors->first('user') }}</span>
            @endif
        </div>
        <div class="col-md-6">
            <label for="inputStartDate" class="form-label">From Date</label>
                <input type="date" id="inputsStartDate" class="form-control" placeholder="Start Date" name="start_date" value="{{ $startDate ?? "" }}">
            @if ($errors->has('start_date'))
                <span class="text-danger">{{ $errors->first('start_date') }}</span>
            @endif
        </div>
        <div class="col-md-6">
            <label for="inputEndDate" class="form-label">End Date</label>
            <input type="date" id="inputsEndDate" class="form-control" placeholder="End Date" name="end_date" value="{{ $endDate ?? "" }}">
            @if ($errors->has('end_date'))
                <span class="text-danger">{{ $errors->first('end_date') }}</span>
            @endif
        </div>
        <div class="col-12 d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">Apply Filter</button>
        </div>
    </form>
    <div class="table-responsive p-5">
        @if(count($sales)<1)
            <tr>
               <div class="fs-3 text-primary text-center fw-bold "> No Product Found</div>
            </tr>

        @else
            <div class="card my-5 text-center fw-bold fs-6">
                <div class="card-header ">
                Sales & Profit
                </div>
                <div class="card-body row ">
                    <div class="col-md-3 ">
                        <div> No of Sales</div>
                        <div class="text-primary fs-4 mt-3"> {{count($sales)}}</div>
                    </div>
                    <div class="col-md-3 ">
                        <div>Total Sale Price</div>
                        <div class="text-primary fs-4 mt-3">Rs {{ $saletotal['total_sale_price'] }} </div>
                    </div>
                    <div class="col-md-3 ">
                        <div>Total Discount's</div>
                        <div class="text-primary fs-4 mt-3">Rs {{ $saletotal['total_disc'] }} </div>
                    </div>
                    <div class="col-md-3 ">
                        <div>Total Profit</div>
                        <div class="text-primary fs-4 mt-3">Rs {{ $saletotal['profit'] }} </div>
                    </div>
                </div>
            </div>
        <table class="table table-hover my-5">
            <thead>
                <tr>
                    <th scope="col">Receipt No. #</th>
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
                            {{ $sale->id}}
                        </td>
                        <td> 
                          @foreach($sale->productSales as $product) 
                            <div>{{$product->title}}</div>
                          @endforeach
                        </td>
                        <td> {{ $sale->sale_datetime }} </td>    
                        <td> {{ isset($sale->customer->name) ? $sale->customer->name : "" }} </td>
                        <td> {{ $sale->user->name }} </td>
                        <td>
                            @if($auth_user->hasPermissionTo('view sale'))
                                <button type="button" class="btn btn-dark d-flex my-1">
                                    <a href="{{ route('show-sale',[$sale->id]) }}">View</a>
                                </button>
                            @endif
                            <button type="button" class="btn btn-danger">
                                <a href="{{ route('sales.print', [$sale->id]) }}" target="_blank">Print</a>
                            </button>
                        </td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
        @endif
    </div>
</div>
@endsection