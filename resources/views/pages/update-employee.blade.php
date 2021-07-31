@extends('layout.main-layout')

@section('update_emp_content')

    <div class="container mt-0">
        <div class="card o-hidden border-0 shadow-lg my-3">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="pt-5 pb-5 pl-3 pr-3 pl-md-4 pr-md-4 pl-sm-5 pr-sm-5">
                            <div class="text-center pb-3">
                            <h1 class="h4 text-gray-900 mb-4">Updating <span class="text-primary">{{$employee->firstname}}</span>'s information!</h1>
                            </div>

                            @if(session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Great!</strong> {{session('status')}}
                                <hr>
                                <a href="{{route('view_employees')}}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left fa-sm"></i> Back to employees list</a>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            <form method="post" action="{{route('update_employee',['employee'=>$employee])}}"class="user mt-5">
                                @csrf
                                <h5 class='text-info'>Basic Information</h5>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-md-6 col-sm-6 mb-1 px-md-1 px-sm-1 px-xs-4">
                                        <span class="ml-3">Firstname <span class="text-danger">*</span></span>
                                        <input type="text" value="{{$employee->firstname}}" name='firstname' class="form-control form-control-user" id="exampleFirstName" placeholder="First Name">
                                        @error('firstname')
                                            <small class="text-danger ml-3"> {{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-sm-6 mb-1 px-md-1 px-sm-1 px-xs-4">
                                        <span class="ml-3">Middlename</span>
                                        <input type="text" value="{{$employee->middlename}}" name='middlename' class="form-control form-control-user" id="exampleMiddleName" placeholder="Middle Name">
                                    </div>
                                    <div class="col-md-6 col-sm-6 mb-1 px-md-1 px-sm-1 px-xs-4">
                                        <span class="ml-3">Lastname <span class="text-danger">*</span></span>
                                        <input type="text" value="{{$employee->lastname}}" name='lastname' class="form-control form-control-user" id="exampleLastName" placeholder="Last Name">
                                        @error('lastname')
                                        <small class="text-danger ml-3"> {{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-sm-6 mb-1 px-md-1 px-sm-1 px-xs-4">
                                        <span class="ml-3">Suffix</span>
                                        <input type="text" value="{{$employee->suffix}}" name='suffix' class="form-control form-control-user" id="exampleSuffix" placeholder="Suffix">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6 col-sm-6 mb-1 px-md-1 px-sm-1 px-xs-4">
                                        <span class="ml-3">Complete Address <span class="text-danger">*</span></span>
                                        <input type="text" value="{{$employee->address}}" name='address' class="form-control form-control-user" id="exampleInputEmail" placeholder="Complete Address">
                                        @error('address')
                                        <small class="text-danger ml-3"> {{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-sm-6 mb-1 px-md-1 px-sm-1 px-xs-4">
                                        <span class="ml-3">Contact No. <small>(11 digit number)</small> <span class="text-danger">*</span></span>
                                        <input type="number" value="{{$employee->contact_number}}" name='contact' class="form-control form-control-user" id="exampleContact" placeholder="Contact number" >
                                        @error('contact')
                                        <small class="text-danger ml-3"> {{$message}}</small>
                                        @enderror
                                    </div>
                                </div>

                                <h5 class='text-info mt-4'>Work Information</h5>
                                <hr>
                                <div class="form-group row mb-3">
                                    <div class="col-md-4 col-sm-4 mb-1 px-md-1 px-sm-1 px-xs-4">
                                        <span class="ml-3">Set Time-in <span class="text-danger">*</span></span>
                                        <input type="time" value="{{Illuminate\Support\Str::limit($employee->time_in,5,'')}}" name='time_in' class="form-control form-control-user" id="exampleTimein" placeholder="Set Time-in">
                                        @error('time_in')
                                        <small class="text-danger ml-3"> {{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 col-sm-4 mb-1 px-md-1 px-sm-1 px-xs-4">
                                        <span class="ml-3">Set Time-out <span class="text-danger">*</span></span>
                                        <input type="time" value="{{Illuminate\Support\Str::limit($employee->time_out,5,'')}}" name='time_out' class="form-control form-control-user" id="exampleTimeout" placeholder="Set Time-out">
                                        @error('time_out')
                                        <small class="text-danger ml-3"> {{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 col-sm-4 mb-1 px-md-1 px-sm-1 px-xs-4">
                                        <span class="ml-3">Set BreakTime <span class="text-danger">*</span></span>
                                        <input type="number" value="{{$employee->break_mins}}" name='break_time' class="form-control form-control-user" id="exampleBreak" placeholder="Break Time">
                                        @error('break_time')
                                        <small class="text-danger ml-3"> {{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 mb-1 px-md-1 px-sm-1 px-xs-4 mt-3">
                                        <span class="ml-3">Basic Salary <span class="text-danger">*</span></span>
                                        <input type="number" value="{{$employee->salary->salary}}" name='basic_salary' class="form-control form-control-user" placeholder="XXXX.XX">
                                        @error('basic_salary')
                                        <small class="text-danger ml-3"> {{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 mb-1 px-md-1 px-sm-1 px-xs-4 mt-3">
                                        <span class="ml-3">Number of days expected to work <span class="text-danger">*</span></span>
                                        <input type="number" value="{{$employee->salary->num_of_work_days}}" name='expected_number_of_work_days' class="form-control form-control-user" placeholder="XX">
                                        @error('expected_number_of_work_days')
                                        <small class="text-danger ml-3"> {{$message}}</small>
                                        @enderror

                                        {{-- TODO: Update employee with the basic salary and number of expected days --}}


                                    </div>
                                </div>
                           
                                <div class="form-group row mt-5 mb-5">
                                    <div class="col-md-6 offset-md-3 col-sm-6 mb-3 mb-sm-0 mt-3">
                                        <center>
    
                                            <button type="submit" class="btn btn-primary btn-user btn-block">Update Information</button>
                                            <a href="{{route('view_employees')}}"class="btn btn-secondary btn-user btn-block">Cancel</a>
                                        </center>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection