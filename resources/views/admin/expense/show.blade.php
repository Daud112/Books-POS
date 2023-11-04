@extends('dashboard')
@section('content')

<div class="row justify-content-center my-4">
    <div class="col-md-12">
        <div class="fs-3 text-dark text-center fw-bold my-3">Expense Details</div>
        <table class="table table-striped table-hover">
            <tbody>
                <tr>
                    <td> <span class="fw-bold">Name</span> </td>
                    <td> {{ $expense->name }} </td>
                </tr>
                <tr>
                    <td> <span class="fw-bold">Date</span> </td>
                    <td> {{ $expense->date }} </td>
                </tr>
                <tr>
                    <td> <span class="fw-bold">Amount</span> </td>
                    <td> {{ $expense->amount }} </td>
                </tr>
                <tr>
                    <td> <span class="fw-bold">Payment Method</span> </td>
                    <td> {{ $expense->payment_method }} </td>
                </tr>
                @if($expense->payment_method == 'online')
                    <tr>
                        <td> <span class="fw-bold">Payment ID</span> </td>
                        <td> {{ $expense->payment_no }} </td>
                    </tr>
                @endif
                <tr>
                    <td> <span class="fw-bold">Description</span> </td>
                    <td> {{ $expense->description }} </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row d-flex align-items-center justify-content-center">
    @if($auth_user->hasPermissionTo('edit expense'))
        <div class="col-1">
            <button type="button" class="btn btn-success w-100">
                <a href="{{ route('edit-expense', [$expense->id]) }}">Edit</a>
            </button>
        </div>
    @endif
    {{-- <div class="col-1">
        <button type="button" class="btn btn-danger w-100">Delete</button>
    </div> --}}
</div>
@endsection