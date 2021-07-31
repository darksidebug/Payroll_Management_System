<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Employee;
use App\Models\CashAdvance;

class DeleteEmployeeCashAdvances extends Controller
{
    public function delete($id)
    {
        $ca = CashAdvance::where('id', $id);
        $ca->delete();

        return back()->with('success',"Cash Advance detail has been remove successfully!");
    }

    public function deleteAll($id)
    {
        $ca = CashAdvance::where('employee_id', $id);
        $ca->delete();

        return back()->with('success',"Employee's cash advances details has been reset successfully!");
    }

    public function resetAll()
    {
        $ca = CashAdvance::select();
        $ca->delete();

        return back()->with('success',"All employee cash advances has been reset successfully!");
    }
}
