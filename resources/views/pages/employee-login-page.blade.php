<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cafe Romara DTR and Payroll Management</title>
    
    <link rel="stylesheet" href="{{ asset('css/sb-admin-2.css') }}">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/virtual-keybaord.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font/material-icon.css') }}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{asset('css/app.css')}}"> --}}
    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

</head>

<style>

    .keyboard{
        z-index: 2000 !important;
    }

    .keyboard .keyboard__keys input{
        display: none !important;
    }
    
    .input{
        height: 120px !important;
        border: 2px solid #fff!important;
        font-size: 4rem !important;
        outline: 0px !important;
        font-weight: bolder !important;
        padding-top: 14px !important;
    }

    input[type="password"]{
        height: 80px !important;
        font-size: 2rem !important;
    }

    .button, .enter, .backspace, .clear{
        height: 82px !important;
        width: 137px !important;
        margin-top: 10px !important;
        border-radius: 5px !important;
        border: 2px solid #fff !important;
        font-size: 2.3rem !important;
        font-weight: bold !important;
        color: #fff !important;
        padding-top: 5px !important;
    }

    .enter, .backspace{
        width: 287px !important;
        font-size: 1.6rem !important;
    }

    .enter{
        position: relative !important;
        top: -5px !important;
    }

    .clear{
        font-size: 1.6rem !important;
    }

    .finger-print{
        height: 200px !important;
        width: 170px !important;
        border: 2px solid #fff !important;
        border-radius: 5px !important;
        background-color: #fff !important;
    }

    .check-finger-print-success,
    .check-finger-print-invalid{
        height: 100px !important;
        width: 170px !important;
        border-radius: 5px !important;
        /* background-color: #fff !important; */
    }

    .check-finger-print-success{
        border: 1px solid #1cc88a !important;
    }

    .check-finger-print-invalid{
        border: 1px solid #e74a3b !important;
    }

    .check-finger-print-success h3:last-child,
    .check-finger-print-invalid h3:last-child{
        font-weight: normal !important;
    }

    .log-msg{
        border: 2px solid #fff !important;
        width: 360px !important;
        height: 580px !important;
        border-radius: 5px !important;
    }

    .wrapper{
        display: flex;
        justify-content: space-between;
        align-items: center;
        border: 2px solid rgba(0, 0, 0, 0.7) !important;
        border-radius: 5px !important;
    }

    .wrapper input:focus{
        border-color: none !important;
        box-shadow: none !important;
    }

    .btn-keyboard{
        box-shadow: none !important;
    }

    .use-info{
        height: 210px !important
    }

    .logs{
        overflow: hidden !important;
    }

    h4{
        font-size: 1.3rem !important;
        padding-bottom: 20px !important;
        padding-top: 10px !important
    }

    h3{
        font-size: 1.5rem !important;
        font-weight: bolder;
    }

    h1{
        font-size: 3rem !important;
        font-weight: 700;
    }

</style>

