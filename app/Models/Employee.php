<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable=[
        'firstname',
        'middlename',
        'lastname',
        'suffix',
        'address',
        'contact_number',
        'time_in',
        'time_out',
        'break_mins',
        'password'
    ];

    protected function hasClockedOn($date,$clockTimeColumnName){
        return $this->time_logs->where('log_date',$date)->where($clockTimeColumnName,'!=',null)->count()>0?true:false;    
    }

    public function hasTimedInAmAt($date){
        return $this->hasClockedOn($date,'time_in');
    }
    public function hasTimedOutAmAt($date){

        return $this->hasClockedOn($date,'time_out_am');
    }

    public function hasTimedInPmAt($date)
    {

        return $this->hasClockedOn($date,'time_in_pm');
    }

    public function hasTimedOutPmAt($date)
    {

        return $this->hasClockedOn($date,'time_out');
    }

    public function getHoursOfWorkPerDay()
    {
       $timeInCarbon=Carbon::createFromFormat('H:i:s',$this->time_in);
       $timeOutCarbon=Carbon::createFromFormat('H:i:s',$this->time_out);

       $timeOutSubBreak=$timeOutCarbon->subMinutes($this->break_mins);


        $hourDifference=$timeInCarbon->floatDiffInHours($timeOutSubBreak,false);
        
        return $hourDifference;

    }

    public function getTotalHoursWorked($from,$to)
    {
        return $this->toAccounting($this->time_logs->whereBetween('log_date',[$from,$to])->sum('num_of_hours'));
    }

    public function grossSalary($from,$to)
    {
        $totalHoursWorked=$this->getTotalHoursWorked($from,$to);
        return $this->toAccounting($totalHoursWorked*$this->getPerHourSalary());
    }


    public function getPerMinSalary()
    {
        return $this->toAccounting($this->getPerHourSalary()/60);
    }

    public function getDeductionFromLates($from,$to)
    {
        $minsLate=$this->getMinsLate($from,$to);
        return $this->toAccounting($minsLate*$this->getPerMinSalary());
    }

    public function getSSSDeduction()
    {
        $basicSalary=$this->salary->salary;
    
        $sss= SSS::all();

        foreach ($sss as $sssConfig)
        {
            if($basicSalary>=$sssConfig->min_salary && $basicSalary<=$sssConfig->max_salary)
            {
                return $this->toAccounting($sssConfig->employee_has_to_pay);
            }
        }
       
    }

    public function getPhilHealthDeduction()
    {
        $basicSalary=$this->salary->salary;

        $benefits=Benifits::first();
        return $this->toAccounting($basicSalary* ($benefits->philhealth/100));
    }

    public function getPagIbigDeduction()
    {
        $benefits=Benifits::first();
        return $this->toAccounting($benefits->pag_ibig);
    }
    public function getMinsLate($from,$to)
    {
        return $this->toAccounting($this->time_logs->whereBetween('log_date',[$from,$to])->sum('mins_late'));
    }
    public function getPerHourSalary()
    {
        $basicSalary=$this->salary->salary;
        $workDays=$this->salary->num_of_work_days;

        $perDaySalary=$basicSalary/$workDays;

        $perHourSalary=$perDaySalary/$this->getHoursOfWorkPerDay();

        return $perHourSalary;
    }

    public function time_logs() 
    {
        return $this->hasMany(TimeLog::class);
    }

    public function salary()
    {
        return $this->hasOne(Salary::class);
    }

    public function getFullName()
    {
        return $this->firstname . ' '.$this->lastname. ' '.$this->suffix;
    }


    protected function toAccounting($num)
    {
        return number_format($num,'2','.',',');
    }
    public function getSalary()
    {
        return $this->toAccounting($this->salary->salary);
    }

    public function employee_status()
    {
        return $this->hasOne(EmployeeStatuses::class);
    }

    public function cash_advance()
    {
        return $this->hasMany(CashAdvance::class);
    }
}
