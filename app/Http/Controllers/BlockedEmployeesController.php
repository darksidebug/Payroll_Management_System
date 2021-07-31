<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeStatuses;
use Illuminate\Http\Request;

class BlockedEmployeesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
    }
    public function index()
    {
        $employeeStatuses=EmployeeStatuses::where('late_count','>=',3)->get();
       

        return view('pages.blocked-employees',['statuses'=>$employeeStatuses]);
    }

    public function unblock(Employee $employee)
    {
       


        $employee->employee_status()->where('employee_id',$employee->id)
                                    ->update(['late_count'=>0]);

        $message=$employee->getFullName(). ' was unblocked successfully!';

        return back()->with('success',$message);
    }
}