<body id="page-top" class="bg-secondary">

    <!-- Page Wrapper -->
    <div id="wrapper">
    
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="container-fluid bg-secondary">

            <!-- Main Content -->
            <div id="content">
                <div class="container mt-5 p-5">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12 pl-5 pr-5">
                                    <div id="inputField"class="input form-control bg-white text-secondary text-center border-success" placeholder="Employee ID"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 pl-5 pr-5">
                                    <button class="clear bg-danger text-white">CLEAR</button>
                                    <button class="backspace ml-2 bg-warning">BACKSPACE</button>
                                    <button class="button bg-primary">7</button>
                                    <button class="button ml-2 mr-2 bg-primary">8</button>
                                    <button class="button bg-primary">9</button>
                                    <button class="button bg-primary">4</button>
                                    <button class="button ml-2 mr-2 bg-primary">5</button>
                                    <button class="button bg-primary">6</button>
                                    <button class="button bg-primary">1</button>
                                    <button class="button ml-2 mr-2 bg-primary">2</button>
                                    <button class="button bg-primary">3</button>
                                    <button class="button bg-primary">0</button>
                                    @csrf
                                    <button class="ml-2 enter bg-success" data-confirm-url="{{route('employee_login.confirm')}}">ENTER</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 pl-0">
                            <div class="row justify-content-between">
                                <div>
                                    <div class="finger-print">
                                    </div>
                                    <div class="alert alert-success check-finger-print-success text-center mt-3 pt-2" style="display: none">
                                        <h3 class="text-success pt-1"><i class="fa fa-check"></i></h3>
                                        <h3>Confirmed!</h3>
                                    </div>
                                    <div class="alert alert-danger check-finger-print-invalid text-center mt-3 pt-2 pl-1 pr-1" style="display: none">
                                        <h3 class="text-danger pt-1"><i class="fa fa-times"></i></h3>
                                        <h3>Invalid!</h3>
                                    </div>
                                </div>
                                <div class="bg-white text-secondary log-msg pl-2 pr-2 pt-3 pb-3">
                                    <div class="use-info container-fluid">
                                        <!-- <marquee> -->
                                            <h4 class="text-center">Logged in using <br></h4>
                                            <h3>Biometric and ID Number<br></></h2>
                                            <h1 class="text-center"><strong>OR</strong><br></h1>
                                            <h3 class="text-center">ID Number and Password</h3>
                                        <!-- </marquee> -->
                                    </div>
                                    <hr>
                                    <div class="logs">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-secondary mt-3">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span class="text-white">&copy; 2020 - Daily Time Record and Payroll Management</span>
                        <p class="text-white pt-3">Developed By: Benigno E. Ambus Jr. and Arman Masangkay</p>
                    </div>
                </div>
            </footer>
        <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog pt-5 mt-5" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="exampleModalLabel">Enter your password</h5>
                    <button button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body p-5">
                    <form id="confirm-login-form" action="{{route('employee_login')}}">
                        @csrf
                    <div class="wrapper border-secondary justify-content-between">
                        <input name='password' type="password" class="form-control text-center border-0 outline-0" id="keyboard">
                    </div>
                    <input name='employee_id' id="employeeIdModal" type="text" hidden>
                    <center>
                        <button class="btn btn-primary btn-lg mt-3 mb-4">CONFIRM & CONTINUE</button>
                    </center>
                    </form>
                </div>
                <div class="modal-footer border-top-0 pl-0">
                    
                </div>
            </div>
        </div>
    </div>

  
    <!-- Bootstrap core JavaScript-->
  
    <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.popper.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

   
    <!-- Page level custom scripts -->
    <script src="{{ asset('js/js/demo/datatables-demo.js') }}"></script>
    <script src="{{ asset('js/virtual-keyboard.js') }}"></script>
    <script>
        $(document).ready(function () {

        

            $('[data-toggle="tooltip"]').tooltip()
            $('[data-toggle-tooltip="tooltip"]').tooltip()

            $("#confirm-login-form").submit((e)=>{
                e.preventDefault();
                let url=$('#confirm-login-form').attr('action');
                const data=$('#confirm-login-form').serialize();
              
                $.post(url,data,function(response){
                    console.log(response);
                    switch(response){
                        case 'failed':
                            $("#keyboard").val("");
                            Swal.fire('Warning','Invalid Password','warning');
                            break;
                        case 'success':
                            Swal.fire('Great!','Time logged successfully','success');
                            $('#confirm-login-form').trigger('reset');
                            $('#passwordModal').modal('hide');
                            break;
                        case 'not_allowed_to_time_out':
                            Swal.fire('Excessive late','Please report to the admin to have your account sorted out and LOG OUT again!','warning');
                            $('#confirm-login-form').trigger('reset');
                            $('#passwordModal').modal('hide');
                            break;
                        case 'end_of_sched':
                            Swal.fire('Work is done','Your work schedule for today is done.','warning');
                            $('#confirm-login-form').trigger('reset');
                            $('#passwordModal').modal('hide');
                            break;
                        default:
                            Swal.fire('Error','Some error occured trying to process the request. Please try again!','error');
                            break;
                    }
                })
            })

            // $("#passwordModal").on('shown.bs.modal',function(e){
            //     let inputVal=$(".input").text();
                
            //     $("#employeeIdModal").val('1001');
            // })

            $('.enter').on('click', function(){
              
                let inputtedinfo=$("#inputField").text();
                let confirmUrl=$(this).data('confirm-url');
                let token=$("input[name='_token']").val();
                let data={
                    '_token':token,
                    'input':inputtedinfo
                };


                $.post(confirmUrl,data,function(response){
                    console.log(response)
                    switch(response){
                        case 'confirmed':
                            let inputVal=$(".input").text();
                            $('#passwordModal').modal('show');
                            $("#employeeIdModal").val(inputVal);
                            break;
                        case 'unconfirmed':
                            Swal.fire('Warning',"We can't find this employee ID on our record.",'warning');
                            break;
                        default:
                            Swal.fire('Error',"An unknown error occured.",'error');
                            break;

                    }
                }).fail(()=>{
                    Swal.fire('Error',"Unable to connect to the server. Please check your internet connection!",'error');
                  
                })


            })




            $('.button').on('click', function(){
                let number = $(this).html();
                let input = $('.input').text()
                $('.input').text(input + '' + number)
            })

            $('.backspace').on('click', function(){
                let input = $('.input').text()
                let value = input.substr(0, (input.length - 1))
                $('.input').text(value)
            })

            $('.clear').on('click', function(){
                $('.input').text("")
            })

            Keyboard({
                lang: 'en',
                charsOnly: false,
                caps: false
            }).init();
            
        })
    </script>
</body>

</html>
