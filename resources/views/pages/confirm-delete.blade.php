@extends('layout.main-layout')

@section('delete_emp_content')
    <div class="container mt-0">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body pt-4 pb-4 pl-3 pr-3">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-left pl-3">
                                    <h1 class="h4 text-gray-900 mb-4">Confirm Deletion!</h1>
                                </div>
                                <form method="post" action="{{ route('delete_employee', ['employee'=>$employee->id]) }}" class="user mt-3 p-5">
                                    @csrf    
                                    <h3 class="text-center text-warning"><i class="fa fa-info-circle fa-2x"></i></h3>
                                    <h2 class="text-center text-warning pt-3">WARNING!</h2>
                                    <h6 class="pt-3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Are you sure you want to delete this record? This cannot be undone!</h6>
                                    <div class="mt-5" align="right">
                                        <button type="submit" class="btn btn-primary mt-4 btn-user">Yes, Delete it!</button>
                                        <a href="{{ route('view_employees') }}" class="btn btn-secondary mt-4 btn-user">No, Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection