@extends('dashboard')
@section('content')
<main class="signup-form">
    <div class="row d-flex justify-content-center my-5">
        <h1 class="fs-3 text-dark text-center fw-bold my-3">Edit Customer</h1>
        @include('layouts.partials.error')
        @include('layouts.partials.success')
        <form class="row g-3" action="{{ route('customer.store') }}" method="POST">
            @csrf
            <div class="col-md-6">
                <label for="inputName" class="form-label">Name</label>
                <input type="text" id="inputName" class="form-control" placeholder="Name" name="name" aria-label="Name">
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="col-md-6">
                <label for="inputPhone" class="form-label">Phone</label>
                <input type="number" id="inputPhone" class="form-control" name="phone" placeholder="03**********">
                @if ($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
            </div>
            
            <div class="col-12 d-flex justify-content-center ">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
</main>
@endsection