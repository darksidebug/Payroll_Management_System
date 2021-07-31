<?php

namespace App\Http\Controllers;

use App\Models\Benifits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SetBenifitsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $sss = 0;
        $philhealth = 0.00;
        $gsis = 0.00;
        $pag_ibig = 0.00;
        $id = '';
        $benifits = Benifits::get();

        foreach($benifits as $pref){
            $sss = $pref->sss;
            $philhealth = $pref->philhealth;
            $pag_ibig = $pref->pag_ibig;
            $id = $pref->id;
        }
        return view('pages.benifits', ['page' => 'Setup Benefits Deduction', 'id' => $id, 'sss' => $sss, 'philhealth' => $philhealth, 'pag_ibig' => $pag_ibig]);
    }

    public function messages()
    {
        return [
            'philhealth.min'=>'PhilHealth contribution should be at least greater than 0',
            'sss.min'=>'SSS contribution should be at least greater than 0',
            'pag_ibig.min'=>'Pag Ibig contribution should be at least greater than 0',
        ];
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            // 'sss'=>'required|numeric|min:0',
            'philhealth'=>'required|numeric|min:0',
            'pag_ibig'=>'required|numeric|min:0'
        ],$this->messages());
        
        if($request->id != ''){

            $preference = Benifits::find($request->id);
            // $preference->sss = $request->sss;
            $preference->philhealth = $request->philhealth;
            $preference->pag_ibig = $request->pag_ibig;
            $preference->update();
        }
        else{
            Benifits::create([
                // 'sss'=>$request->sss,
                'philhealth'=>$request->philhealth,
                'pag_ibig'=>$request->pag_ibig
            ]);
        }

        return back()->with('success','Benefits deductions are set!');
    }
}
