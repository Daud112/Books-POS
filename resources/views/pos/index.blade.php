@extends('dashboard')
@section('content')

<div class="row justify-content-center">
    <h1 class="fs-3 text-dark text-center fw-bold my-5">Sales</h1>
    @include('layouts.partials.error')
    @include('layouts.partials.success')
    <form class="row g-3" action="{{ route('sales-filter') }}" method="GET">
        @csrf
        <div class="col-md-6">
            <label for="inputStartDate" class="form-label">From Date</label>
                <input type="date" id="inputsStartDate" class="form-control" placeholder="Start Date" name="start_date" value="{{ $startDate ?? now()->toDateString() }}">
            @if ($errors->has('start_date'))
                <span class="text-danger">{{ $errors->first('start_date') }}</span>
            @endif
        </div>
        <div class="col-md-6">
            <label for="inputEndDate" class="form-label">End Date</label>
            <input type="date" id="inputsEndDate" class="form-control" placeholder="End Date" name="end_date" value="{{ $startDate ?? now()->toDateString() }}">
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
               <div class="fs-3 text-success text-center fw-bold "> No Product Found</div>
            </tr>

        @else
        <table class="table table-hover my-5">
            <thead>
                <tr>
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
                          @foreach($sale->productSales as $product) 
                            <div>{{$product->title}}</div>
                          @endforeach
                        </th>
                        <td> {{ $sale->sale_datetime }} </th>    
                        <td> {{ $sale->customer->name }} </th>
                        <td> {{ $sale->user->name }} </th>
                        <td>
                            <button type="button" class="btn btn-dark d-flex my-1">
                                <a href="{{ route('show-sale',[$sale->id]) }}">View</a>
                            </button>
                            <button type="button" class="btn btn-danger">
                                <a href="{{ route('sales.print', [$sale->id]) }}" target="_blank">Print</a>
                            </button>
                        </th>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
        @endif
    </div>
</div>
@endsection