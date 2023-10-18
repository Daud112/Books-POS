@extends('dashboard')
@section('content')

<div class="row d-flex justify-content-center">
    <div class="px-5 pt-5 d-flex justify-content-end">
        <button type="button" class="btn btn-primary">
            <a class="m-2 m-sm-2 m-md-3 m-xl-3" href="{{ route('create-expense') }}">+ Add Expense</a>
        </button>
    </div>
    <div class="card my-5 text-center fw-bold fs-6">
        <div class="card-header ">
            All Expenses
        </div>
        <div class="card-body row ">
            <div class="col-md-6">
                <div> No of Expense</div>
                <div class="text-success fs-4 mt-3"> {{count($expenses)}}</div>
            </div>
            <div class="col-md-6">
                <div>Total Expense Price</div>
                <div class="text-success fs-4 mt-3">Rs {{ $total_expense_amount }} </div>
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