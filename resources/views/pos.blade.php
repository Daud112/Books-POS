@include('layouts.partials.header')

<div class="container-fluid">
    <header class="page-row row">
        @include('layouts.navbar')
    </header>
    <div class="page-row row page-row-expanded">
        <div id="content" class="col-12 main">
            @yield('content')
        </div>
    </div>
</div>
@include('layouts.partials.footer')