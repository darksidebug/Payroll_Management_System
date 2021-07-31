@extends('layout.main-layout')

@section('benifits_content')
    <div class="container mt-0">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card o-hidden border-0 shadow-lg my-4">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-md-8 offset-md-2">
                                <div class="pt-5 pb-5 pl-3 pr-3 pl-md-4 pr-md-4 pl-sm-5 pr-sm-5">
                                    <div class="text-center pb-3">
                                        <h1 class="h4 text-gray-900 mb-4">Set Benefits!</h1>
                                    </div>
                                    @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Great!</strong> {{session('success')}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>                                
                                    </div>
                                    @endif
                                    @if(session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Great!</strong> {{session('error')}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>                                
                                    </div>
                                    @endif
                                    <form class="user mt-3" method="post" action="{{ route('benefits') }}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $id }}">
                                        <div class="form-group row mb-5">
                                            {{-- <div class="col-sm-12 mb-2 px-md-1 px-sm-1 px-xs-4">
                                                <span class="ml-3">SSS (%)</span>
                                                <input type="number" name="sss" class="form-control form-control-user pl-4" id="exampleInputSSS" placeholder="0.00" value="{{ number_format($sss, 2, '.', '') }}">
                                            </div>
                                            @error('sss')
                                            <p class="text-danger ml-3"><small>{{$message}}</small></p>
                                            @enderror --}}
                                            <div class="col-sm-12 mb-2 px-md-1 px-sm-1 px-xs-4">
                                                <span class="ml-3">Philhealth (Employee counter part only) (%) </span>
                                                <input type="text" name="philhealth" class="form-control form-control-user pl-4" id="exampleInputPhilHealth" placeholder="0.00" value="{{ number_format($philhealth, 2, '.', '') }}">
                                            </div>
                                            @error('philhealth')
                                            <p class="text-danger ml-3"><small>{{$message}}</small></p>
                                            @enderror
                                      
                                            <div class="col-sm-12 mb-2 px-md-1 px-sm-1 px-xs-4">
                                                <span class="ml-3">Pag-ibig </span>
                                                <input type="number" name="pag_ibig" class="form-control form-control-user pl-4" id="exampleInputPagibig" placeholder="0.00" value="{{ number_format($pag_ibig, 2, '.', '') }}">
                                            </div>
                                            @error('pag_ibig')
                                            <p class="text-danger ml-3"><small>{{$message}}</small></p>
                                            @enderror
                                        </div>
                                        <div class="form-group row mt-4 mb-5">
                                            <div class="col-md-6 offset-md-3 col-sm-6 mb-3 mb-sm-0">
                                                <center>
                                                    <button type="submit" class="btn btn-primary btn-user btn-block">Save and Set Benefits</button>
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