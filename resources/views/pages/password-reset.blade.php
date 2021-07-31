@extends('layout.main-layout')

@section('register_emp_content')
    <div class="container mt-0">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card o-hidden border-0 shadow-lg my-3">
                    <div class="card-body pt-4 pb-4 pl-3 pr-3">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center mt-4">
                                    <h1 class="h4 text-gray-900 mb-4">Password Reset!</h1>
                                </div>
                                <div class="pl-5 pr-5">
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
                                    @if(session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error!</strong> {{session('error')}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @endif
                                </div>
                                <form  method="POST" action="{{route('reset_password', $employee->id)}}" class="user mt-5 pl-5 pr-5 pb-5">
                                    @csrf
                                    <div class="form-group">
                                        <span class="pl-3">New Password</span>
                                        <input type="password" name="password" class="form-control form-control-user"
                                            id="exampleInputPass"
                                            placeholder="New Password">
                                        @error('password')
                                        <p class="text-danger ml-3"><small>{{$message}}</small></p>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-5">
                                        <span class="pl-3">Confirm New Password</span>
                                        <input type="password" name="cfm_password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Confirm New Password">
                                        @error('password_confirmation')
                                        <p class="text-danger ml-3"><small>{{$message}}</small></p>
                                        @enderror
                                    </div>
                                    <center>
                                        <button type="submit" class="btn btn-primary btn-user mb-4 pl-5 pr-5">
                                            <i class="fa fa-key"></i>&nbsp; Reset Password
                                        </button>
                                    </center>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection