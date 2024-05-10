@extends('admin.Master')
@section('title')
    Panel
@endsection
@section('content')
    <div class="page-body">
        @if ($user_session->is_super_admin == 1)
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <div class="page-header-left">
                                <h3>ACELERA</h3>
                                <ol class="breadcrumb">

                                    <li class="breadcrumb-item active">Panel</li>

                                </ol>
                            </div>
                        </div>

                        <div class="col">
                            <div class="bookmark pull-right">

                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-7 xl-100">
                        <div class="row">

                                <div class="col-sm-3">
                                    <div class="card">
                                        <div class="card-body ecommerce-icons text-center"><i
                                                data-feather="dollar-sign"></i>
                                            <div><span>Fondo total recaudado</span></div>
                                            <h4 class="font-primary mb-0 counter">
                                                @if (!empty($total_earning))
                                                    {{ $total_earning }}
                                                @endif
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card">
                                        <div class="card-body ecommerce-icons text-center"><i data-feather="tv"></i>
                                            <div><span>Total Blogs </span></div>
                                            <h4 class="font-primary mb-0 counter">
                                                @if (!empty($top_ad))
                                                    {{ $top_ad->count() }}
                                                @endif
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card">
                                        <div class="card-body ecommerce-icons text-center"><i data-feather="tv"></i>
                                            <div><span>Proyectos totales</span></div>
                                            <h4 class="font-primary mb-0 counter">
                                                @if (!empty($ads))
                                                    {{ $ads->count() }}
                                                @endif
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card">
                                        <div class="card-body ecommerce-icons text-center"><i data-feather="users"></i>
                                            <div><span>Total de Usuarios</span></div>
                                            <h4 class="font-primary mb-0 counter">
                                                @if (!empty($total_users))
                                                    {{ $total_users->count() }}
                                                @endif
                                            </h4>
                                        </div>
                                    </div>
                                </div>



                        </div>
                    </div>
                    <div class="col-xl-12 xl-100">
                        <div class="card">
                            <div class="card-header">
                                <h5>NUEVOS USUARIOS</h5>
                                <div class="card-header-right">
                                    <ul class="list-unstyled card-option">
                                        <li><i class="icofont icofont-simple-left"></i></li>
                                        <li><i class="view-html fa fa-code"></i></li>
                                        <li><i class="icofont icofont-maximize full-card"></i></li>
                                        <li><i class="icofont icofont-minus minimize-card"></i></li>
                                        <li><i class="icofont icofont-refresh reload-card"></i></li>
                                        <li><i class="icofont icofont-error close-card"></i></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive sellers">
                                    <table class="table table-bordernone">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Correo electrónico</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($usersData as $row)
                                                @if ($row->account_type != 'admin')
                                                    <tr>
                                                        <td>
                                                            <div class="d-inline-block align-middle">


                                                                <div class="d-inline-block">
                                                                    <p>{{ $row->name }}</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <p>{{ $row->email }}</p>
                                                        </td>

                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="code-box-copy">
                                    <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#example-head1"
                                        title="Copy"><i class="icofont icofont-copy-alt"></i></button>

                                </div>
                            </div>
                        </div>
                    </div>




                        </div>
                      </div>



                </div>
            </div>
        @endif

    </div>

@endsection
