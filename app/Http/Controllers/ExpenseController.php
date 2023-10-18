<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::check()){
            return view('auth.login');
        }

        $expenses = Expense::all();

        $total_expense_amount = 0;
        foreach($expenses as $expense){
            $total_expense_amount += $expense->amount; 
        }

        return view('admin.expense.index', compact('expenses','total_expense_amount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!Auth::check()){
            return view('auth.login');
        }
        return view('admin.expense.create');
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
            'date' => 'required',
            'amount' => 'required',
            'payment_method' => 'required',
        ]);
        $data = $request->all();

        $expense_data = [
            'name'  => $data['name'],
            'description' => $data['description'],
            'date' => $data['date'],
            'amount' => $data['amount'],
            'payment_method' => $data['payment_method'],
        ];
        if($data['payment_method'] == 'online'){
            $expense_data = [
                'payment_no' => $data['payment_no'],
            ]; 
        }
        
        if(Expense::create($expense_data)){
            return redirect("expenses")->withSuccess('New expense created');
        }
    }

    
    /**
     * Show the form for editing the specified resource.
     */
    public function show(Request $request, string $id)
    {
        if(!Auth::check()){
            return view('auth.login');
        }
        $expense = Expense::find($id);
        return view('admin.expense.show', compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        if(!Auth::check()){
            return view('auth.login');
        }
        $expense = Expense::find($id);
        return view('admin.expense.edit', compact('expense'));
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
            'date' => 'required',
            'amount' => 'required',
            'payment_method' => 'required',
            'description'  => 'required',
        ]);

        // Retrieve the user by ID.
        $expense = Expense::find($id);

        if (!$expense) {
            // Handle the case where the expense with the given ID is not found.
            return response()->json(['error' => 'Expense not found'], 404);
        }

        // Update the other user attributes.
        $expense->name = $request->input('name');
        $expense->date = $request->input('date');
        $expense->amount = $request->input('amount');
        $expense->payment_no = $request->input('payment_no');
        $expense->description = $request->input('description');
        $expense->payment_method = $request->input('payment_method');

        // Save the updated user.
        if($expense->save()){
            return redirect("expenses")->withSuccess('Updated expense');
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
