<?php

namespace App\Http\Controllers;

use App\Models\Benifits;
use App\Models\Employee;
use App\Models\ServiceCharge;
use App\Models\Preference;
use App\Models\SSS;
use Exception;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
    }

    public function filter(Request $request)
    {
        $request->validate([
            'date_from'=>'required|date',
            'date_to'=>'required|date|after_or_equal:date_from',
        ]);

        $employees=Employee::all();
        
        try{
            $preferences=Preference::firstOrFail();
            
        }catch(Exception $e)
        {
            return redirect(route('preference'));
        }

        try{
            $benefits=Benifits::firstOrFail();
    
        }catch(Exception $e)
        {
            return redirect(route('benefits'));
        }

        $sss=SSS::all();


        $convertedFrom=\Carbon\Carbon::createFromFormat('Y-m-d',$request->date_from);
        $convertedTo=\Carbon\Carbon::createFromFormat('Y-m-d',$request->date_to);
        
        $rangetStr="";

        if($convertedFrom->isSameYear($convertedTo) && $convertedFrom->isSameMonth($convertedTo)){
            $rangetStr=$convertedFrom->englishMonth . ' '.$convertedFrom->day.'-'.$convertedTo->day. ','.$convertedFrom->year;
        }else{
            $rangetStr=$convertedFrom->format('M d,Y') .'-'.$convertedTo->format('M d,Y');
        }

        $sc=ServiceCharge::get()->whereBetween('date_save',[$convertedFrom,$convertedTo]);;

        $sc_id = '';
        foreach ($sc as $key => $value) {
            $sc_id = $value->id;
        }

        return view('pages.payroll', [
            'page' => 'Payroll Management', 
            'dtr' => TRUE,
            'isFiltered'=>true,
            'employees'=>$employees,
            'preferences'=>$preferences,
            'benefits'=>$benefits,
            'rangeDates'=>$rangetStr,
            'from'=>$request->date_from,
            'to'=>$request->date_to,
            'sssConfig'=>$sss,
            'sc' => $sc->sum('sc_amount'),
            'sc_id' => $sc_id
        ]);
    }


    public function index()
    {

        return view('pages.payroll', [
            'page' => 'Payroll Management', 
            ]);
    }

    public function store(Request $request)
    {
        ServiceCharge::create([
            'sc_amount'=>$request->amount,
            'date_save'=>date('Y-m-d')
        ]);

        return back()->with('success', 'Distribution of service charge were added successfully!');
    }
}
