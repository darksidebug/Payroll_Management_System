@extends('layout.main-layout')

@section('emp_dtr_content')

<link rel="stylesheet" type="text/css" href="https://printjs-4de6.kxcdn.com/print.min.css">
<div class="container-fluid mt-0">
    <div class="row">
        <div class="col-md-12">
            @if(isset($employee))
            <div class="card o-hidden border-0 shadow-lg my-3">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-md-12 mt-5 mb-1 pl-5 pr-5">
                            <h5 class='text-primary'><strong>Employee ({{$employee->id}}) : {{$employee->firstname . ' '.$employee->lastname.' '.$employee->suffix}}</strong></h5>
                            <hr>
                            <div class="col-md-12">
                                <h6>Select a range of date:</h6>
                                <form class="form-inline mr-auto w-100 navbar-search" action="{{route('dtr.filter',$employee)}}" method="post">
                                    @csrf
                                    <div class="input-group mr-1">
                                        <div class="row justify-content-between ml-0 mr-0 border rounded-sm">
                                            <span class="pt-2 pl-2">Date From:</span>
                                            <input type="date" name='from' value="{{isset($from)?$from:old('from')}}" class="form-control bg-light border-0 small ml-1 rounded-0 @error('from') is-invalid @enderror" placeholder="dd/mm/yyyy" aria-label="Search" aria-describedby="basic-addon2">
                                        </div>
                                        </div>
                        
                                        <div class="row justify-content-between ml-0 border rounded-sm">
                                            <span class="pt-2 pl-2">Date To:</span>
                                            <input type="date" name='to' value="{{isset($to)?$to:old('to')}}"  class="form-control bg-light border-0 small ml-1 rounded-0 @error('to') is-invalid @enderror" placeholder="dd/mm/yyyy" aria-label="Search" aria-describedby="basic-addon2">
                                        </div>

                                        <div class="ml-3">
                                            <button class="btn btn-primary rounded-sm pt-2 pb-2" type="submit">
                                            <i class="fas fa-search fa-sm"></i> View
                                            </button>
                                        </div>
                                    </div>
                                    @if(session('success') &&  session('timeLogs')->count()>0)
                                    <div class="mt-3 pl-2 pr-4">
                                        <button type="button" onclick="printJS({
                                            printable:'printDTRTable',
                                            type:'html',
                                            style:'.table-bordered td{border:1px solid gray;text-align:center}'
                                        })" class="btn btn-secondary mt-0 rounded-sm pt-2 pb-2 ml-1"><i class="fas fa-print pr-1"></i> Print DTR</button>
                                        <button type="submit" class="btn btn-success mt-0 rounded-sm pt-2 pb-2"><i class="fas fa-recycle pr-1"></i> Refresh DTR</button>
                                    </div>
                                    @endif
                                </form>
                            </div>

                            @if(session('success') &&  session('timeLogs')->count()>0)
                            {{-- TABLE --}}

                            <div class="col-md-12 pl-5 pr-5 mb-4">
                                <div class="row">
                                    <div class="col-md-12 pl-4 pr-4">
                                        <div class="table-responsive" id="printDTRTable">
                                            <table class="table table-bordered mt-1 mb-4" style="min-width: 1100px !important;">
                                                <thead>
                                                    <tr>
                                                        <td colspan="13" class="text-center border-bottom-0 pt-3 pb-3">
                                                            CAFE ROMARA DAILY TIME RECORD<br>
                                                            <small>{{session('fromFormatted')}} to {{session('toFormatted')}}</small>
                                                        </td>
                                                    </tr>
                                                    <tr rowspan="2">
                                                        <td colspan="13" class="border-bottom-0 text-center pt-1 pb-1">
                                                            <small>{{session('employee')->id}} - {{session('employee')->firstname. ' ' .session('employee')->lastname . ' '.session('employee')->suffix}} (Schedule : {{\Carbon\Carbon::createFromFormat('H:i:s',session('employee')->time_in)->format('h:i A')}} - {{\Carbon\Carbon::createFromFormat('H:i:s',session('employee')->time_out)->format('h:i A')}})</small>
                                                        </td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td rowspan="2" class="pt-1 pb-1 border-bottom-0 text-center"><small>Date</small></td>
                                                        <td rowspan="2" class="pt-1 pb-1 border-bottom-0 text-center"><small>Time In</small></td>

                                                        <td rowspan="2" class="pt-1 pb-1 border-bottom-0 text-center"><small>Time Out</small></td>
                                                        <td rowspan="2" class="pt-1 pb-1 border-bottom-0 text-center"><small>Mins. Late</small></td>
                                                        <td rowspan="2" class="pt-1 pb-1 border-bottom-0 text-center"><small>No. of Hrs.</small></td>
                                                        <td rowspan="2" class="pt-1 pb-1 border-bottom-0 text-center"><small>No. of OT</small></td>
                                                        <td rowspan="2" class="pt-1 pb-1 border-bottom-0 text-center"><small>Total Hrs.</small></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach(session('timeLogs') as $timelog)
                                                    <tr>
                                                        <td class="pt-0 pb-0 text-center"><small>{{$timelog->log_date}}</small></td>
                                                        <td class="pt-0 pb-0 text-center"><small>@if($timelog->time_in){{\Carbon\Carbon::createFromFormat('H:i:s',$timelog->time_in)->format('h:i A')}}@endif</small></td>
                                                        
                                                        <td class="pt-0 pb-0 text-center"><small>@if($timelog->time_out){{\Carbon\Carbon::createFromFormat('H:i:s',$timelog->time_out)->format('h:i A')}}@endif</small></td>
                                                        <td class="pt-0 pb-0 text-center"><small>{{$timelog->mins_late}}</small></td>
                                                        <td class="pt-0 pb-0 text-center"><small>{{$timelog->num_of_hours}}</small></td>
                                                        <td class="pt-0 pb-0 text-center"><small>{{$timelog->num_of_ot}}</small></td>
                                                        <td class="pt-0 pb-0 text-center"><small>{{$timelog->total_hours}}</small></td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        {{-- END TABLE --}}

                                        @else
                                        <div class="col-md-12 pl-5 pr-5 mb-5">
                                            <div class="row">
                                                <div class="col-md-12 pl-4 pr-4">
                                                    <div class="table-responsive" id="printDTRTable">
                                                        <table class="table table-bordered mt-2 mb-4" style="min-width: 1100px !important;">
                                                            <thead>
                                                                <tr>
                                                                    <td colspan="13" class="text-center border-bottom-0 pt-3 pb-3">
                                                                        CAFE ROMARA DAILY TIME RECORD<br>
                                                                        @if(session('fromFormatted') && session('toFormatted'))
                                                                        <small>{{session('fromFormatted')}} to {{session('toFormatted')}}</small>
                                                                        @else
                                                                        <small>From: _______ To: _______</small>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr rowspan="2">
                                                                    <td colspan="13" class="border-bottom-0 text-center pt-1 pb-1">
                                                                        <small class="">({{$employee->id}}) : {{$employee->firstname . ' '.$employee->lastname.' '.$employee->suffix}}</small>
                                                                    </td>
                                                                </tr>
                                                                
                                                                <tr>
                                                                    <td rowspan="2" class="pt-1 pb-1 border-bottom-0 text-center"><small>Date</small></td>
                                                                    <td rowspan="2" class="pt-1 pb-1 border-bottom-0 text-center"><small>Time In</small></td>

                                                                    <td rowspan="2" class="pt-1 pb-1 border-bottom-0 text-center"><small>Time Out</small></td>
                                                                    <td rowspan="2" class="pt-1 pb-1 border-bottom-0 text-center"><small>Mins. Late</small></td>
                                                                    <td rowspan="2" class="pt-1 pb-1 border-bottom-0 text-center"><small>No. of Hrs.</small></td>
                                                                    <td rowspan="2" class="pt-1 pb-1 border-bottom-0 text-center"><small>No. of OT</small></td>
                                                                    <td rowspan="2" class="pt-1 pb-1 border-bottom-0 text-center"><small>Total Hrs.</small></td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="pt-1 pb-1 text-center" colspan="7"><small>No time records to show (select date to view time records)</small></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            @if($route=='dtr')
            <div class="row mt-5 mb-5">
                <div class="col-md-12 mt-5 mb-5">
                    <div class='text-center mt-5' style="color:#C0C0C0">
                        <h1><i class="fas fa-search"></i></h1>
                        <p>Please search for an employee ID</p>
                    </div>
                </div>
            </div>
            </div>

            @else
            <div class="row mt-5">
                <div class="col-md-12 mt-5">
                    <div class='text-center mt-5'>
                        <h1><i class="fas fa-exclamation-triangle"></i></h1>
                        <p>Employee ID not found!</p>
                    </div>
                </div>
            </div>
            </div>
            @endif
        @endif
    </div>
</div>
    
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
@endsection