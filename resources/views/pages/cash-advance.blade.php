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
                <div class="card-body pt-4 pb-2 pl-3 pr-3">
                    <h3>List of Cash Advances</h3>
                    <button type="submit" class="btn btn-danger mt-1 mb-2 pt-2 pb-2 rounded-sm" onClick="$('#confirm').attr('action', '{{ route('reset_all_cash_advance_details') }}')" data-toggle="modal" data-target="#confirmModal">
                    <i class="fa fa-recycle pr-1"></i> Reset all Cash Advances</button>
                    @error('invalid')
                    <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                        <strong>Error!</strong> {{$message}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>                                
                    </div>
                    @enderror
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                        <strong>Great!</strong> {{session('success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>                                
                    </div>
                    @endif
                    <div class="table-responsive pb-3 pt-1">
                        <table class="table table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <td>Employee ID</td>
                                    <td>Employee Name</td>
                                    <td>Cash Advance Amount</td>
                                    <td>Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($employees as $index=>$employee)
                                <tr>
                                    <td class="border-bottom pt-1 pb-1 text-primary">{{$id = $employee->id}}</td>
                                    <td class="border-bottom pt-1 pb-1 text-primary">{{$name = $employee->firstname .' '.$employee->middlename.' ' .$employee->lastname . ' '.$employee->suffix}}</td>
                                    <td class="border-bottom pt-1 pb-1 text-primary">{{$ca = toAccounting($employee->cash_advance->sum('cash_amount'))}}</td>
                                    <td class="border-bottom pt-1 pb-1">
                                        <div class="form-inline">
                                            <button class="btn btn-primary btn-sm" onClick="$('#empID').val('{{$id = $employee->id}}')" data-toggle="modal" data-target="#searchModal"><i class="fa fa-plus fa-sm pr-1"></i> Cash Advance</button>
                                            <a href="{{ route('cash_advance_details', $employee) }}" class="btn btn-success btn-sm ml-1 mr-1" ><i class="fa fa-search fa-sm pr-1"></i> View More</a>
                                            <button type="submit" class="btn btn-sm btn-danger mt-0" onClick="$('#confirm').attr('action', '{{ route('delete_all_cash_advance_details', $employee->id) }}')" data-toggle="modal" data-target="#confirmModal">
                                            <i class="fa fa-recycle fa-sm pr-1"></i> Reset</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Cash Advance</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i>&times</i>
                </button>
            </div>
            <div class="modal-body pl-4 pr-4 pb-4">
                <form action="{{ route('cash_advance') }}" method="post">
                    @csrf
                    <input type="hidden" name="empID" id="empID" value="">
                    <label>Cash Advance Amount</label>
                    <input type="number" name="cash_amount" class="form-control mb-2 mt-0" placeholder="0.00" required min=0>
                    <label>Date of Cash Advance</label>
                    <input type="date" name="date" class="form-control mt-0" placeholder="dd/mm/yyyy" required>
                    <button type="submit" class="btn btn-primary mt-4"><i class="fa fa-check pr-1"></i> Submit</button>
                </form>
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