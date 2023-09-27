@extends('dashboard')
@section('content')

<div class="row justify-content-center">
    <div class="listing-users ">
        <table class="table table-hover ">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">User Name</th>
                <th scope="col">Email</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }} </th>
                        <td> {{ $user->name }}</th>
                        <td> {{ $user->email }}   </th>
                        <td>
                            <button type="button" class="btn btn-dark">Edit</button>

                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection