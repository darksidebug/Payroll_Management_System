@extends('layout.main-layout')

@section('register_user_content')
    <div class="container mt-0">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card o-hidden border-0 shadow-lg my-3">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-md-8 offset-md-2">
                                <div class="pt-5 pb-5 pl-3 pr-3 pl-md-4 pr-md-4 pl-sm-5 pr-sm-5">
                                    <div class="text-center pb-3">
                                        <h1 class="h4 text-gray-900 mb-4">Register new User!</h1>
                                    </div>

                                    @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Great!</strong> {{session('success')}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>                                
                                    </div>
                                    @endif
                                    <form method="POST" action="{{route('add_user')}}" class="user mt-3">
                                        @csrf
                                        <div class="form-group row mb-5">
                                            <div class="col-sm-12 mb-2 px-md-1 px-sm-1 px-xs-4">
                                                <span class="ml-3">Username</span>
                                            <input type="text" name='username' class="form-control form-control-user" id="exampleInputUser" value="{{old('username')}}" placeholder="Username">
                                            @error('username')
                                            <p class="text-danger ml-3"><small>{{$message}}</small></p>
                                            @enderror
                                            </div>
                                            <div class="col-sm-12 mb-2 px-md-1 px-sm-1 px-xs-4">
                                                <span class="ml-3">Password (atleast 4 characters)</span>
                                                <input type="password" name='password' class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                                @error('password')
                                                <p class="text-danger ml-3"><small>{{$message}}</small></p>
                                                @enderror
                                            </div>
                                            <div class="col-sm-12 px-md-1 px-sm-1 px-xs-4">
                                                <span class="ml-3">Confirm Password (atleast 4 characters)</span>
                                                <input type="password" name='password_confirmation' class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Confirm Password">
                                            </div>
                                        </div>
                                        <div class="form-group row mt-4 mb-5">
                                            <div class="col-md-6 offset-md-3 col-sm-6 mb-3 mb-sm-0">
                                                <center>
                                                    <button type="submit" class="btn btn-primary btn-user btn-block">Register User</button>
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
        </div>
    </div>
@endsection