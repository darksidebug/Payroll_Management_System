    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Cafe Romara <!-- <sup>2</sup> --></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"> </i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Settings
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item ">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-users"></i>
                <span>Employee</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Employee Actions:</h6>
                    <a class="collapse-item" href="{{ route('register_employee') }}">Add new Employee</a>
                    <a class="collapse-item" href="{{ route('view_employees') }}">View Employee Lists</a>
                    <a class="collapse-item" href="{{ route('blocked-employees') }}">Blocked Accounts</a>
                    <a class="collapse-item" href="{{ route('cash_advance') }}">Cash Advances</a>
                    <!-- <a class="collapse-item" href="#">Service Charges</a> -->
                </div>
            </div>
        </li>

        <!-- Nav Item - Setup Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Setup</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">System Setup:</h6>
                    <a class="collapse-item" href="{{ route('preference') }}">Preference</a>
                    <a class="collapse-item" href="{{ route('benefits') }}">Benefits</a>
                    <!-- <a class="collapse-item" href="{{ route('upload') }}">Upload Excel</a> -->
                    <a class="collapse-item" href="{{ url('/configure/sss/schedule') }}">Configure SSS</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Users Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="true" aria-controls="collapseUser">
                <i class="fas fa-fw fa-user"></i>
                <span>Accounts</span>
            </a>
            <div id="collapseUser" class="collapse" aria-labelledby="headingUser" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Accounts:</h6>
                    <a class="collapse-item" href="{{ url('/user/add-new-system-user') }}">Add New User</a>
                    <a class="collapse-item" href="{{ url('/user/view-lists-of-system-user') }}">Lists of Users</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Management
        </div>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('/view/employee/daily-time-record') }}">
                <i class="fas fa-fw fa-file-alt"> </i>
                <span>Daily Time Records</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/view/employee/payrolls') }}">
                <i class="fas fa-fw fa-file-excel"> </i>
                <span>Payroll</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/employees/pay-slips') }}">
                <i class="fas fa-fw fa-file-excel"> </i>
                <span>Pay Slip</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/employee/on-duty') }}">
                <i class="fas fa-fw fa-clock"> </i>
                <span>Logs (On Duty)</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/employee/lates') }}">
                <i class="fas fa-fw fa-clock"> </i>
                <span>Late Employees</span>
            </a>
        </li>

        <hr class="sidebar-divider">
        
        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
    <!-- End of Sidebar -->