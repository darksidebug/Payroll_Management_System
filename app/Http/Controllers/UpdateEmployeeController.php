<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UpdateEmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Employee $employee)
    {

        return view('pages.update-employee', ['page' => 'Employee','employee'=>$employee]);
    }

    public function store(Employee $employee,Request $request)
    {

        $this->validate($request,[
            'firstname'=>'required',
            'lastname'=>'required',
            'address'=>'required',
            'contact'=>'required|size:11',
            'time_in'=>'required|date_format:H:i',
            'time_out'=>'required|date_format:H:i|after:time_in',
            'break_time'=>'required|numeric|min:0|integer',
            'basic_salary'=>'required|numeric|min:0',
            'expected_number_of_work_days'=>'required|numeric|min:1',
        ]);

        $employee->firstname=$request->firstname;
        $employee->lastname=$request->lastname;
        $employee->middlename=$request->middlename;
        $employee->suffix=$request->suffix;
        $employee->address=$request->address;
        $employee->contact_number=$request->contact;
        $employee->time_in=$request->time_in;
        $employee->time_out=$request->time_out;
        $employee->break_mins=$request->break_time;
        $employee->break_mins=$request->break_time;
        $employee->save();

    

        $employee->salary()->where('id',$employee->salary->id)
                            ->update([
                                    'salary'=>$request->basic_salary,
                                    'num_of_work_days'=>$request->expected_number_of_work_days
                                    ]);

        return back()->with('status',"Updated information successfully");

    }
}
