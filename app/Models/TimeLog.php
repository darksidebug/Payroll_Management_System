<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeLog extends Model
{
    use HasFactory;

    protected $fillable=[
        'time_in',
        'time_out',
        'mins_late',
        'num_of_hours',
        'num_of_ot',
        'total_hours',
        'employees_id',
        'log_date'
    ];


    // public function creatNewLog()
    // {
    //     $this->employee_id=$this->employee()->id;
    //     $this->log_date=Carbon::now()->format('Y-m-d');
    // }



    protected function convertTimeToCarbon($time)
    {


        return Carbon::createFromFormat('H:i:s',$time);
    }


    protected function getMinsDifference($scheduled,$exact)
    {
        $scheduledCarbon=$this->convertTimeToCarbon($scheduled);
        $exactCarbon=$this->convertTimeToCarbon($exact);
        $minsDiff=$scheduledCarbon->diffInMinutes($exactCarbon);
        return $minsDiff;
    }

    protected function isLate($scheduled,$exact)
    {
        $scheduledCarbon=$this->convertTimeToCarbon($scheduled);
        $exactCarbon=$this->convertTimeToCarbon($exact);
        $isLate=$exactCarbon->greaterThan($scheduledCarbon);

        return $isLate;
        
    }



    public function calcNumOfHoursFloat($time1,$time2)
    {
        $time1Carbon=$this->convertTimeToCarbon($time1);
        $time2Carbon=$this->convertTimeToCarbon($time2);

        return $time1Carbon->floatDiffInHours($time2Carbon);
    }

    protected function getLogDateAt($date)
    {
        $timeLog=$this->employee->time_logs()
            ->where('log_date',$date)
            ->first();

        return $timeLog;
    }
    protected function canCalculateNumOfHours($timeIn,$timeOut)
    {
        return $timeIn && $timeOut?true:false;
    }

    public function updateNumOfHoursPm($date)
    {    
        $timeLog=$this->getLogDateAt($date);

        $pmTimeIn=$timeLog->time_in_pm;
        $pmTimeOut=$timeLog->time_out_pm;

        $canCalculate=$this->canCalculateNumOfHours($pmTimeIn,$pmTimeOut);


        if($canCalculate){

            //get scheduled time nga dapat mo sud sija inig ka hapon. Which is  the time gikan sija ming out pag morning plus
            // iyang break time mins
             $timeOutMorning=$this->convertTimeToCarbon($timeLog->time_out_am);
            $scheduledTimeInAfternoon=$timeOutMorning->addMinutes($timeLog->employee->break_mins);
            
            //check if ming sud ug sayo
            if(!$this->isLate($scheduledTimeInAfternoon->format('H:i:s'),$timeLog->time_in_pm))
            {
                $pmNumOfHours=$timeLog->num_of_hours+$this->calcNumOfHoursFloat($scheduledTimeInAfternoon->format('H:i:s'),$timeLog->employee->time_out);
            }else{ // if na late, we calculate from the time in ming time in sija pag PM kutob ming out
                $pmNumOfHours=$timeLog->num_of_hours+$this->calcNumOfHoursFloat($timeLog->time_in_pm,$timeLog->employee->time_out);
            }


            $this->updateNumOfHours($timeLog,$pmNumOfHours);
            return true;

        }
        return false;
    }

    public function updateOverTime($date)
    {
        $timeLog=$this->getLogDateAt($date);
        $expectedOut=$this->employee->time_out;
        $exactOut=$timeLog->time_out;

        $expectedOutCarbon=$this->convertTimeToCarbon($expectedOut);
        $exactOutCarbon=$this->convertTimeToCarbon($exactOut);

    
        $isOt=$exactOutCarbon->greaterThan($expectedOutCarbon);

        $otHours=0;
        if($isOt){

            $otHours=$this->calcNumOfHoursFloat($expectedOut,$exactOut);
            
            $preference=Preference::all('max_ot')->first();

            $otInMins=$otHours*60;
            $exceedsMaxOt=$otInMins>$preference->max_ot;

            if($exceedsMaxOt){ 
                $otHours=($otInMins-$preference->max_ot)/60; // remove the excess hours which goes beyond the maximum set OT
            }

           
        }   
        $clean_ot = explode('.', $otHours);
        $timeLog->num_of_ot=$clean_ot[0];
        $timeLog->save();
      

    }

    public function updateTotalHours($date)
    {
        
        $timeLog=$this->getLogDateAt($date);
        $clean_ot = explode('.', $timeLog->num_of_ot);
        $timeLog->total_hours=$timeLog->num_of_hours+$clean_ot[0];
        $timeLog->save();
    }

    public function updateNumOfHours($timeLog,$newValue)
    {
        $timeLog->num_of_hours=$newValue;
        $timeLog->save();
    }

    public function updateNumOfHoursAm($date)
    {
        
        $timeLog=$this->getLogDateAt($date);
        $canCalculate=$this->canCalculateNumOfHours($timeLog->time_in_am,$timeLog->time_out_am);

        if($canCalculate){

            /*
                check if ang employee ming time in ug sayo.
                If ming time in ug sayo sa ijang intended schedule, we use the scheduled time nija instead
                of calculating number of hours from the time sija ming time in
            */

            //check if ming time in ug sayo
            if (!$this->isLate($timeLog->employee->time_in,$timeLog->time_in_am))
            {
                //calculate numbe of hours from scheduled time nija kutob sa ijang out pag morning
                $amNumOfHours=$this->calcNumOfHoursFloat($timeLog->employee->time_in,$timeLog->time_out_am);
            }else{  // if late man gani we calculate sa ijang pag login kutob out nija sa morning
                $amNumOfHours=$this->calcNumOfHoursFloat($timeLog->time_in_am,$timeLog->time_out_am);
            }

            $this->updateNumOfHours($timeLog,$amNumOfHours);
            return true;
        }
        return false;

    }

    protected function canCalculateLateMorning($timeLog,$keyword)
    {
        return $this->hasClocked($timeLog,$keyword);
       
    }
    protected function canCalculateLateAfternoon($timeLog)
    {
        $canCalculate=$this->hasClocked($timeLog,'out_am') && $this->hasClocked($timeLog,'in_pm') ;

        return $canCalculate;
    }

    protected function getMorningLate($timeLog)
    {
        $sched=$this->employee->time_in;
        $exact=$timeLog->time_in_am;

        $minsLate=0;
        if($this->isLate($sched,$exact))
        {
            $minsLate=$this->getMinsDifference($sched,$exact);
        }
        return $minsLate;

        
    }

    protected function getAfternoonlate($timeLog)
    {
        $timeOutAm=$this->convertTimeToCarbon($timeLog->time_out_am);
        $lunchBreakMins=$this->employee->break_mins;
        $expectedTimeinPm=$timeOutAm->addMinutes($lunchBreakMins);
        $expectedTimeinStr=$expectedTimeinPm->format('H:i:s');
        $employeeExactTimedInPm=$timeLog->time_in_pm;
    
        $late=$this->getMinsDifference($expectedTimeinStr,$employeeExactTimedInPm);
        return $late;
    }

    protected function updateMinsLate($timeLog,$lateValue)
    {  
        $timeLog->mins_late=$lateValue;
        $timeLog->save();
    }

    protected function hasClocked($timeLog,$on)
    {
        switch($on){
            case 'in_am':
                return $timeLog->time_in?true:false;
                break;
            case 'out_am':
                return $timeLog->time_out_am?true:false;
                break;
            case 'in_pm':
                return $timeLog->time_in_pm?true:false;
                break;
            case 'out_pm':
                return $timeLog->time_out_pm?true:false;
                break;
            default:
                return null;
                break;
        }
    }




    public function calcLate($date)
    {
        $employeeTimeLog=$this->getLogDateAt($date);
        $late=0;
        if($this->canCalculateLateMorning($employeeTimeLog,'in_am')){
            $employeeSched=$this->employee->time_in;
            $exactTimeIn=$employeeTimeLog->time_in;
            
            if($this->isLate($employeeSched,$exactTimeIn)){
              $late=$this->getMinsDifference($employeeSched,$exactTimeIn);
            }
            $this->updateMinsLate($employeeTimeLog,$late);  
           
        }


        return $late;

    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

}
