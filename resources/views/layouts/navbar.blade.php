<nav id="header-nav" class="navbar navbar-light navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand mr-auto logo"  href="{{ route('dashboard') }}">Book Shop POS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('show-user', [Auth::user()->id]) }}">{{ Auth::user()->name }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('signout') }}">Logout</a>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav> 