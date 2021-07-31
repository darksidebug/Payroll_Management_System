<?php

namespace App\Http\Controllers;

use App\Models\Preference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SetPreferenceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $max_ot = 0;
        $night_dif = 0.00;
        $rate = 0.00;
        $id = '';
        $preference = Preference::get();

        foreach($preference as $pref){
            $max_ot = $pref->max_ot;
            $night_dif = $pref->night_dif;
            $rate = $pref->rate_per_day;
            $id = $pref->id;
        }
        return view('pages.preference', ['page' => 'Setup Preferences', 'id' => $id, 'rate' => $rate, 'night_dif' => $night_dif, 'max_ot' => $max_ot]);
    }
    public function messages()
    {
        return [
            'night_dif.min'=>'Night differential should at least be 10%',
        ];
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'max_ot'=>'required|numeric|gt:0',
            'night_dif'=>'required|numeric',
        
        ],$this->messages());
        
        if($request->id != ''){

            $preference = Preference::find($request->id);
            $preference->max_ot = $request->max_ot;
            $preference->night_dif = $request->night_dif;
            
            $preference->update();
        }
        else{

            Preference::create([
                'max_ot'=>$request->max_ot,
                'night_dif'=>$request->night_dif,
               
            ]);
        }

        return back()->with('success','Preferences are set!');
    }
}
