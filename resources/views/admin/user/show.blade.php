@extends('dashboard')
@section('content')

<div class="row d-flex justify-content-center">
    <div class="view-user ">
        <form method="POST" class="my-5 w-50">
            @csrf

            <div class="form-group mb-3">
                <label>Username:</label>
                <input type="text" placeholder="Username" id="username" class="form-control" name="name" value="{{$user->name}}" required
                    autofocus>
                @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group mb-3">
                <label>Email:</label>
                <input type="text"  placeholder="Email" id="email" class="form-control" name="email" value="{{$user->email}}" disabled
                    autofocus>
                @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="form-group mb-3">
                <label>Phone:</label>
                <input type="text" placeholder="Phone" id="phone" class="form-control" name="phone" value="{{$user->phone}}"
                    autofocus>
                @if ($errors->has('phone'))
                <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
            </div>
            <div class="form-group mb-3">
                <select id="role" class="form-control" name="role">
                  <option selected>Choose...</option>
                  <option value="shopworker" @if ($user->role === 'shopworker') selected @endif>Shop Worker</option>
                  <option value="admin" @if ($user->role === 'admin') selected @endif>Admin</option>
                </select>
                @if ($errors->has('role'))
                <span class="text-danger">{{ $errors->first('role') }}</span>
                @endif
            </div>
            <div class="d-grid mx-auto">
                <button type="submit" class="btn btn-dark btn-block">
                    <a href="{{ route('update-user', [$user->id]) }}">Update</a>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection