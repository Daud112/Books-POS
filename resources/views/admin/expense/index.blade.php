@extends('dashboard')
@section('content')

<div class="row d-flex justify-content-center">
    <div class="px-5 pt-5 d-flex justify-content-end">
        <button type="button" class="btn btn-primary">
            <a class="m-2 m-sm-2 m-md-3 m-xl-3" href="{{ route('create-expense') }}">+ Add Expense</a>
        </button>
    </div>
    <form class="row g-3" action="{{ route('expenses-filter') }}" method="GET">
        @csrf
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
    <div class="card my-5 text-center fw-bold fs-6">
        <div class="card-header ">
            All Expenses
        </div>
        <div class="card-body row ">
            <div class="col-md-6">
                <div> No of Expense</div>
                <div class="app-buttons-text fs-4 mt-3"> {{count($expenses)}}</div>
            </div>
            <div class="col-md-6">
                <div>Total Expense Price</div>
                <div class="app-buttons-text fs-4 mt-3">Rs {{ $total_expense_amount }} </div>
            </div>
        </div>
    </div>
    <div class="table-responsive px-5 py-2">
        <table class="table table-hover my-5">
            <thead>
            <tr>
                <th scope="col">User Name</th>
                <th scope="col">Date</th>
                <th scope="col">Amount</th>
                <th scope="col">Payment Method</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($expenses as $expense)
                    <tr>
                        <td scope="row"> {{ $expense->name }}</th>
                        <td> {{ $expense->date }} </th>
                        <td> {{ $expense->amount }} </th>
                        <td> {{ $expense->payment_method }} </th>
                        <td>
                            <button type="button" class="btn btn-dark">
                                <a href="{{ route('show-expense', [$expense->id]) }}">Show</a>
                            </button>
                            <button type="button" class="btn btn-dark">
                                <a href="{{ route('edit-expense', [$expense->id]) }}">Edit</a>
                            </button>
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection