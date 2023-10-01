@extends('dashboard')
@section('content')

<div class="row justify-content-center">
    <div class="table-responsive p-5">
        <table class="table table-hover my-5">
            <thead>
            <tr>
                <th scope="col">User Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Role</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td scope="row"> {{ $user->name }}</th>
                        <td> {{ $user->email }} </th>
                        <td> {{ $user->phone }} </th>
                        <td> {{ $user->role }} </th>    
                        <td>
                            <button type="button" class="btn btn-dark">
                                <a href="{{ route('show-user', [$user->id]) }}">Edit</a>
                            </button>
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection