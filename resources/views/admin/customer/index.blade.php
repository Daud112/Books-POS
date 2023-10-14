@extends('dashboard')
@section('content')

<div class="row justify-content-center">
    <div class="table-responsive p-5">
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