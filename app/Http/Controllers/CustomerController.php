<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    public function searchCustomers(Request $request)
    {
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
    public function create($data)
    {   
        $data->validate([
            'name' => 'required',
            'phone' => 'required|min:11|max:11',
        ]);

        $customer_data = [
            'name'  => $data->name,
            'phone' => $data->phone,
        ];
        
        return Customer::create($customer_data);
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
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
