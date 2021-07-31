@extends('layout.main-layout')

@section('sss_config_content')


    <div class="container mt-0">
        <div class="row">
            <div class="col-md-12">
                <div class="card o-hidden border-0 shadow-lg my-4">
                    <div class="card-body p-0">
                        <form action="{{route('configure.sss.add-row')}}" method="get" class="user pt-4 pb-2">
                            <h5 class="pl-4 ml-2">Configure SSS Schedule</h5>
                            <div class="row">
                                <div class="col-md-6 pl-5 pr-5 pt-3">
                                    <div class="d-flex justify-content-between">
                                        <div class="form-group row mb-5">
                                            <!-- <div class="col-sm-12 mb-2"> -->
                                                <span class="ml-3">Add additional row(s)</span>
                                                <input type="number" name="currentRows" value="{{isset($additional_rows)?$additional_rows:'1'}}" hidden>
                                                <input type="number" name='row' class="form-control border border-secondary ml-3" id="exampleInputUser" value="{{old('numRow')}}" placeholder="0">
                                                @error('row')
                                                <p class="text-danger ml-3"><small>{{$message}}</small></p>
                                                @enderror
                                            <!-- </div> -->
                                        </div>
                                        <div class="form-group row mt-4 mb-5">
                                            <div class="col-md-6 offset-md-3 col-sm-6 mb-3 mb-sm-0">
                                                <button type="submit" class="btn btn-primary pl-3 pr-3" style="border-radius: 35px;">Go</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-md-12 pl-5 pr-5">
                           
                                <h4 class="text-center pb-3">SSS Contribution Schedule</h4>
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Error:</strong> Please check if the values are correct.
                                </div>
                                @endif

                                @if (session('success'))
                                <div class="alert alert-success">
                                    <strong>Great!:</strong>{{session('success')}}.
                                </div>
                                @endif

                                <form action="{{route('configure.sss')}}" method="post" class="user">
                                    @csrf
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <td class="text-center border-bottom-0 pt-1 pb-1" colspan="2">Salary Range</td>
                                                    <td class="text-center border-bottom-0 pt-3 pb-0" rowspan="2">Amount <br><small>(An amount employees has to pay)</small></td>
                                                </tr>
                                                <tr>
                                                    <td class="border-bottom-0 text-center pt-1 pb-1">Minimum Salary</td>
                                                    <td class="border-bottom-0 text-center pt-1 pb-1">Maximum Salary</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              
                                              
                                            
                                                @if($currentData->count()<=0)

                                                <tr>
                                                    <td class="pt-1 pb-1 pl-2 pl-2">
                                                        <input type="number"  name="minimum[]" value="{{old('minimum.0')?old('minimum.0'):0}}" class="border border-secondary outline-0 p-1 mt-1 mb-1" style="width: 100%; border-radius: 5px; outline: none;">
                                                    </td>
                                                    <td class="pt-1 pb-1 pl-2 pl-2">
                                                        <input type="number"  name="maximum[]" value="{{old('maximum.0')?old('maximum.0'):0}}" class="border border-secondary outline-0 p-1 mt-1 mb-1" style="width: 100%; border-radius: 5px; outline: none;">
                                                    </td>
                                                    <td class="pt-1 pb-1 pl-2 pl-2">
                                                        <input type="number"  name="amount[]" value="{{old('amount.0')?old('amount.0'):0}}" class="border border-secondary outline-0 p-1 mt-1 mb-1" style="width: 100%; border-radius: 5px; outline: none;">
                                                    </td>
                                                </tr>

                                                @endif
                                                @foreach($currentData as $data)
                                             
                                                <tr>
                                                    <td class="pt-1 pb-1 pl-2 pl-2"><input type="number" value="{{$data->min_salary}}" name="minimum[]" class="border border-secondary outline-0 p-1 mt-1 mb-1" style="width: 100%; border-radius: 5px; outline: none;"></td>
                                                    <td class="pt-1 pb-1 pl-2 pl-2"><input type="number" value="{{$data->max_salary}}" name="maximum[]" class="border border-secondary outline-0 p-1 mt-1 mb-1" style="width: 100%; border-radius: 5px; outline: none;"></td>
                                                    <td class="pt-1 pb-1 pl-2 pl-2"><input type="number" value="{{$data->employee_has_to_pay}}" name="amount[]" class="border border-secondary outline-0 p-1 mt-1 mb-1" style="width: 100%; border-radius: 5px; outline: none;"></td>
                                                </tr>
                                                @endforeach

                                                @if(isset($additional_rows))
                                                   
                                                   @for ($i = $currentData->count()<=0?1:$currentData->count(); $i < $additional_rows; $i++)

                                                    <tr>
                                                        <td class="pt-1 pb-1 pl-2 pl-2"><input type="number" step="0.01" value="{{old("minimum.$i")?old("minimum.$i"):0}}" name="minimum[]" class="border border-secondary outline-0 p-1 mt-1 mb-1" style="width: 100%; border-radius: 5px; outline: none;"></td>
                                                        <td class="pt-1 pb-1 pl-2 pl-2"><input type="number" step="0.01" value="{{old("maximum.$i")?old("maximum.$i"):0}}"  name="maximum[]" class="border border-secondary outline-0 p-1 mt-1 mb-1" style="width: 100%; border-radius: 5px; outline: none;"></td>
                                                        <td class="pt-1 pb-1 pl-2 pl-2"><input type="number" step="0.01" value="{{old("amount.$i")?old("amount.$i"):0}}"  name="amount[]" class="border border-secondary outline-0 p-1 mt-1 mb-1" style="width: 100%; border-radius: 5px; outline: none;"></td>
                                                    </tr>
                                                    @endfor
                                                @endif
                                           
                                               
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12 mb-4 ">
                                            <button type="submit" class="btn btn-primary btn-user " style="float:right">Save Configuration</button>
                                        </div>
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