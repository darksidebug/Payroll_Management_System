<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cafe Romara DTR and Payroll Management</title>
    
    <link rel="stylesheet" href="{{ asset('css/sb-admin-2.css') }}">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container mt-3">

        <!-- Outer Row -->
      

            <div class="col-md-6 offset-md-3">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
                            <div class="col-md-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    @error('username')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                      </div>
                                    @enderror

                                    @if(session('password-reset-success'))
                                    <div class="alert alert-success" role="alert">
                                        {{session('password-reset-success')}}
                                    </div>
                                    @endif

                                    <form method="post" action="{{route('login')}}" class="user mt-2">
                                        @csrf
                                        <div class="form-group">
                                            <span class="pl-3">Username</span>
                                            <input type="text" name='username' value="{{old('username')}}" class="form-control form-control-user"
                                                placeholder="Enter Username...">
                                        </div>
                                        <div class="form-group mb-5">
                                            <span class="pl-3">Password</span>
                                            <input type="password" name='password' class="form-control form-control-user"
                                                 placeholder="Enter Password">
                                        </div>
                                
                                        <center>
                                            <button type="submit" class="btn btn-google btn-user mb-4 pl-5 pr-5">
                                                <i class="fa fa-pencil-alt"></i>&nbsp; LOGIN
                                            </button>
                                        </center>

                                        <p class="text-center">Forget password? <a href="#">Reset here</a></p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

      

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.popper.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/js/sb-admin-2.min.js') }}"></script>

</body>
</html>