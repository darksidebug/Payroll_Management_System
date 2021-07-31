@extends('layout.main-layout')

@section('emp_payroll_content')


@php

function toAccounting($num)
{
    return number_format($num, 2, '.', ',');
}

@endphp
    <style>
        @media print{
            .not-include
            {
                display: none !important;
            }
        }
    </style>
    <style media='print'>
        @page {
            size: landscape !important;
        }
    </style>
    <div class="container-fluid mt-0">
        <div class="row">
            <div class="col-md-12">
                <div class="card o-hidden border-0 shadow-lg my-3">
                    <div class="card-body pb-5">
                        <div class="row mb-0 not-include">
                            <div class="col-md-12 mt-3 pb-0 pl-3 pr-3">
                                <h6>Select a range of date:</h6>
                                <form class="form-inline mr-auto w-100 navbar-search" action="{{route('payroll.filter')}}">
                                    <div class="input-group mr-1">
                                        <div class="row justify-content-between ml-0 mr-0 border rounded-sm">
                                            <span class="pt-2 pl-2">Date From:</span>
                                            <input type="date" name='date_from' value="{{isset($from)?$from:old('date_from')}}" class="form-control bg-light border-0 small ml-1 rounded-0 @error('date_from') is-invalid @enderror" placeholder="dd/mm/yyyy" aria-label="Search" aria-describedby="basic-addon2">
                                        </div>

                                        <div class="row justify-content-between ml-1 border rounded-sm">
                                            <span class="pt-2 pl-2">Date To:</span>
                                            <input type="date" name='date_to' value="{{isset($to)?$to:old('date_to')}}"  class="form-control bg-light border-0 small ml-1 rounded-0 @error('date_to') is-invalid @enderror" placeholder="dd/mm/yyyy" aria-label="Search" aria-describedby="basic-addon2">
                                        </div>

                                        <div class="ml-3">
                                            <button class="btn btn-primary rounded-sm pt-2 pb-2" type="submit">
                                            <i class="fas fa-search fa-sm"></i> View
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        @if(isset($from)  && !$errors->any())

                        {{-- PAYROLL TABLE --}}
                        
                        <div class="row" id="payrollTable">
                            <div class="col-md-12 mt-0 mb-5 pl-3 pr-3">
                                <div class="mt-3">
                                    <button type="button" onClick="$('#confirm').attr('action', '{{ !empty($sc_id) ? route('update.charge') : route('payroll.add_charge') }}')" id="add_service_charge" class="btn btn-primary ml-0 rounded-sm pt-2 pb-2  not-include" data-toggle="modal" data-target="#confirmModal"><i class="fas fa-plus pr-1"></i> Service Charge</button>
                                    <button type="button" id="printBtn" class="btn btn-secondary ml-0 rounded-sm pt-2 pb-2  not-include"><i class="fas fa-print pr-1"></i> Print Payroll</button>
                                    <button type="button" class="btn btn-success mt-0 ml-0 rounded-sm pt-2 pb-2 not-include" onClick="window.location.reload()"><i class="fas fa-recycle pr-1"></i> Refresh Payroll</button>
                                </div>
                                @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                    <strong>Great!</strong> {{session('success')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>                                
                                </div>
                                @endif
                                <div class="table-responsive">
                                    <table class="table table-bordered mt-2 mb-4" style="min-width: 1800px !important;">
                                        <thead>
                                            <tr>
                                                <td colspan="16" class="text-center border-bottom-0 pt-3 pb-3">
                                                    CAFE ROMARA PAYROLL<br>
                                                    <small>{{$rangeDates}}</small>
                                                </td>
                                            </tr>
                                            <tr id="columnheaders">
                                                <td class="pt-1 pb-1 border-bottom-0 text-center"><small>ID No</small></td>
                                                <td class="pt-1 pb-1 border-bottom-0 text-center"><small>Name</small></td>
                                                <td class="pt-1 pb-1 border-bottom-0 text-center"><small>Basic Salary</small></td>
                                                <td class="pt-1 pb-1 border-bottom-0 text-center"><small>Worked for (hrs)</small></td>
                                                <td class="pt-1 pb-1 border-bottom-0 text-center"><small>Mins. Late</small></td>
                                                <td class="pt-1 pb-1 border-bottom-0 text-center"><small>No. of OT</small></td>
                                                <td class="pt-1 pb-1 border-bottom-0 text-center"><small>Total hours worked</small></td>
                                                <td class="pt-1 pb-1 border-bottom-0 text-center"><small>SSS</small></td>
                                                <td class="pt-1 pb-1 border-bottom-0 text-center"><small>PhilHealth ({{$benefits->philhealth . '%'}})</small></td>
                                                <td class="pt-1 pb-1 border-bottom-0 text-center"><small>Pag-ibig</small></td>
                                                <td class="pt-1 pb-1 border-bottom-0 text-center"><small>CA</small></td>
                                                <td class="pt-1 pb-1 border-bottom-0 text-center"><small>SC</small></td>
                                                <td class="pt-1 pb-1 border-bottom-0 text-center"><small>Gross Salary </small></td>
                                                <td class="pt-1 pb-1 border-bottom-0 text-center"><small>Total Ded.</small></td>
                                                <td class="pt-1 pb-1 border-bottom-0 text-center"><small>Net Salary</small></td>
                                                <td class="pt-1 pb-1 border-bottom-0 text-center pl-5 pr-5"><small>Signature</small></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            

                                            @forelse ( $employees as $index=>$employee)
                                            <tr>
                                                <td class="pt-0 pb-0 text-center"><small>{{$employeeId=$employee->id}}</small></td>
                                                <td class="pt-0 pb-0 text-center"><small>{{$fullName="{$employee->firstname} {$employee->lastname} {$employee->suffix}"}}</small></td>
                                                <td class="pt-0 pb-0 text-left"><small>Php {{$basicSalary=toAccounting($employee->salary->salary)}}</small></td>
                                                <td class="pt-0 pb-0 text-center"><small>{{$numOfHours=toAccounting($employee->time_logs->whereBetween('log_date',[$from,$to])->sum('num_of_hours'))}}</small></td>
                                                <td class="pt-0 pb-0 text-center"><small>{{ $numOfMinsLate=$employee->time_logs->whereBetween('log_date', [$from,$to])->sum('mins_late') }}</small></td>
                                                <td class="pt-0 pb-0 text-center"><small>{{ $numOfOt=toAccounting($employee->time_logs->whereBetween('log_date',[$from,$to])->sum('num_of_ot')) }}</small></td>
                                                <td class="pt-0 pb-0 text-center"><small>{{ $totalHoursWorked=toAccounting(toAccounting($employee->time_logs->whereBetween('log_date',[$from,$to])->sum('num_of_hours')) + toAccounting($employee->time_logs->whereBetween('log_date',[$from,$to])->sum('num_of_ot'))) }}</small></td>
                                                <td class="pt-0 pb-0 text-center">
                                                

                                                        @php
                                                            $sssAmount=0;
                                                            foreach ($sssConfig as $config){
                                                                if ($employee->salary->salary>=$config->min_salary && $employee->salary->salary<=$config->max_salary ){
                                                                    $sssAmount=$config->employee_has_to_pay;
                                                                }
                                                            }
                            
                                                        @endphp
                                                    
                                                    <small>{{ $sss=toAccounting($sssAmount) }}</small>
                                                
                                                </td>
                                                <td class="pt-0 pb-0 text-center"><small>{{ $philHealthStr = toAccounting($philHealth=$employee->salary->salary *($benefits->philhealth/100)) }}</small></td>
                                                <td class="pt-0 pb-0 text-center"><small>{{ $pagIbigStr = toAccounting($pagIbig=$benefits->pag_ibig) }}</small></td>
                                                
                                                @php
                                                    $salary=$employee->salary->salary;
                                                    $expectedNumOfWorkDays=$employee->salary->num_of_work_days;

                                                    $perDaySalary=$salary/$expectedNumOfWorkDays;

                                                    $expectedNumOfHoursToWork=$employee->getHoursOfWorkPerDay();

                                                    $perHourSalary=$perDaySalary/$expectedNumOfHoursToWork;

                                                    $perMinuteSalary=$perHourSalary/60;

                                                    $ca=$employee->cash_advance->whereBetween('date_of_ca',[$from,$to]);
                                                    
                                                    $total=$ca->sum('cash_amount');
                                                    
                                                    $deductionFromLates=$numOfMinsLate * $perMinuteSalary;

                                                    $totalDeductions=($sss + $philHealth) + ($pagIbig + $deductionFromLates) + $total;

                                                @endphp


                                                <td class="pt-0 pb-0 text-left"><small>Php {{ toAccounting($total) }}</small></td>
                                                <td class="pt-0 pb-0 text-left"><small>Php {{ toAccounting($sc) }}</small></td>
                                                <td class="pt-0 pb-0 text-left"><small>Php {{ $grossIncome=toAccounting($sc + ($grossSalary=$totalHoursWorked*$perHourSalary)) }}</small></td>
                                                <td class="pt-0 pb-0 text-left"><small>Php {{ toAccounting($totalDeductions) }}</small></td>
                                                <td class="pt-0 pb-0 text-left"><small>Php {{ $netIncome=toAccounting($sc + ($grossSalary-$totalDeductions)) }}</small></td>
                                                <td class="pt-0 pb-0 text-center"><small></small></td>
                                            </tr>

                                            @php

                                            // $index=0;

                                            $tableData[$index]['employee_id']=$employeeId;
                                            $tableData[$index]['name']=$fullName;
                                            $tableData[$index]['basic_salary']=$basicSalary;
                                            $tableData[$index]['num_of_hours']=$numOfHours;
                                            $tableData[$index]['late']=$numOfMinsLate;
                                            $tableData[$index]['num_of_ot']=$numOfOt;
                                            $tableData[$index]['total_hours_worked']=$numOfHours+$numOfOt;
                                            $tableData[$index]['sss']=$sss;
                                            $tableData[$index]['philhealth']=$philHealth;
                                            $tableData[$index]['pag_ibig']=$pagIbig;
                                            $tableData[$index]['cash_advance']=$ca;
                                            $tableData[$index]['gross']=$grossIncome + $sc;
                                            $tableData[$index]['deductions']=$totalDeductions;
                                            $tableData[$index]['service_charge']=$sc;
                                            $tableData[$index]['net']=$netIncome + $sc;
                                            $tableData[$index]['signature']='';

                                            $index++;
                                            @endphp
                                            @empty
                                            <tr>
                                                <td class="pt-0 pb-0 text-center" colspan="16"><small>No records found</smal></td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @endif
                        {{-- END PAYROLL TABLE --}}

                        @php

                            $isTableDataAvailable=isset($tableData);

                            if($isTableDataAvailable){
                                $jsonTableData=json_encode($tableData);
                            }
                        
                            
                        @endphp

                        @if($isTableDataAvailable)
                        <input type='text' id='jsonData' value='{{ !empty($jsonTableData) ? $jsonTableData : "" }}' hidden>
                        @endif
                        <h6 class="text-primary ml-2">Note: To print this payroll in landscape format, press 'Ctrl + P'</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-confirm fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Service Charge Distribution</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i>&times</i>
                    </button>
                </div>
                <div class="modal-body pl-4 pr-4 pb-4">
                    <form action="" method="post" id="confirm">
                        @csrf
                        <div class="row">
                            <div class="col-md-8 offset-md-2 col-sm-10 offset-sm-1">
                                <label>Amount Per Employee</label>
                                <input type="hidden" name="sc_id" value="{{ !empty($sc_id) ? $sc_id : '' }}">
                                <input type="number" class="form-control" name="amount" min=0 required value="{{ !empty($sc) ? toAccounting($sc) : '0.00' }}">
                                <button type="submit" class="btn btn-primary mt-4"><i class="fa fa-{{ !empty($sc_id) ? 'edit' : 'plus'}} pr-1"></i> {{ !empty($sc_id) ? 'Update' : 'Add'}}</button>
                                <button type="button" class="btn btn-secondary mt-4" data-dismiss="modal" aria-label="Close"><i class="fa fa-times pr-1"></i> Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>

    <script>
        $(document).ready(function()
        {
        
            const printBtn=$("#printBtn");
            let data=$('#jsonData').val();
            let jsonData=JSON.parse(data)
        
            let properties=[
                {field:'employee_id',displayName:'Employee ID'},
                {field:'name',displayName:'Name'},
                {field:'basic_salary',displayName:'Basic Salary'},
                {field:'num_of_hours',displayName:'No. of hrs. worked'},
                {field:'late',displayName:'Lates (mins)'},
                {field:'num_of_ot',displayName:'No. of OT hrs.'},
                {field:'total_hours_worked',displayName:'Total hrs. worked'},
                {field:'sss',displayName:'SSS'},
                {field:'philhealth',displayName:'PhilHealth'},
                {field:'pag_ibig',displayName:'Pag-ibig'},
                {field:'cash_advance',displayName:'CA'},
                {field:'service_charge',displayName:'SC'},
                {field:'gross',displayName:'Gross Salary'},
                {field:'deductions',displayName:'Total Deductions'},
                {field:'net',displayName:'Net Salary'},
                {field:'signature',displayName:'Signature'},
            ]

        
            @if($isTableDataAvailable)
            let header="<style>* {font-family: Roboto, system-ui, sans-serif;}</style></style><div class='text-center'>"+
                        "<h3 style='font-family: Roboto, system-ui, sans-serif;'>Cafe Romara Payroll</h3>"+
                        "<p>{{$rangeDates}}</p>"+
                        "</div>";
            @endif
        
            printBtn.click(function(e){
                printJS({
                    printable:jsonData,
                    properties: properties,
                    type:'json',
                    header: header,
                    style: '.text-center { text-align: center; font-family: Roboto, system-ui, sans-serif}',
                    gridStyle: 'border: 1px solid gray;text-align:center'
                    
                })
            })

        })

    </script>
@endsection