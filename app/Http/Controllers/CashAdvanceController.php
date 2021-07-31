<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Employee;
use App\Models\CashAdvance;

class CashAdvanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $employees= Employee::get();
        return view('pages.cash-advance', ['page' => 'Employee Cash Advance', 'employees' => $employees]);
    }

    public function store(Request $request)
    {
        if($request->cash_amount == null)
        {
            return back()->withErrors(['invalid'=> 'Cannot add cash advance of zero.']);
        }
        
        CashAdvance::create([
            'employee_id'=>$request->empID,
            'cash_amount'=>$request->cash_amount,
            'date_of_ca'=>$request->date,
        ]);

        return back()->with('success','Cash advance was suucessfully made for employee '. $request->empID .' .');
    }
}
