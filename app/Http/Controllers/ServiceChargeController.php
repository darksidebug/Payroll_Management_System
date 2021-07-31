<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceCharge;

class ServiceChargeController extends Controller
{
    public function store(Request $request)
    {
        $sc = ServiceCharge::findOrFail($request->sc_id);
        $sc->sc_amount = $request->amount;
        $sc->date_save = date('Y-m-d');
        $sc->update();

        return back()->with('success', 'Distribution of service charge were updated successfully!');
    }
}
