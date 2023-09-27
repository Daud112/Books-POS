<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
        return view('admin.user.show', compact('user'));
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
            $users = User::all();
            return view('admin.user.index', compact('users'));
        }
   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
