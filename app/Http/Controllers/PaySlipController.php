<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\PaySlipModel;
use App\Models\TimeLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PaySlipController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
     

        return view('pages.pay-slip', ['page' => 'Employees Pay Slips']);
    }


    protected function makeCarbon($date)
    {
        return Carbon::createFromFormat('Y-m-d',$date);
    }

    
    protected function getTimeLogsWhereLogsBetween($from,$to)
    {
        return TimeLog::whereBetween('log_date',[$from,$to])->get();
     
    }
   
    public function filter(Request $request)
    {
        $request->validate([
            'date_from'=>'required|date',
            'date_to'=>'required|date|after:date_from',
        ]);
        
        $fromDate=$this->makeCarbon($request->date_from);
        $toDate=$this->makeCarbon($request->date_to);

        $fromStr="";

        if($fromDate->isSameMonth($toDate) && $fromDate->isSameYear($toDate))
        {
            $fromStr=$fromDate->englishMonth . ' '.$fromDate->day.'-'.$toDate->day. ','.$fromDate->year;
        }else{
            $fromStr=$fromDate->format('M d,Y') .'-'.$toDate->format('M d,Y');
        }


        $employees=Employee::all();
        return view('pages.pay-slip', [
            'page' => 'Employees Pay Slips',
            'from'=>$request->date_from,
            'fromStr'=>$fromStr,
            'to'=>$request->date_to,
            'employees'=>$employees,
        ]);



        
    }
}
