<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class DtrController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $routeName=Route::currentRouteName();

        return view('pages.dtr', ['page' => 'Daily Time Record', 'dtr' => TRUE,'route'=>$routeName]);
    }

    public function searchEmpDtr(Request $request)
    {
        
        $employee=Employee::find($request->empId);
        $routeName=Route::currentRouteName();

        return view('pages.dtr', ['page' => 'Daily Time Record', 'dtr' => TRUE,'employee'=>$employee,'route'=>$routeName]);


    }

    public function messages()
    {
        return [
            'empId.required'=>'Employee ID is required',
            'from.required' => 'The FROM date is required',
            'to.required' => 'The TO date is required',
            'to.after'=>'The TO must be a date after FROM'
        ];
    }

    public function filter(Employee $employee,Request $request)
    {
    
        $this->validate($request,[
            'from'=>'required|date|',
            'to'=>'required|date|after_or_equal:from'
        ],$this->messages());


        $from=Carbon::createFromFormat('Y-m-d',$request->from)->format('M d,Y');
        $to=Carbon::createFromFormat('Y-m-d',$request->to)->format('M d,Y');


        $timeLogs=$employee->time_logs
                            ->whereBetween('log_date',[$request->from,$request->to]);
                            

        return back()->with([
            'success'=>true,
            'fromFormatted'=>$from,
            'toFormatted'=>$to,
            'timeLogs'=>$timeLogs,
            'employee'=>$employee
        ])->withInput([
            'from'=>$request->from,
            'to'=>$request->to,
        ]);
            


    }
}
