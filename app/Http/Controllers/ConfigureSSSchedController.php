<?php

namespace App\Http\Controllers;

use App\Models\SSS;
use Illuminate\Http\Request;

class ConfigureSSSchedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
       
        $sssTable=SSS::all();

        return view('pages.configure-sss-schedule', [
            'page' => 'SSS Schedule Configuration',
            'currentData'=>$sssTable
            ]);
    }
    public function addRow(Request $request)
    {
        $request->validate([
            'row'=>'required|numeric|min:1',
            'currentRows'=>'numeric|min:0'
        ]);

        $sssTable=SSS::all();

       
      
        return view('pages.configure-sss-schedule', [
            'page' => 'SSS Schedule Configuration',
            'additional_rows'=>$request->row+$request->currentRows,
            'currentData'=>$sssTable
            ]);

    }

    public function deleteAllCurrentData()
    {
        $sss=SSS::all();

        foreach($sss as $item)
        {
            $item->delete();
        }
    }

    

    public function store(Request $request)
    {

    
        $this->validate($request,[
            'minimum.*'=>'numeric|min:0',
            'maximum.*'=>'numeric|min:0|gte:minimum.*',
            'amount.*'=>'numeric|min:0',
        ]);

     
        //TODO: Configure the SSS table and create the payroll

        $this->deleteAllCurrentData();

        for($i=0;$i<count($request->minimum);$i++)
        {

            //we dont create it if all values are zero
            if($request->minimum[$i]>0 || $request->maximum[$i]>0 || $request->amount[$i]>0 )
            {
                SSS::create([
                    'id'=>$i+1,
                    'min_salary'=>$request->minimum[$i],
                    'max_salary'=>$request->maximum[$i],
                    'employee_has_to_pay'=>$request->amount[$i],
                ]);
            }
            
        }

        return back()->with('success','SSS Table was updated successfully!');
       
    }
}
