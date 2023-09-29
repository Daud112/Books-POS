@include('layouts.partials.header')

<div class="container-fluid">
    <header class="page-row row">
        @include('layouts.navbar')
    </header>
    <div class="page-row row page-row-expanded">
        <div class="col-4 col-sm-4 col-md-3 col-xl-2 sidebar">
            @include('layouts.sidebar')
        </div>
        
        <div id="content" class="col-8 col-sm-8 col-md-9 col-xl-10 main">
            @yield('content')
        </div>
    </div>
</div>
@include('layouts.partials.footer')