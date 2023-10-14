<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::check()){
            return view('auth.login');
        }

        $customers = Customer::all();
        return view('admin.customer.index', compact('customers'));
    }


    public function searchCustomers(Request $request)
    {
        if(!Auth::check()){
            return view('auth.login');
        }
        $searchTerm = $request->input('term');
        
        // Query the database to find matching customers
        $customers = Customer::where('name', 'like', "%$searchTerm%")
                            ->orWhere('phone', 'like', "%$searchTerm%")
                            ->get();
                            
        return response()->json($customers);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!Auth::check()){
            return view('auth.login');
        }
        return view('admin.customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::check()){
            return view('auth.login');
        }
        $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:customers|min:11|max:11',
        ]);
        $data = $request->all();

        $customer_data = [
            'name'  => $data['name'],
            'phone' => $data['phone'],
        ];
        
        if(Customer::create($customer_data)){
            return redirect("customers")->withSuccess('New customer created');
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        if(!Auth::check()){
            return view('auth.login');
        }
        $customer = Customer::find($id);
        return view('admin.customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data.
        if(!Auth::check()){
            return view('auth.login');
        }
        $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:customers|min:11|max:11',
        ]);

        // Retrieve the user by ID.
        $customer = Customer::find($id);

        if (!$customer) {
            // Handle the case where the customer with the given ID is not found.
            return response()->json(['error' => 'Customer not found'], 404);
        }

        // Update the other user attributes.
        $customer->name = $request->input('name');
        $customer->phone = $request->input('phone');

        // Save the updated user.
        if($customer->save()){
            return redirect("customers")->withSuccess('Updated customer');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
