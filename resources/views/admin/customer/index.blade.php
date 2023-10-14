@extends('dashboard')
@section('content')

<div class="row d-flex justify-content-center">
    <div class="px-5 pt-5 d-flex justify-content-end">
        <button type="button" class="btn btn-primary">
            <a class="m-2 m-sm-2 m-md-3 m-xl-3" href="{{ route('create-customer') }}">+ Add Customer</a>
        </button>
    </div>
    <div class="table-responsive px-5 py-2">
        <table class="table table-hover my-5">
            <thead>
            <tr>
                <th scope="col">User Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td scope="row"> {{ $customer->name }}</th>
                        <td> {{ $customer->phone }} </th>
                        <td>
                            <button type="button" class="btn btn-dark">
                                <a href="{{ route('edit-customer', [$customer->id]) }}">Edit</a>
                            </button>
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection