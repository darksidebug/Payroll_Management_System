<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cafe Romara DTR and Payroll Management</title>

    <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/sb-admin-2.css') }}">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/fileinput.css') }}">
 
    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

</head>

<style>
    @media print{
        .navbar-nav, .not-include{
            display: none !important;
        }

        .card{
            box-shadow: none !important;
        }
    }
</style>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
    
    <!-- side nav -->
    @include('templates.side-nav')

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- top nav -->
            @include('templates.top-nav')

            <!-- Begin Page Content -->
            <div class="container-fluid">

                @yield('content')

                <!-- dashboard -->
                @yield('dashboard_content')

                <!-- register employee -->
                @yield('register_emp_content')
                <!-- view lists of employee -->
                @yield('list_emp_content')
                <!-- update employee info -->
                @yield('update_emp_content')

                <!-- register user -->
                @yield('register_user_content')
                <!-- view lists of users -->
                @yield('user_lists_content')
                <!-- update user account -->
                @yield('user_update_content')

                <!-- setup preference -->
                @yield('preference_content')
                @yield('benifits_content')
                @yield('upload_csv_content')

                <!-- daily time record -->
                @yield('emp_dtr_content')
                <!-- payroll -->
                @yield('emp_payroll_content')
                <!-- late emp -->
                @yield('late_emp_content')

                @yield('delete_emp_content')

                <!-- sss config -->
                @yield('sss_config_content')

                @yield('payslip_content')

                @yield('cash_advance_content')
                
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>&copy; 2020 - Daily Time Record and Payroll Management</span>
                    <p class="text-mute pt-3">Developed By: Benigno E. Ambus Jr. and Arman Masangkay</p>
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
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button   button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{route('logout')}}">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->

    
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.popper.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/fileinput.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/js/demo/datatables-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip()
            $('[data-toggle-tooltip="tooltip"]').tooltip()
        })
    </script>
    
</body>

</html>
