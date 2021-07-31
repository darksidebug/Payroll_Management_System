<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DeleteEmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Employee $employee)
    {
        return view('pages.confirm-delete', ['page' => 'Employee','employee'=>$employee]);
    }

    public function delete($employee_id)
    {
        $employee = Employee::findOrFail($employee_id);
        $employee->delete();

        return redirect('/employee/view-employee-lists')->with('status',"Information deleted successfully");;
    }
}