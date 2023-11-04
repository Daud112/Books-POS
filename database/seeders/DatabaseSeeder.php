<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $admin_user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456'),
            'phone' => 'admin@admin.com',
            'role' => 'admin',
        ]);

        $admin_role = Role::create(['name' => 'Admin']);
        $manager_role = Role::create(['name' => 'Manager']);
        $shop_worker_role = Role::create(['name' => 'Shop Worker']);

        $user_view_permission = Permission::create(['name' => 'view user']);
        $user_create_permission = Permission::create(['name' => 'create user']);
        $user_edit_permission = Permission::create(['name' => 'edit user']);
        
        $customer_view_permission = Permission::create(['name' => 'view customer']);
        $customer_create_permission = Permission::create(['name' => 'create customer']);
        $customer_edit_permission = Permission::create(['name' => 'edit customer']);

        $product_view_permission = Permission::create(['name' => 'view product']);
        $product_create_permission = Permission::create(['name' => 'create product']);
        $product_edit_permission = Permission::create(['name' => 'edit product']);
        
        $sale_view_permission = Permission::create(['name' => 'view sale']);
        $sale_create_permission = Permission::create(['name' => 'create sale']);
        $sale_edit_permission = Permission::create(['name' => 'edit sale']);
        $sale_return_permission = Permission::create(['name' => 'return sale']);

        $expense_view_permission = Permission::create(['name' => 'view expense']);
        $expense_create_permission = Permission::create(['name' => 'create expense']);
        $expense_edit_permission = Permission::create(['name' => 'edit expense']);
        

        $admin_role->givePermissionTo($user_view_permission);
        $admin_role->givePermissionTo($user_create_permission);
        $admin_role->givePermissionTo($user_edit_permission);
        $admin_role->givePermissionTo($customer_view_permission);
        $admin_role->givePermissionTo($customer_create_permission);
        $admin_role->givePermissionTo($customer_edit_permission);
        $admin_role->givePermissionTo($product_view_permission);
        $admin_role->givePermissionTo($product_create_permission);
        $admin_role->givePermissionTo($product_edit_permission);
        $admin_role->givePermissionTo($sale_view_permission);
        $admin_role->givePermissionTo($sale_create_permission);
        $admin_role->givePermissionTo($sale_edit_permission);
        $admin_role->givePermissionTo($sale_return_permission);
        $admin_role->givePermissionTo($expense_view_permission);
        $admin_role->givePermissionTo($expense_create_permission);
        $admin_role->givePermissionTo($expense_edit_permission);

        $manager_role->givePermissionTo($user_create_permission);
        $manager_role->givePermissionTo($customer_view_permission);
        $manager_role->givePermissionTo($customer_create_permission);
        $manager_role->givePermissionTo($product_view_permission);
        $manager_role->givePermissionTo($product_create_permission);
        $manager_role->givePermissionTo($sale_view_permission);
        $manager_role->givePermissionTo($sale_create_permission);
        $manager_role->givePermissionTo($sale_edit_permission);
        $manager_role->givePermissionTo($sale_return_permission);
        $manager_role->givePermissionTo($expense_create_permission);


        $shop_worker_role->givePermissionTo($product_create_permission);
        $shop_worker_role->givePermissionTo($sale_create_permission);

        $admin_user->assignRole('Admin');
    }
}
