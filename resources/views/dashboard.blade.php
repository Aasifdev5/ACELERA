@extends('master')
@section('title')
 {{ __('Dashboard') }}
@endsection
@section('content')
<style>

    .nav-link{
        color: #FE7F4C;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-2 d-none d-md-block  sidebar" style="background-color: #2a0054;">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ url('dashboard') }}">
                            <i class="icofont icofont-finger-print"></i> {{ __('Dashboard') }}
                        </a>
                    </li>
                    <li><a href="{{route('chat.index')}}" class="nav-link" ><i class="icofont icofont-social-google-buzz"></i> {{__('Chat')}}</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('MyProject') }}">
                            <i class="fa fa-bullhorn"></i>  {{ __('My Projects') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('CreateProject') }}">
                            <i class="fa fa-plus-circle"></i> {{ __('Start a Project') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('MyPendingProject') }}">
                            <i class="fa fa-clock-o"></i> {{ __('Pending Projects') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('MyActiveProject') }}">
                            <i class="fa fa-clock-o"></i>{{ __('Active Projects') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('dashboard/payments') }}">
                            <i class="fa fa-money"></i>{{ __('Payments') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('dashboard/withdraw') }}">
                            <i class="fa fa-credit-card"></i>{{ __('Withdraw') }}
                        </a>
                    </li>


                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            @yield('content')
        </main>
    </div>
</div>

<br>
@endsection
