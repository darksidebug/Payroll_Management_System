<?php

namespace App\Http\Controllers;

use App\Models\TimeLog;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User as Authenticatable;

class DashboardController extends Controller
{
    protected $dateNow;

    public function __construct()
    {
        $this->middleware('auth');
        $this->dateNow = Carbon::now()->format('Y-m-d');
    }

    public function index()
    {
        $dateToday = Carbon::now()->format('Y-m-d');
        $timeLogs = TimeLog::where('log_date',$dateToday)->get();

        $lateTodayLog = TimeLog::where('log_date', $this->dateNow)
                                ->where('mins_late','>',0)
                                ->get();

        $employees = Employee::get();

        return view('pages.dashboard', ['page' => 'Dashboard', 'timeLogs' => $timeLogs, 'dateToday' => $dateToday, 
                    'lateToday' => $lateTodayLog, 'employees' => $employees]);
    }
}
