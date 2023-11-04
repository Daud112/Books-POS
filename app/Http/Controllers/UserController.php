<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::check()){
            return view('auth.login');
        }

        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        $role = $user->getRoleNames();
        $permissions = $user->getPermissionsViaRoles();
        return view('admin.user.show', compact('user','role','permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data.
        $request->validate([
            'name' => 'required',
            'phone' => 'required|min:11|max:11',
            'role' => 'required'
        ]);

        // Retrieve the user by ID.
        $user = User::find($id);

        if (!$user) {
            // Handle the case where the user with the given ID is not found.
            return response()->json(['error' => 'User not found'], 404);
        }

        // Update the other user attributes.
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->role = $request->input('role');
        $user->email = $user->email;

        // Save the updated user.
        if($user->save()){
            $user->assignRole($user->role);
            $users = User::all();
            return view('admin.user.index', compact('users'));
        }
   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function roleAndPermissions()
    {
        $roleNames = [
            'Admin',
            'Manager',
            'Shop Worker'
        ];
        $all_permissions = [
            'view user',
            'create user',
            'edit user',
            'view customer',
            'create customer',
            'edit customer',
            'view product',
            'create product',
            'edit product',
            'view sale',
            'create sale',
            'edit sale',
            'return sale',
            'view expense',
            'create expense',
            'edit expense',
        ];
        
        $roles_with_permissions = [];
        
        foreach ($roleNames as $roleName) {
            $role = Role::where('name', $roleName)->first();
        
            if ($role) {
                $permissions = $role->permissions;
                $roles_with_permissions[$roleName] = [
                    'permissions' => $permissions,
                ];
            }
        }

        return view('admin.user.roles', compact('roleNames','roles_with_permissions','all_permissions'));
    }

    public function updateRoles(Request $request)
    {
        $permissions = $request->input('permissions');
        $all_permissions = [
            'view user',
            'create user',
            'edit user',
            'view customer',
            'create customer',
            'edit customer',
            'view product',
            'create product',
            'edit product',
            'view sale',
            'create sale',
            'edit sale',
            'return sale',
            'view expense',
            'create expense',
            'edit expense',
        ];
        foreach ($permissions as $role => $rolePermissions) {
            $roleModel = Role::where('name', $role)->first();

            if ($roleModel) {
                foreach ($all_permissions as $permission) {
                    if(array_key_exists($permission, $rolePermissions)){
                        $roleModel->givePermissionTo($permission);
                    }else{
                        $roleModel->revokePermissionTo($permission);
                    }
                }
            }else{
                return redirect("/role/permissions")->withSuccess('Role failed to found.');
            }
        }
        return redirect("/role/permissions")->withSuccess('Successfully update roles permission.');
    }
}
