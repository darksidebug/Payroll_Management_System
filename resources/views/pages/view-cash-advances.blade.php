@extends('layout.main-layout')

@section('cash_advance_content')

@php

function toAccounting($num)
{
    return number_format($num, 2, '.', ',');
}

@endphp
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card o-hidden border-0 shadow-lg my-3">
                <div class="card-body pt-4 pb-2 pl-5 pr-5">
                    <h5>Cash Advances of: <span class="text-primary"><strong>{{ $employee->firstname .' '.$employee->middlename.' ' .$employee->lastname . ' '.$employee->suffix }}</strong></span></h5>
                    <div class="form-inline pt-2">
                        <a href="{{ route('cash_advance') }}" class="btn btn-primary mr-1 pt-2 pb-2 rounded-sm"><i class="fa fa-arrow-left pr-1"></i> Go Back</a>
                        <button type="submit" class="btn btn-danger mt-0 pt-2 pb-2 rounded-sm"  onClick="$('#confirm').attr('action', '{{ route('delete_all_cash_advance_details', $employee->id) }}')" data-toggle="modal" data-target="#confirmModal">
                        <i class="fa fa-recycle pr-1"></i> Reset Cash Advances</button>
                    </div>
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                        <strong>Great!</strong> {{session('success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>                                
                    </div>
                    @endif
                    <div class="table-responsive pb-3 pt-1 mt-2">
                        <table class="table table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <td class="text-center">Employee ID</td>
                                    <td class="text-center">Cash Advance Amount</td>
                                    <td class="text-center">Date of Cash Advance</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($employee->cash_advance as $emp_detail)
                                <tr>
                                    <td class="border-bottom pt-1 pb-1 text-primary text-center">{{$emp_detail->employee_id}}</td>
                                    <td class="border-bottom pt-1 pb-1 text-primary text-center">{{toAccounting($emp_detail->cash_amount)}}</td>
                                    <td class="border-bottom pt-1 pb-1 text-primary text-center">{{$emp_detail->date_of_ca}}</td>
                                    <td class="border-bottom pt-1 pb-1">
                                        <button type="submit" class="btn btn-sm btn-danger" onClick="$('#confirm').attr('action', '{{ route('delete_cash_advance_details', $emp_detail->id) }}')" data-toggle="modal" data-target="#confirmModal">
                                        <i class="fa fa-times fa-sm pr-1"></i> Remove</button>
                                    </td>
                                </tr>
                            
                            @empty
                            <tr>
                                <td class="border-bottom pt-1 pb-1 text-center" colspan="4">Employee has no cash advances</td>
                            </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-confirm fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Confirmation</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i>&times</i>
                </button>
            </div>
            <div class="modal-body pl-4 pr-4 pb-4">
                <form action="" method="post" id="confirm">
                    @csrf
                    <h4>Are you sure you to continue?</h4>

                    <button type="submit" class="btn btn-primary mt-4"><i class="fa fa-check pr-1"></i> Confirm</button>
                    <button type="submit" class="btn btn-secondary mt-4"><i class="fa fa-times pr-1"></i> Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection