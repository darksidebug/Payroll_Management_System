@extends('layout.main-layout')

@section('late_emp_content')
    <div class="container-fluid mt-0">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="card o-hidden border-0 shadow-lg my-3">
                    <div class="card-body pt-4 pb-4 pl-4 pr-4">

                        <div class="" aria-labelledby="alertsDropdown">
                            <h5 class="ml-3">
                                Employees on Duty
                            </h5>
                            <hr>
                            <h6 class="dropdown-header">
                                (Today) {{\Carbon\Carbon::createFromFormat('Y-m-d',$dateToday)->format('M d,Y')}}
                            </h6>
                            @if($timeLogs->count()>0)
                            @foreach($timeLogs as $timeLog)
                            <a class="dropdown-item d-flex align-items-center mb-2" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-success">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">Expected to login: {{\Carbon\Carbon::createFromFormat('H:i:s',$timeLog->employee->time_in)->format('h:i A')}}</div>
                                    <span class="">{{"{$timeLog->employee->firstname} {$timeLog->employee->lastname} {$timeLog->employee_suffix}"}} 
                                        logged in at {{\Carbon\Carbon::createFromFormat('H:i:s',$timeLog->time_in)->format('h:i A')}}
                                    </span>
                                </div>
                            </a>
                            @endforeach
                            @else
                            <p class='text-center text-info mt-4'>No employee is on duty as of this moment.</p>
                            @endif
                         
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection