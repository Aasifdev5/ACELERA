@extends('master')
@section('title')
Apoyando
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Apoyando el proyecto</h5>

                    <!-- Cart items go here -->
                    <div class="cart-item">
                        <div class="cart-item-details">
                            <h6 class="cart-item-title">{{ $campaign->name }}</h6>
                            <!-- Display the percentage raised -->

                        </div>
                    </div>

                    <form action="{{ url('storeBack') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user_session->id }}">
                        <input type="hidden" name="campaign_id" value="{{ $campaign->id }}">
                        <div class="col-sm-12">
                            <label for="amount" class="form-label">Monto</label>
                            <input type="text" class="form-control" id="amount" name="amount" required>
                        </div>
                        <div class="col-sm-12">
                            <label for="payment_receipt" class="form-label">Recibo de Pago</label>
                            <input type="file" class="form-control" id="payment_receipt" name="payment_receipt"
                                accept="image/*" required>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Donar</h5>
                    @if (!empty($qrcode))

                    <img src="{{ asset('qrcode/' . $qrcode->qrcode_path) }}" >


                @endif
                    <!-- Dummy QR Code -->
                    <div class="mt-3">
                        <h6>Descargar y Escanear Código QR</h6>
                        @if (!empty($qrcode))
                            <a href="{{ asset('qrcode/' . $qrcode->qrcode_path) }}" class="btn btn-block btn-primary"
                                download="qr_code.png">
                                <i class="fa fa-download"></i>
                                <h4>Descargar Código QR</h4>
                            </a>
                        @endif
                    </div>

                    <!-- Checkout button -->
                </div>
            </div>
        </div>
    </div>
</div>
<br>
@endsection
