@include('layouts.partials.header')

@include('layouts.navbar')
<div class="container-fluid">
    <div class="row">
        <div  id="sidebar"  class="col-3 py-5">
            @include('layouts.sidebar')
        </div>
        
        <div id="content" class="col-9 main">
            @yield('content')
        </div>
    </div>
    
</div>
@include('layouts.partials.footer')