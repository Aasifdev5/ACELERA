<!-- Sidebar -->
<nav class="col-md-2 d-none d-md-block  sidebar" style="background-color: #2a0054;">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="{{ url('dashboard') }}">
                    <i class="fa fa-dashboard fa-fw"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('Projects') }}">
                    <i class="fa fa-bullhorn"></i> My Projects
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('CreateProject') }}">
                    <i class="fa fa-plus-circle"></i> Start a Project
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('PendingProject') }}">
                    <i class="fa fa-clock-o"></i> Pending Projects
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('dashboard/payments') }}">
                    <i class="fa fa-money"></i> Payments
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('dashboard/withdraw') }}">
                    <i class="fa fa-credit-card"></i> Withdraw
                </a>
            </li>


        </ul>
    </div>
</nav>
