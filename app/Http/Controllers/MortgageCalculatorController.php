<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MortgageApplication;
use Illuminate\Support\Facades\Auth;

class MortgageCalculatorController extends Controller
{
    public function __construct()
    {
        // Ensure the user is authenticated before accessing any methods in this controller
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('mortgage_calculator');    
    }

    public function submitForm(Request $request)
    {
        $validated = $request->validate([
            'property_price' => 'required|numeric',
            'down_payment' => 'required|numeric',
            'load_duration' => 'required|integer|min:1|max:30',
            'intrest_rate' => 'required|numeric|min:0|max:100',
            'monthely_payment' => 'required|numeric',
        ]);

        $user = Auth::user();

        $mortgage = MortgageApplication::create([
            'property_price' => $request->property_price,
            'down_payment' => $request->down_payment,
            'loan_duration' => $request->load_duration,
            'interest_rate' => $request->intrest_rate,
            'monthely_payment' => $request->monthely_payment,
            'email' => $user->email,
            'user_id' => $user->id
        ]);

        return back()->with('success', 'Mortgage form submitted successfully!');
    }

    
    public function submitedForm(){
    $contact = MortgageApplication::orderBy('id', 'desc')->paginate(10);
    return view('admin.mortgage_data', compact('contact')); 
    }
}
