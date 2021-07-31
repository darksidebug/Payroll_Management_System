<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ViewEmployeesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $employees= Employee::get();


        return view('pages.employee-lists', ['page' => 'Employee','employees'=>$employees]);
    }
}
