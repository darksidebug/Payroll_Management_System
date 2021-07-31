@extends('layout.main-layout')

@section('payslip_content')
<style>
    @media print {
  .col-print-6 {
    flex: 0 0 50%;
    max-width: 50%; } }

@media print {
  .col-print-7 {
    flex: 0 0 58.33333%;
    max-width: 58.33333%; } }

@media print {
  .col-print-8 {
    flex: 0 0 66.66667%;
    max-width: 66.66667%; } }

@media print {
  .col-print-9 {
    flex: 0 0 75%;
    max-width: 75%; } }

@media print {
  .col-print-10 {
    flex: 0 0 83.33333%;
    max-width: 83.33333%; } }

@media print {
  .col-print-11 {
    flex: 0 0 91.66667%;
    max-width: 91.66667%; } }

@media print {
  .col-print-12 {
    flex: 0 0 100%;
    max-width: 100%; } }
</style>
    <div class="container-fluid mt-0">
       
        @if ($errors->any())
            <div class="alert alert-danger">
                <h5>Errors</h5>
                <hr>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
       
            
        
        <div class="row">
            <div class="col-md-12">
                <div class="card o-hidden border-0 shadow-lg my-3">
                    <div class="card-body pb-5">
                        <div class="row mb-0 not-include">
                            <div class="col-md-12 mt-3 pb-0 pl-5 pr-5">
                                <form class="form-inline mr-auto w-100 navbar-search" action="{{route('payslip.filter')}}" method="get">
                                    <div class="input-group">
                                        <div class="row justify-content-between ml-0 mr-0 border">
                                            <span class="pt-2 pl-2">Date From:</span>
                                            <input type="date" name='date_from' value="{{isset($from)?$from:old('date_from')}}" class="form-control bg-light border-0 small ml-1 rounded-0" placeholder="dd/mm/yyyy" aria-label="Search" aria-describedby="basic-addon2">
                                        </div>
                                        <div class="row justify-content-between ml-2 border">
                                            <span class="pt-2 pl-2">Date To:</span>
                                            <input type="date" name='date_to' value="{{isset($to)?$to:old('date_to')}}"  class="form-control bg-light border-0 small ml-1 rounded-0" placeholder="dd/mm/yyyy" aria-label="Search" aria-describedby="basic-addon2">
                                        </div>
                                        <div class="ml-3">
                                            <button class="btn btn-primary rounded-0 pt-2 pb-2" type="submit">
                                            <i class="fas fa-search fa-sm"></i> View
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        


                        @if(isset($from))

                
                        @for ($i = 0; $i < ceil($employees->count()/4); $i++)
                            
                        <div class="row mt-5">
                            
                            @for ($x = $i*4; $x <ceil($employees->count()/4); $x++)
                                
                            {{-- PAYSLIP --}}
                            <div class="mb-md-3 col-md-12 col-print-6  col-lg-10 col-xl-6 pl-5 pr-5">
                                <div class="border border-secondary pt-4 pl-3 pr-3 pb-0">
                                    <h5 class="text-center">
                                        <strong>CAFE ROMARA</strong>
                                    </h5>
                                    <p class="text-center">Pay Slip</p>
                                    <h6 class="text-center pt-0 mt-0" style="position: relative; top: -15px;"><small>From {{$fromStr}}</small></h6>
                                    <p class="text-center">{{$employees[$x]->getFullName()}}</p>
                                    <div class="d-flex justify-content-between pt-2">
                                        <p>Basic Salary: </p>
                                        <p><strong>Php. {{$employees[$x]->getSalary()}}</strong></p>
                                    </div>
                                    <div class="d-flex justify-content-between pt-2">
                                        <p>Total hours worked: </p>
                                        <p><strong>{{$employees[$x]->getTotalHoursWorked($from,$to)}}</strong></p>
                                    </div>
                                  
                                   
                                    <div class="d-flex justify-content-between" style="position: relative; top: -15px;">
                                        <p>Gross: </p>
                                        <p><strong>Php {{$gross=$employees[$x]->grossSalary($from,$to)}}</strong></p>
                                    </div>
                                    <p style="position: relative; top: -15px;">Deductions:</p>
                                    <div class="d-flex justify-content-between pl-3" style="position: relative; top: -20px;">
                                        <p>Deduction from lates: </p>
                                        <p><strong>{{$lates=$employees[$x]->getDeductionFromLates($from,$to)}}</strong></p>
                                    </div>
                                    <div class="d-flex justify-content-between pl-3" style="position: relative; top: -43px;">
                                        <p>SSS: </p>
                                        <p><strong>  {{$sss=$employees[$x]->getSSSDeduction()??"0.00"}}</strong></p>
                                    </div>
                                 
                                    <div class="d-flex justify-content-between pl-3" style="position: relative; top: -65px;">
                                        <p>PhilHealth: </p>
                                        <p><strong>   {{$philhealth=$employees[$x]->getPhilHealthDeduction()}}</strong></p>
                                    </div>
                                    <div class="d-flex justify-content-between pl-3" style="position: relative; top: -80px;">
                                        <p>Pag-Ibig: </p>
                                        <p><strong>{{$pagibig=$employees[$x]->getPagIbigDeduction()}}</strong></p>
                                    </div>
                                
                                    <div class="d-flex justify-content-between" style="position: relative; top: -15px;">
                                        <p>Net: </p>

                                        @php
                                            //change Accounting format numbers to just numbers
                                            function removeComma($str){return str_replace(",","",$str);}

                                            $gross=removeComma($gross);
                                            $lates=removeComma($lates);

                                            $sssHasNoSetUp=$sss=="";
                                            
                                            $sss=removeComma($sss);
                                            $philhealth=removeComma($philhealth);
                                            $pagibig=removeComma($pagibig);
                                          
                                        @endphp



                                        <p><strong>Php {{number_format($gross-$lates-$sss-$philhealth-$pagibig,'2','.',',')}}</strong></p>
                                    </div>
                                </div>
                            </div>
                          
                            {{-- END PAYSLIP --}}
                            @endfor
                        </div>
                        @endfor
                      
                    
                        @endif


                        <p style="page-break-before: always">
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection