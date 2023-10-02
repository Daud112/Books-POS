<div class="sidebar-menus mx-0 mx-sm-0 mx-md-4 mx-lg-5 my-5">    
    <a class="m-2 m-sm-2 m-md-3 m-xl-3" href="#"   >Home</a>
     <a class="m-2 m-sm-2 m-md-3 m-xl-3" href="#productsSubmenu" data-bs-toggle="collapse" role="button">
        Products
    </a>
    <div class="collapse ml-3" id="productsSubmenu">
        <a class="m-2 m-sm-2 m-md-3 m-xl-3" href="{{ route('product-create') }}">Create Product</a>
    </div>
    <a class="m-2 m-sm-2 m-md-3 m-xl-3" href="#">POS</a>
    <a class="m-2 m-sm-2 m-md-3 m-xl-3" href="{{ route('users') }}">Users</a>
</div>