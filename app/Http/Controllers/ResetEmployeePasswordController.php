<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetEmployeePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Employee $employee)
    {

        return view('pages.password-reset', ['page' => 'Employee','employee'=>$employee]);
    }

    public function update(Employee $employee, Request $request, $employee_id){
        $this->validate($request, [
            'password' => 'sometimes|min:4|required'
        ]);

        if($request->password != $request->cfm_password){
            return back()->with('error', 'Password did not matched!');
        }

        $employee = Employee::find($employee_id);
        $employee->password = Hash::make($request->password);
        $employee->update();

        return back()->with('status',"Password reset successfully.");
    }
}