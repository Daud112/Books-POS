<div class="sidebar-menus mx-0 mx-sm-0 mx-md-4 mx-lg-5 my-5">    
    <a class="m-2 m-sm-2 m-md-3 m-xl-3" href="#"   >Home</a>
     <a class="m-2 m-sm-2 m-md-3 m-xl-3" href="#productsSubmenu" data-bs-toggle="collapse" role="button">
        Products
    </a>
    <div class="collapse ml-3" id="productsSubmenu">
        <a class="m-2 m-sm-2 m-md-3 m-xl-3" href="{{ route('products') }}">List</a>
        <a class="m-2 m-sm-2 m-md-3 m-xl-3" href="{{ route('product-create') }}">Create</a>
        <a class="m-2 m-sm-2 m-md-3 m-xl-3" href="{{ route('custom-product-create') }}">Create Custom </a>
    </div>
    <a class="m-2 m-sm-2 m-md-3 m-xl-3" href="#posSubmenu" data-bs-toggle="collapse" role="button">
        POS
    </a>
    <div class="collapse ml-3" id="posSubmenu">
        <a class="m-2 m-sm-2 m-md-3 m-xl-3" href="{{ route('create-sale') }}">Create New Sale</a>
        <a class="m-2 m-sm-2 m-md-3 m-xl-3" href="{{ route('sales') }}">View Sales</a>
    </div>
    <a class="m-2 m-sm-2 m-md-3 m-xl-3" href="{{ route('users') }}">Users</a>
    <a class="m-2 m-sm-2 m-md-3 m-xl-3" href="#customerSubmenu" data-bs-toggle="collapse" role="button">
        Customer
    </a>
    <div class="collapse ml-3" id="customerSubmenu">
        <a class="m-2 m-sm-2 m-md-3 m-xl-3" href="{{ route('customers') }}">List</a>
        <a class="m-2 m-sm-2 m-md-3 m-xl-3" href="{{ route('create-customer') }}">Create</a>
    </div>
</div>