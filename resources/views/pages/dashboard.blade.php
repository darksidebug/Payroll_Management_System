@extends('layout.main-layout')

@section('dashboard_content')
    <div class="container mt-0">
        <div class="row">
            <div class="col-md-4">
                <div class="card o-hidden shadow-lg my-3 border border-warning">
                    <div class="card-header bg-warning">
                        <span class="text-white">Total Employees</span>
                    </div>
                    <div class="card-body pt-3 pb-3 pl-3 pr-3">
                        <div class="d-flex justify-content-between">
                            <h3 class="text-bold mt-1"><strong>{{ $employees->count() }}</strong></h3>
                            <div class="icon-circle bg-warning">
                                <i class="fas fa-users fa-1x text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card o-hidden shadow-lg my-3 border border-info">
                    <div class="card-header bg-info">
                        <span class="text-white">Employees On-Duty</span>
                    </div>
                    <div class="card-body pt-3 pb-3 pl-3 pr-3">
                        <div class="d-flex justify-content-between">
                            <h3 class="text-bold mt-1"><strong>{{ $timeLogs->count() }}</strong></h3>
                            <div class="icon-circle bg-info">
                                <i class="fas fa-user fa-1x text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card o-hidden shadow-lg my-3 border border-danger">
                    <div class="card-header bg-danger">
                        <span class="text-white">Late Employees</span>
                    </div>
                    <div class="card-body pt-3 pb-3 pl-3 pr-3">
                        <div class="d-flex justify-content-between">
                            <h3 class="text-bold mt-1"><strong>{{ $lateToday->count() }}</strong></h3>
                            <div class="icon-circle bg-danger">
                                <i class="fas fa-user fa-1x text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-3">
                <div class="card o-hidden shadow-lg my-3 border border-success">
                    <div class="card-header bg-success">
                        <span class="text-white">Employees On Day-Off</span>
                    </div>
                    <div class="card-body pt-3 pb-3 pl-3 pr-3">
                        <div class="d-flex justify-content-between">
                            <h3 class="text-bold mt-1"><strong>10</strong></h3>
                            <div class="icon-circle bg-success">
                                <i class="fas fa-user fa-1x text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
        <!-- on duty -->
        <div class="row">
            <div class="col-md-6">
                <div class="card o-hidden shadow-lg my-3 border border-secondary">
                    <div class="card-header bg-white">
                        <div class="d-flex justify-content-between">
                            <span class="text-gray">Lists of On-Duty</span>
                            <span>(Today) {{\Carbon\Carbon::createFromFormat('Y-m-d',$dateToday)->format('M d,Y')}}</span>
                        </div>
                    </div>
                    <div class="card-body pt-3 pb-3 pl-3 pr-3">
                        @if($timeLogs->count()>0)
                            @foreach($timeLogs as $timeLog)
                            <a class="dropdown-item d-flex align-items-center mb-2" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-success">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    {{$timeLog->employee->time_in}}
                                    <div class="small text-gray-500">Expected to login: {{\Carbon\Carbon::createFromFormat('H:i:s',$timeLog->employee->time_in)->format('h:i A')}}</div>
                                    <span class="">{{"{$timeLog->employee->firstname} {$timeLog->employee->lastname} {$timeLog->employee->suffix}"}} 
                                        logged in at {{\Carbon\Carbon::createFromFormat('H:i:s',$timeLog->time_in)->format('h:i A')}}
                                    </span>
                                </div>
                            </a>
                            @endforeach
                        @else
                        <div class="text-center  text-info mt-4 mb-4">
                            <h1><i class="far fa-smile-wink"></i></h1>
                            <p class='text-center text-info mt-4 mb-4'>No employee is on duty as of this moment.</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

        <!-- lates -->
            <div class="col-md-6">
                <div class="card o-hidden shadow-lg my-3 border border-secondary">
                    <div class="card-header bg-white">
                        <div class="d-flex justify-content-between">
                            <span class="text-gray">Late Employees</span>
                            <span>(Today) {{\Carbon\Carbon::createFromFormat('Y-m-d',$dateToday)->format('M d,Y')}}</span>
                        </div>
                    </div>
                    <div class="card-body pt-3 pb-0 pl-3 pr-3">
                        @if($lateToday->count()>0)
                            @foreach($lateToday as $lates)
                            <a class="dropdown-item d-flex align-items-center mb-2" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-warning">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">{{\Carbon\Carbon::createFromFormat('Y-m-d',$lates->log_date)->format('F d, giY')}}</div>
                                    <span class="">{{$lates->employee->firstname . ' '.$lates->employee->lastname}} - Late for {{$lates->mins_late}} {{Str::plural('minute',$lates->mins_late)}}.</span>
                                </div>
                            </a>
                            @endforeach
                        @else
                        <div class="text-center  text-success mt-4 mb-4">
                            <h1><i class="far fa-smile-beam"></i></h1>
                            <p>Great! No lates today</p>
                        </div>
                        @endif
                        <a href="{{ route('employee.lates') }}" class="text-center text-muted"><p class="text-muted">See All Lates</p></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card o-hidden shadow-lg my-3 border border-secondary">
                    <div class="card-header bg-white">
                        <span class="text-gray">Lists of Employees</span>
                    </div>
                    <div class="card-body pt-3 pb-3 pl-3 pr-3">
                        @if($employees->count()>0)
                            @foreach($employees as $employee)
                            <a class="dropdown-item d-flex align-items-center mb-2" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-success">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">Name: {{ $employee->firstname .' '.$employee->middlename.' ' .$employee->lastname . ' '.$employee->suffix }}</div>
                                    <span class="">Schedule: {{ \Carbon\Carbon::createFromFormat('H:i:s',$employee->time_in)->format('h:i A') .'-'.\Carbon\Carbon::createFromFormat('H:i:s',$employee->time_out)->format('h:i A') }}
                                    </span>
                                </div>
                            </a>
                            @endforeach
                        @else
                        <div class="text-center  text-warning mt-4 mb-4">
                            <h1><i class="far fa-grin-hearts"></i></h1>
                            <p class='text-center text-warning mt-4 mb-4'>No employee on the lists yet.</p>
                        </div>
                        @endif
                        <a href="{{ route('view_employees') }}" class="text-center text-muted"><p class="text-muted">See All Employees' Lists</p></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection