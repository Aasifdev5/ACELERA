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
    @if(Session::has('success'))
    <div class="alert alert-success" style="background-color: green;">
        <p style="color: #fff;">{{session::get('success')}}</p>
    </div>
    @endif
    @if(Session::has('fail'))
    <div class="alert alert-danger" style="background-color: red;">
        <p style="color: #fff;">{{session::get('fail')}}</p>
    </div>
    @endif
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-2 d-none d-md-block  sidebar" style="background-color: #2a0054;">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ url('dashboard') }}">
                            <i class="icofont icofont-finger-print"></i> {{ __('Panel de Control') }}
                        </a>
                    </li>
                    <li><a href="{{route('chat.index')}}" class="nav-link" ><i class="icofont icofont-social-google-buzz"></i> {{__('Chat')}}</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('MyProject') }}">
                            <i class="fa fa-bullhorn"></i>  {{ __('Mis Proyectos') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('CreateProject') }}">
                            <i class="fa fa-plus-circle"></i> {{ __('Iniciar un Proyecto') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('MyPendingProject') }}">
                            <i class="fa fa-clock-o"></i> {{ __('Proyectos Pendientes') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('MyActiveProject') }}">
                            <i class="fa fa-clock-o"></i>{{ __('Proyectos Activos') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('dashboard/payments') }}">
                            <i class="fa fa-money"></i>{{ __('Pagos') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('dashboard/withdraw') }}">
                            <i class="fa fa-credit-card"></i>{{ __('Retiro') }}
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
