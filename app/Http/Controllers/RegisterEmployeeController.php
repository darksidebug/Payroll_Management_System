<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterEmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('pages.create-employee');
    }

    public function store(Request $request)
    {
       
        $this->validate($request,[
            'firstname'=>'required',
            'lastname'=>'required',
            'address'=>'required',
            'contact'=>'required|size:11',
            'time_in'=>'required|date_format:H:i',
            'time_out'=>'required|date_format:H:i|after:time_in',
            'password'=>'required|confirmed|min:4',
            'basic_salary'=>'required|numeric|min:0',
            'expected_number_of_work_days'=>'required|numeric|min:1',
        ]);

        $employee=Employee::create([
            'firstname'=>$request->firstname,
            'middlename'=>$request->middlename,
            'lastname'=>$request->lastname,
            'suffix'=>$request->suffix,
            'address'=>$request->address,
            'contact_number'=>$request->contact,
            'time_in'=>$request->time_in,
            'time_out'=>$request->time_out,
            'password'=>Hash::make($request->password)
        ]);

        Salary::create([
            'employee_id'=>$employee->id,
            'salary'=>$request->basic_salary,
            'num_of_work_days'=>$request->expected_number_of_work_days
        ]);

    
        return back()->with('status','New employee was successfully registered');
        
    }
}
