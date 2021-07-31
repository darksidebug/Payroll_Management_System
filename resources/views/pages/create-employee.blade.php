@extends('layout.main-layout')

@section('register_emp_content')
    <div class="container mt-0">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="pt-5 pb-5 pl-3 pr-3 pl-md-4 pr-md-4 pl-sm-5 pr-sm-5">
                            <div class="text-center pb-3">
                                <h1 class="h4 text-gray-900 mb-4">Register New Employee!</h1>
                            </div>

                            @if(session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Great!</strong> {{session('status')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                             
                            </div>
                            @endif
                        <form method="post" action="{{route('register_employee')}}"class="user mt-4">
                                @csrf
                                <h5 class='text-info'>Basic Information</h5>
                                <hr>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 col-sm-6 mb-1 px-md-1 px-sm-1 px-xs-4">
                                        <input type="text" value="{{old('firstname')}}" name='firstname' class="form-control form-control-user" id="exampleFirstName" placeholder="First Name (required)">
                                        @error('firstname')
                                            <small class="text-danger ml-3"> {{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-sm-6 mb-3 px-md-1 px-sm-1 px-xs-4">
                                        <input type="text" value="{{old('middlename')}}" name='middlename' class="form-control form-control-user" id="exampleMiddleName" placeholder="Middle Name (optional)">
                                    </div>
                                    <div class="col-md-6 col-sm-6 mb-1 px-md-1 px-sm-1 px-xs-4">
                                        <input type="text" value="{{old('lastname')}}" name='lastname' class="form-control form-control-user" id="exampleLastName" placeholder="Last Name (required)">
                                        @error('lastname')
                                        <small class="text-danger ml-3"> {{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-sm-6 mb-3 px-md-1 px-sm-1 px-xs-4">
                                        <input type="text" value="{{old('suffix')}}" name='suffix' class="form-control form-control-user" id="exampleSuffix" placeholder="Suffix (optional)">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6 col-sm-6 mb-1 px-md-1 px-sm-1 px-xs-4">
                                        <input type="text" value="{{old('address')}}" name='address' class="form-control form-control-user" id="exampleInputEmail" placeholder="Complete Address (required)">
                                        @error('address')
                                        <small class="text-danger ml-3"> {{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-sm-6 mb-1 px-md-1 px-sm-1 px-xs-4">
                                        <input type="number" value="{{old('contact')}}" name='contact' class="form-control form-control-user" id="exampleContact" placeholder="11-digit contact number (required)" >
                                        @error('contact')
                                        <small class="text-danger ml-3"> {{$message}}</small>
                                        @enderror
                                    </div>
                                </div>

                                <h5 class="mt-4 text-info">Work Information</h5>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-md-6 col-sm-4 mb-1 px-md-1 px-sm-1 px-xs-4">
                                        <span class="ml-3">Set Time-in <span class="text-danger">*</span></span>
                                        <input type="time" value="{{old('time_in')}}" name='time_in' class="form-control form-control-user" id="exampleTimein" placeholder="Set Time-in">
                                        @error('time_in')
                                        <small class="text-danger ml-3"> {{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 col-sm-4 mb-1 px-md-1 px-sm-1 px-xs-4">
                                        <span class="ml-3">Set Time-out <span class="text-danger">*</span></span>
                                        <input type="time" value="{{old('time_out')}}" name='time_out' class="form-control form-control-user" id="exampleTimeout" placeholder="Set Time-out">
                                        @error('time_out')
                                        <small class="text-danger ml-3"> {{$message}}</small>
                                        @enderror
                                    </div>
                             
                                    <div class="col-sm-6 mb-1 px-md-1 px-sm-1 px-xs-4 mt-3">
                                        <span class="ml-3">Basic Salary <span class="text-danger">*</span></span>
                                        <input type="number" value="" name='basic_salary' class="form-control form-control-user" placeholder="XXXX.XX">
                                        @error('basic_salary')
                                        <small class="text-danger ml-3"> {{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class="col-sm-6 mb-1 px-md-1 px-sm-1 px-xs-4 mt-3">
                                        <span class="ml-3">Number of days expected to work <span class="text-danger">*</span></span>
                                        <input type="number" value="" name='expected_number_of_work_days' class="form-control form-control-user" placeholder="XX">
                                        @error('expected_number_of_work_days')
                                        <small class="text-danger ml-3"> {{$message}}</small>
                                        @enderror
                                    </div>

                                </div>

                                <h5 class="mt-4 text-info">Credentials</h5>
                                <hr>

                                <div class="form-group row mb-5">
                                    <div class="col-sm-6 mb-1 px-md-1 px-sm-1 px-xs-4">
                                        <span class="ml-3">Password <small>(atleast 4 characters)</small> <span class="text-danger">*</span></span>
                                        <input type="password" name='password' class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                        @error('password')
                                        <small class="text-danger ml-3"> {{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6 px-md-1 px-sm-1 px-xs-4">
                                        <span class="ml-3">Confirm Password <span class="text-danger">*</span></span>
                                        <input type="password" name='password_confirmation' class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Confirm Password">
                                        @error('password_confirmation')
                                        <small class="text-danger ml-3"> {{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mt-4 mb-5">
                                    <div class="col-md-6 offset-md-3 col-sm-6 mb-3 mb-sm-0">
                                        <center>
                                            <button type="submit" class="btn btn-primary btn-user btn-block">Register Employee</button>
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