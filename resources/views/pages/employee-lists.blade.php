@extends('layout.main-layout')

@section('register_emp_content')
    <div class="container-fluid mt-0">
        <div class="card o-hidden border-0 shadow-lg my-3">
            <div class="card-body pt-4 pb-4 pl-3 pr-3">
                <div class="row">
                    <div class="col-md-12">
                        @if(session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Great!</strong> {{session('status')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <div class="table-responsive pb-3 pt-1">
                            <table class="table table-striped" id="dataTable" style="min-width: 1200px;">
                                <thead>
                                    <tr>
                                        <td>Employee ID</td>
                                        <td>Name</td>
                                        <td>Address</td>
                                        <td>Contact</td>
                                        <td>Schedule</td>
                                        <td>Break time (mins)</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <td>Employee ID</td>
                                        <td>Name</td>
                                        <td>Address</td>
                                        <td>Contact</td>
                                        <td>Schedule</td>
                                        <td>Break time (mins)</td>
                                        <td>Action</td>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($employees as $employee)
                                        <tr>
                                            <td>{{$employee->id}}</td>
                                            <td>{{$employee->firstname .' '.$employee->middlename.' ' .$employee->lastname . ' '.$employee->suffix}}</th>
                                            <td>{{$employee->address}}</td>
                                            <td>{{$employee->contact_number}}</td>
                                            <td>{{\Carbon\Carbon::createFromFormat('H:i:s',$employee->time_in)->format('h:i A') .'-'.\Carbon\Carbon::createFromFormat('H:i:s',$employee->time_out)->format('h:i A')}}</td>
                                            <td>{{$employee->break_mins}}</td>
                                            <td>
                                                <a href="{{ route('reset_password', $employee->id) }}" class="text-success" data-toggle="tooltip" data-placement="bottom" title="Reset Password"><i class="fas fa-fw fa-key"></i></a>&nbsp; |  &nbsp;
                                                <a href="{{ route('update_employee',['employee'=>$employee]) }}" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fas fa-fw fa-edit"></i></a>&nbsp; | &nbsp;
                                                <a href="{{ route('delete_employee',['employee'=>$employee->id]) }}" class="text-danger delete-emp" data-toggle-tooltip="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-fw fa-trash-alt"></i></a>
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
@endsection