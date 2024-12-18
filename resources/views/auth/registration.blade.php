@extends('dashboard')
@section('content')
<main class="signup-form">
    <div class="d-flex align-items-center justify-content-center vh-100">
        <div class="col-6 col-sm-6 col-md-4 col-lg-4">
            <div class="card">
                <h3 class="card-header text-center">Create New User</h3>
                <div class="card-body">
                    <form action="{{ route('register.custom') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <input type="text" placeholder="Name" id="name" class="form-control" name="name"
                                required autofocus>
                            @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" placeholder="Email" id="email_address" class="form-control"
                                name="email" required autofocus>
                            @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" placeholder="Phone" id="phone" class="form-control" name="phone"
                                autofocus>
                            @if ($errors->has('phone'))
                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <select id="role" class="form-control" name="role">
                              <option selected>Choose...</option>
                              <option value="Shop Worker">Shop Worker</option>
                              <option value="Manager">Manager</option>
                              <option value="Admin">Admin</option>
                            </select>
                            @if ($errors->has('role'))
                            <span class="text-danger">{{ $errors->first('role') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" placeholder="Password" id="password" class="form-control"
                                name="password" required>
                            @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <div class="checkbox">
                                <label><input type="checkbox" name="remember"> Remember Me</label>
                            </div>
                        </div>
                        <div class="d-grid mx-auto">
                            <button type="submit" class="btn btn-dark btn-block">Create User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection