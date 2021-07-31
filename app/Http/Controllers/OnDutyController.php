<?php

namespace App\Http\Controllers;

use App\Models\TimeLog;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OnDutyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

        $dateToday=Carbon::now()->format('Y-m-d');
        $timeLogs=TimeLog::where('log_date',$dateToday)->get();

        return view('pages.on-duty', ['page' => 'Employee on Duty','timeLogs'=>$timeLogs,'dateToday'=>$dateToday]);
    }
}
