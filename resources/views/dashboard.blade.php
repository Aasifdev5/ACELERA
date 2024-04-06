@extends('master')
@section('title')
Dashboard
@endsection
@section('content')
<style>

    .nav-link{
        color: #FE7F4C;
    }
</style>
<div class="container">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block  sidebar" style="background-color: #2a0054;">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ url('dashboard') }}">
                            <i class="fa fa-dashboard fa-fw"></i> Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('Projects') }}"> <i class="fa fa-bullhorn"></i> My Projects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('CreateProject') }}">Start a Project</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('PendingProject') }}">Pending Projects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://127.0.0.1:8000/dashboard/payments">
                            <i class="fa fa-money"></i> Payments
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://127.0.0.1:8000/dashboard/withdraw">
                            <i class="fa fa-credit-card"></i> Withdraw
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('edit_profile') }}">
                            <i class="fa fa-user"></i> Edit Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('change_password') }}">
                            <i class="fa fa-lock"></i> Change Password
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('logout') }}">
                            <i class="fa fa-lock"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            @yield('content')
        </main>
    </div>
</div>
<br>
@endsection
