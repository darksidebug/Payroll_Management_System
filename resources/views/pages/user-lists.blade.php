@extends('layout.main-layout')

@section('user_lists_content')
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
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Great!</strong> {{session('success')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        @endif
                        <div class="table-responsive pb-3 pt-1">
                            <table class="table table-striped" id="dataTable" style="min-width: 1200px;">
                                <thead>
                                    <tr>
                                        <td>SLNo</td>
                                        <td>Username</td>
                                        <td>Date Registered</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <td>SLNo</td>
                                        <td>Username</td>
                                        <td>Date Registered</td>
                                        <td>Action</td>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($adminUsers as $adminUser)
                                    <tr>
                                        <td>{{$adminUser->id}}</td>
                                        <td>{{$adminUser->username}}</td>
                                        <td>{{\Carbon\Carbon::parse($adminUser->created_at)->format('M j, Y h:i:s A')}}</td>
                                        <td>
                                            <a href="{{route('reset_user_password',$adminUser)}}" class="text-success" data-toggle="tooltip" data-placement="bottom" title="Reset Password"><i class="fas fa-fw fa-key"></i></a>&nbsp; |  &nbsp;
                                            <a href="{{ route('update_user',$adminUser) }}" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fas fa-fw fa-edit"></i></a> | 
                                            <a href="{{ route('delete_user', $adminUser->id) }}" class="text-danger" data-toggle-tooltip="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-fw fa-trash-alt"></i></a>
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