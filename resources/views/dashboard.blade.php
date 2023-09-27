@include('layouts.partials.header')

    
    @include('layouts.navbar')
    
    <div id="sidebar">
        @include('layouts.sidebar')
    </div>
    
    <div id="content">
        @yield('content')
    </div>


@include('layouts.partials.footer')