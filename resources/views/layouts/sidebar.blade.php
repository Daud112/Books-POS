<div class="sidebar-menus mx-0 mx-sm-0 mx-md-4 mx-lg-4 my-5">    
    <a class="m-2 m-sm-2 m-md-3 m-xl-3" href="#"   >Home</a>
    @if($auth_user->hasPermissionTo('view product') || $auth_user->hasPermissionTo('create product') || $auth_user->hasPermissionTo('edit product'))
        <a class="m-2 m-sm-2 m-md-3 m-xl-3" href="#productsSubmenu" data-bs-toggle="collapse" role="button">
            Products
        </a>
        <div class="collapse ml-3" id="productsSubmenu">
            @if($auth_user->hasPermissionTo('view product'))
                <a class="m-2 m-sm-2 m-md-2 m-xl-2 ps-3" href="{{ route('products') }}">- List</a>
            @endif
            @if($auth_user->hasPermissionTo('create product'))
                <a class="m-2 m-sm-2 m-md-2 m-xl-2 ps-3" href="{{ route('product-create') }}">- Create</a>
                <a class="m-2 m-sm-2 m-md-2 m-xl-2 ps-3" href="{{ route('custom-product-create') }}">- Create Custom </a>
            @endif
        </div>
    @endif
    @if($auth_user->hasPermissionTo('view expense') || $auth_user->hasPermissionTo('create expense') || $auth_user->hasPermissionTo('edit expense'))
        <a class="m-2 m-sm-2 m-md-3 m-xl-3" href="#expenseSubmenu" data-bs-toggle="collapse" role="button">
            Expense
        </a>
        <div class="collapse ml-3" id="expenseSubmenu">
            @if($auth_user->hasPermissionTo('view expense'))
                <a class="m-2 m-sm-2 m-md-3 m-xl-3 ps-3" href="{{ route('expenses') }}">- List</a>
            @endif
            @if($auth_user->hasPermissionTo('create expense'))
                <a class="m-2 m-sm-2 m-md-3 m-xl-3 ps-3" href="{{ route('create-expense') }}">- Create</a>
            @endif
        </div>
    @endif
    @if($auth_user->hasPermissionTo('view sale') || $auth_user->hasPermissionTo('create sale') || $auth_user->hasPermissionTo('edit sale'))
        <a class="m-2 m-sm-2 m-md-3 m-xl-3" href="#posSubmenu" data-bs-toggle="collapse" role="button">
            POS
        </a>
        <div class="collapse ml-3" id="posSubmenu">
            @if($auth_user->hasPermissionTo('create sale'))
                <a class="m-2 m-sm-2 m-md-2 m-xl-2 ps-3" href="{{ route('create-sale') }}">- Create New Sale</a>
            @endif
            @if($auth_user->hasPermissionTo('view sale'))
                <a class="m-2 m-sm-2 m-md-2 m-xl-2 ps-3" href="{{ route('sales') }}">- View Sales</a>
            @endif
        </div>
    @endif
    @if($auth_user->hasPermissionTo('view user') || $auth_user->hasPermissionTo('create user') || $auth_user->hasPermissionTo('edit user'))
        <a class="m-2 m-sm-2 m-md-3 m-xl-3" href="#userSubmenu" data-bs-toggle="collapse" role="button">Users</a>
        <div class="collapse ml-3" id="userSubmenu">
            @if($auth_user->hasPermissionTo('view user'))
                <a class="m-2 m-sm-2 m-md-2 m-xl-2 ps-3" href="{{ route('users') }}">- List</a>
            @endif
            @if($auth_user->hasPermissionTo('create user'))
                <a class="m-2 m-sm-2 m-md-2 m-xl-2 ps-3" href="{{ route('register-user') }}">- Create</a>
            @endif
        </div>
    @endif
    @if($auth_user->hasPermissionTo('view customer') || $auth_user->hasPermissionTo('create customer') || $auth_user->hasPermissionTo('edit customer'))
        <a class="m-2 m-sm-2 m-md-3 m-xl-3" href="#customerSubmenu" data-bs-toggle="collapse" role="button">
            Customer
        </a>

        <div class="collapse ml-3" id="customerSubmenu">
            @if($auth_user->hasPermissionTo('view customer'))
                <a class="m-2 m-sm-2 m-md-2 m-xl-2 ps-3" href="{{ route('customers') }}">- List</a>
            @endif
            @if($auth_user->hasPermissionTo('create customer'))
                <a class="m-2 m-sm-2 m-md-2 m-xl-2 ps-3" href="{{ route('create-customer') }}">- Create</a>
            @endif
        </div>
    @endif
    @if($role == 'Admin')
        <a class="m-2 m-sm-2 m-md-3 m-xl-3"  href="{{ route('role-permissions') }}">Permissions</a>
    @endif
</div>