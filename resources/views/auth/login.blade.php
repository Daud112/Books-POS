@include('layouts.partials.header')
    <div class="d-flex align-items-center justify-content-center vh-100">
        <div class="col-4">
            <h1 class="fs-1 text-dark text-center fw-bold my-3">Book Shop POS</h1>
            <div class="card">
                <h3 class="card-header text-center">Login</h3>
                <div class="card-body">
                    <form method="POST" action="{{ route('login.custom') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <input type="text" placeholder="Email" id="email" class="form-control" name="email" required
                                autofocus>
                            @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" placeholder="Password" id="password" class="form-control" name="password" required>
                            @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember"> Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="d-grid mx-auto">
                            <button type="submit" class="btn btn-dark text-dark">Signin</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@include('layouts.partials.footer')
