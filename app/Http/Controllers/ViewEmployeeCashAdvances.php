<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Employee;
use App\Models\CashAdvance;

class ViewEmployeeCashAdvances extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Employee $employee)
    {
        return view('pages.view-cash-advances', ['page' => "Employee's Cash Advance Details", 'employee' => $employee]);
    }

    
}
