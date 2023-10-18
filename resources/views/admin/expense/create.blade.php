@extends('dashboard')
@section('content')
<main class="signup-form">
    <div class="row d-flex justify-content-center my-5">
        <h1 class="fs-3 text-dark text-center fw-bold my-3">Create Expense</h1>
        @include('layouts.partials.error')
        @include('layouts.partials.success')
        <form class="row g-3" action="{{ route('expense.store') }}" method="POST">
            @csrf
            <div class="col-md-6">
                <label for="inputName" class="form-label">Name</label>
                <input type="text" id="inputName" class="form-control" placeholder="Name" name="name" aria-label="Name">
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="col-md-6">
                <label for="inputAmount" class="form-label">Amount</label>
                <input type="number" id="inputAmount" class="form-control" min="1" name="amount" placeholder="1000">
                @if ($errors->has('amount'))
                    <span class="text-danger">{{ $errors->first('amount') }}</span>
                @endif
            </div>
            <div class="col-md-6">
                <label for="inputDate" class="form-label">Expense Date</label>
                <input type="date" id="inputDate" class="form-control" placeholder="Date" name="date" aria-label="Date">
                @if ($errors->has('date'))
                    <span class="text-danger">{{ $errors->first('date') }}</span>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="payment_method">Payment Method:</label>
                <select id="payment_method" name="payment_method" class="form-control">
                    <option value="cash">Cash</option>
                    <option value="online">Online</option>
                </select>
            </div>
            
            <div class="form-group col-md-6" id="online_payment_number_field" style="display: none;">
                <label for="online_payment_number">Online Payment ID/Number:</label>
                <input type="text" name="payment_no" class="form-control">
            </div>
            <div class="form-group">
                <label for="expense_desc">Expense Description</label>
                <textarea class="form-control" id="expense_desc" name="description" rows="3"></textarea>
            </div>
            
            <div class="col-12 d-flex justify-content-center ">
                <button type="submit" class="btn btn-primary">Create Expense</button>
            </div>
        </form>
    </div>
</main>
@endsection