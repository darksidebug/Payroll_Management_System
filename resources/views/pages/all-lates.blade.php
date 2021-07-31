@extends('layout.main-layout')

@section('content')

<div class="container-fluid mt-0">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card o-hidden border-0 shadow-lg my-3">
                <div class="card-body pt-4 pb-4 pl-4 pr-4">
                    <div class="" aria-labelledby="alertsDropdown">
                        <h5>
                            List of all late employees   
                        </h5>
                        <small class='text-muted'>Sorted from the most recent to the oldest</small>
                        <hr>

                        @if($logs->count()>0)
                            @foreach($logs as $log)
                            <a class="dropdown-item d-flex align-items-center mb-2" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-warning">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">{{\Carbon\Carbon::createFromFormat('Y-m-d',$log->log_date)->format('F d, Y')}}</div>
                                    <span class=""><span class='text-info'>(EmpId-{{$log->employee->id}})</span> {{$log->employee->firstname . ' '.$log->employee->lastname}} - Late for {{$log->mins_late}} {{Str::plural('minute',$log->mins_late)}}.</span>
                                </div>
                            </a>
                        @endforeach
                        @else
                        <div class="text-center  text-success">
                            <h1><i class="far fa-smile-beam"></i></h1>
                            <p>Great! No lates today</p>
                        </div> 
                        @endif
                        <div class="mt-4" style="float:right">
                        {{$logs->links()}}
                        </div>
                        <a class="dropdown-item text-center small text-gray-500 mt-3" href="{{route('employee.lates-today')}}">Show lates today</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection