<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeStatuses;
use App\Models\TimeLog;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class EmployeeLoginController extends Controller
{
    public function index()
    {
    
        return view('pages.employee-login-page');
    }

    public function confirm(Request $request)
    {
        $employee=Employee::find($request->input);

        if($employee){
            return 'confirmed';
        }else{
            return 'unconfirmed';
        }
    }

    protected function incrementLateCount(Employee $employee)
    {
        
        if($employee->employee_status){
            $employee->employee_status()->update([
                'late_count'=>$employee->employee_status->late_count+1
            ]);
        }else{
            $employee->employee_status()->create([
                'late_count'=>1
            ]);
        }
      
    }

    protected function isEmployeeAllowedToTimeOut(Employee $employee)
    {

        if($employee->employee_status)
        {
            $lateCount=$employee->employee_status->late_count;
            return $lateCount<3;
        }

        return true;
    }

    protected function isAlreadyInEmployeeStatusTbl(Employee $employee)
    {
        return $employee->employee_status?true:false;
    }

    protected function isLateCountUpdatedToday(Employee $employee)
    {
    

        if($this->isAlreadyInEmployeeStatusTbl($employee))
        {
            $lastUpdated=$employee->employee_status->updated_at;
       
            return $lastUpdated->isToday();
        }else{
            return false;
        }
        
    }

    public function login(Request $request)
    {
        $employeeId=$request->employee_id;

      
        $employee=Employee::find($employeeId);


        $isValid=Hash::check($request->password,$employee->password);
        $dateToday=Carbon::now()->format('Y-m-d');
        $currentTime=Carbon::now()->format('H:i:s');
        if($isValid){

            if($employee->hasTimedOutPmAt($dateToday)){
                return 'end_of_sched';
            }

            if(!$employee->hasTimedInAmAt($dateToday)){
                $timeLog=new TimeLog([
                    'employee_id'=>$employeeId,
                    'log_date'=>$dateToday,
                    'time_in'=>$currentTime
                ]);
                $employee->time_logs()->save($timeLog);

                $minsLate=$timeLog->calcLate($dateToday);

                if($minsLate>0){
                    $this->incrementLateCount($employee);
                }
                

            }elseif(!$employee->hasTimedOutPmAt($dateToday)){

                $employee->time_logs()->where('log_date',$dateToday)
                                        ->where('employee_id',$employeeId)
                                        ->update(['time_out'=>$currentTime]);
                $timeLog=TimeLog::where('employee_id',$employeeId)->where('log_date',$dateToday)->first();

                //check if employee logs out early
                $employeeScheduledTimeOutCarbon=Carbon::createFromFormat('H:i:s', $employee->time_out);
                $employeeLogOutTimeCarbon=Carbon::createFromFormat('H:i:s',$timeLog->time_out);

                $isEarlyLogOut=$employeeLogOutTimeCarbon->lessThan($employeeScheduledTimeOutCarbon);

                //if early calculate the num of hours from time in to log out
                if($isEarlyLogOut){
                    $numOfHoursWorked=$timeLog->calcNumOfHoursFloat($employee->time_in,$timeLog->time_out);
                }

                else{//if not, calculate the num of hours from time in to scheduled time out
                    $numOfHoursWorked=$timeLog->calcNumOfHoursFloat($employee->time_in,$employee->time_out);
                }

                $timeLog->updateNumOfHours($timeLog,$numOfHoursWorked);
                $timeLog->updateOverTime($dateToday);
                $timeLog->updateTotalHours($dateToday);
            }

            return 'success';
        }else{
            return 'failed';
        }

    }




}   
