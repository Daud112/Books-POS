@extends('dashboard')
@section('content')

<div class="row d-flex justify-content-center">
    <h1 class="fs-3 text-dark text-center fw-bold my-5">Customer's</h1>

    @if($auth_user->hasPermissionTo('create customer'))
        <div class="px-5 d-flex justify-content-end">
            <button type="button" class="btn btn-primary">
                <a class="m-2 m-sm-2 m-md-3 m-xl-3" href="{{ route('create-customer') }}">+ Add Customer</a>
            </button>
        </div>
    @endif
    <div class="table-responsive px-5 py-2">
        <table class="table table-hover my-5">
            <thead>
            <tr>
                <th scope="col">User Name</th>
                <th scope="col">Phone</th>
                @if($auth_user->hasPermissionTo('edit customer'))
                    <th scope="col">Actions</th>
                @endif
            </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td scope="row"> {{ $customer->name }}</td>
                        <td> {{ $customer->phone }} </td>
                        @if($auth_user->hasPermissionTo('edit customer'))
                            <td>
                                <button type="button" class="btn btn-dark">
                                    <a href="{{ route('edit-customer', [$customer->id]) }}">Edit</a>
                                </button>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection