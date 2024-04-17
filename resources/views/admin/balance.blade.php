@extends('admin.Master')
@section('title')
Recibir Fondos
@endsection
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <div class="page-header-left">
                            <h3>ACELERA</h3>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item">Recibir Fondos </li>


                            </ol>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                <p>{{ session::get('success') }}</p>
                            </div>
                        @endif
                        @if (Session::has('fail'))
                            <div class="alert alert-danger">
                                <p>{{ session::get('fail') }}</p>
                            </div>
                        @endif
                        <div class="card-header">
                            <h5> Lista de Fondos Recibidos</h5>
                            {{-- <a class="btn btn-pill btn-primary btn-air-primary pull-right"
                                href="{{ url('admin/add_balance') }}" data-toggle="tooltip" title="" role="button"
                                data-bs-original-title="btn btn-primary">Agregar Balance
                            </a> --}}
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="advance-1">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Pagador/Patrocinador</th>
                                            <th>Proyecto</th>
                                            <th>Correo Electrónico del Patrocinador</th>
                                            <th>Monto</th>
                                            <th>Recibo</th>
                                            <th>Estado</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transaction as $creditReload)
                                            @php
                                                $creditsDetails = \App\Models\Campaign::find(
                                                    $creditReload->campaign_id,
                                                );
                                            @endphp

                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $creditReload->name }}</td>
                                                <td>
                                                    @if ($creditsDetails)
                                                        {{ $creditsDetails->title }}
                                                    @else
                                                        Campaign details not found
                                                    @endif
                                                </td>
                                                <td>{{ $creditReload->payer_email }}</td>
                                                <td>{{ $creditReload->amount }}</td>
                                                <td>
                                                    @if ($creditReload->payment_receipt)
                                                        <a href="{{ asset($creditReload->payment_receipt) }}"
                                                            target="_blank">
                                                            <img src="{{ asset($creditReload->payment_receipt) }}"
                                                                alt="Payment Receipt" style="max-width: 100px;">
                                                        </a>
                                                    @else
                                                        No receipt uploaded
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($creditReload->accepted)
                                                    Aceptado
                                                    @else
                                                    Pendiente
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (!$creditReload->accepted)
                                                        <a href="{{ route('accept', ['id' => $creditReload->id]) }}"
                                                            class="btn btn-sm btn-success">Aceptar</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- DOM / jQuery  Ends-->


            </div>
        </div>


        <!-- Container-fluid Ends-->
        <!-- Container-fluid Ends-->
    </div>
@endsection
