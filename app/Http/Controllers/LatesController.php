<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\TimeLog;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LatesController extends Controller
{

    protected $dateNow;

    public function __construct()
    {
        $this->middleware('auth');
        $this->dateNow=Carbon::now()->format('Y-m-d');
    }
    public function index()
    {
        $lateLogs=TimeLog::where('mins_late','>',0)
                                ->orderBy('log_date','desc')
                                ->paginate(10);
        return view('pages.all-lates', ['page' => 'Late Employees','logs'=>$lateLogs]);
    }

    public function today()
    {
        $lateTodayLog=TimeLog::where('log_date',$this->dateNow)
                                ->where('mins_late','>',0)
                                ->get();

        return view('pages.lates-per-day', ['page' => 'Employee Lates','logs'=>$lateTodayLog]);
    }
}
