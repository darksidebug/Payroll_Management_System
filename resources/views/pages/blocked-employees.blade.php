@extends('layout.main-layout')

@section('register_emp_content')
    <div class="container-fluid mt-0">
        <div class="card o-hidden border-0 shadow-lg my-3">
            <div class="card-body pt-4 pb-4 pl-3 pr-3">
                <div class="row">
                    <div class="col-md-12">
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
                                        <td>Employee ID</td>
                                        <td>Name | Action</td>
                                     
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <td>Employee ID</td>
                                        <td>Name | Action</td>
                                      
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($statuses as $status)
                                        

                                    <tr>
                                        <td>{{$status->employee->id}}</td>
                                        <td>{{$status->employee->firstname . ' '.$status->employee->lastname.' '.$status->employee->suffix}} 
                                            <form action="{{ route('blocked-employees.unblock',$status->employee) }}" method="post">
                                                @csrf
                                                <button class="btn btn-link px-0" type="submit">Unblock</button>
                                            </form>
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