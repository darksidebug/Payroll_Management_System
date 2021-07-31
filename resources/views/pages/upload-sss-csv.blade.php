@extends('layout.main-layout')

@section('upload_csv_content')

    <div class="container mt-0">
        <div class="row">
            <div class="col-md-12">
                <div class="card o-hidden border-0 shadow-lg my-3">
                    <div class="card-body pt-4 pb-4 pl-3 pr-3">
                        <div class="row">
                            <div class="col-md-12 trial">
                          
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                @if(session('success'))
                                <div class="alert alert-success">
                                    {{session('success')}}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" action="{{route('upload')}}" class="user mt-0" enctype="multipart/form-data">
                                    @csrf
                                    <input id="sss-excel" name="sss-excel" type="file" class="file" data-browse-on-zone-click="true">
                                </form>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="table-responsive pb-3 pt-1">
                                    <table class="table table-bordered" style="min-width: 1500px;">
                                        <thead>
                                            <tr>
                                                <td class="pt-3 pb-4 text-center border-bottom-0" rowspan="4"> <br>Range of <br>Compensation</td>
                                                <td class="pt-1 pb-1 text-center border-bottom-0" colspan="3" >Monthly Salary Credit</td>
                                                <td class="pt-1 pb-1 text-center border-bottom-0" colspan="12">Amount of Contributions</td>
                                            </tr>
                                            <tr>
                                                <td class="pt-1 pb-1 text-center border-bottom-0" rowspan="3">Regular Social <br>Security/<br>Employees' <br>Compensation</td>
                                                <td class="pt-1 pb-1 text-center border-bottom-0" rowspan="3">Mandatory <br>Provident <br>Fund</td>
                                                <td class="pt-3 pb-1 text-center border-bottom-0" rowspan="3"><br>Total</td>
                                            </tr>
                                            <tr>
                                                <td class="pt-2 pb-1 text-center border-bottom-0" colspan="3">Regular Social Security</td>
                                                <td class="pt-2 pb-1 text-center border-bottom-0" colspan="3">Employees' Compensation</td>
                                                <td class="pt-2 pb-1 text-center border-bottom-0" colspan="3">Mandatory Provident Fund</td>
                                                <td class="pt-2 pb-1 text-center border-bottom-0" colspan="3">Total</td>
                                            </tr>
                                            <tr>
                                                <td class="pt-3 pb-1 text-center border-bottom-0">ER</td>
                                                <td class="pt-3 pb-1 text-center border-bottom-0">EE</td>
                                                <td class="pt-3 pb-1 text-center border-bottom-0">Total</td>
                                                <td class="pt-3 pb-1 text-center border-bottom-0">ER</td>
                                                <td class="pt-3 pb-1 text-center border-bottom-0">EE</td>
                                                <td class="pt-3 pb-1 text-center border-bottom-0">Total</td>
                                                <td class="pt-3 pb-1 text-center border-bottom-0">ER</td>
                                                <td class="pt-3 pb-1 text-center border-bottom-0">EE</td>
                                                <td class="pt-3 pb-1 text-center border-bottom-0">Total</td>
                                                <td class="pt-3 pb-1 text-center border-bottom-0">ER</td>
                                                <td class="pt-3 pb-1 text-center border-bottom-0">EE</td>
                                                <td class="pt-3 pb-1 text-center border-bottom-0">Total</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="pt-1 pb-1 text-center">0.00 - 0.00</td>
                                                <td class="pt-1 pb-1 text-center">0.00</td>
                                                <td class="pt-1 pb-1 text-center">0.00</td>
                                                <td class="pt-1 pb-1 text-center">0.00</td>
                                                <td class="pt-1 pb-1 text-center">0.00</td>
                                                <td class="pt-1 pb-1 text-center">0.00</td>
                                                <td class="pt-1 pb-1 text-center">0.00</td>
                                                <td class="pt-1 pb-1 text-center">0.00</td>
                                                <td class="pt-1 pb-1 text-center">0.00</td>
                                                <td class="pt-1 pb-1 text-center">0.00</td>
                                                <td class="pt-1 pb-1 text-center">0.00</td>
                                                <td class="pt-1 pb-1 text-center">0.00</td>
                                                <td class="pt-1 pb-1 text-center">0.00</td>
                                                <td class="pt-1 pb-1 text-center">0.00</td>
                                                <td class="pt-1 pb-1 text-center">0.00</td>
                                                <td class="pt-1 pb-1 text-center">0.00</td>
                                            </tr>
                                        </tbody>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection