@extends('master')
@section('title')
Credits Buy Details
@endsection
@section('content')

<main>

    <hr class="my-2">


    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Compra de créditos</h5>

                        <!-- Cart items go here -->
                        <div class="cart-item">
                            <div class="cart-item-details">
                                <h6 class="cart-item-title">{{ $credit->name }}</h6>
                                <p class="cart-item-price">Bs{{ $credit->discounted_amount }}</p>
                            </div>
                        </div>

                        <div class="cart-total mt-4">
                            <h6>Total: Bs{{ $credit->discounted_amount }}</h6>
                        </div>
                        <form action="{{ route('credit_reloads.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{$user_session->id}}">
                            <input type="hidden" name="credit_id" value="{{$credit->id}}">
                            <div class="col-sm-12">
                                <label for="amount" class="form-label">Cantidad</label>
                                <input type="text" class="form-control" id="amount" name="amount" required>
                            </div>
                            <div class="col-sm-12">
                                <label for="payment_receipt" class="form-label">Recibo de pago</label>
                                <input type="file" class="form-control" id="payment_receipt" name="payment_receipt" accept="image/*" required>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary btn-block">Entregar</button>
                        </form>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Resumen del pedido</h5>

                        <!-- Order summary details go here -->
                        <p>Total parcial: Bs{{ $credit->discounted_amount }}</p>

                        <hr>
                        <h6>Total: Bs{{ $credit->discounted_amount }}</h6>


<!-- Dummy QR Code -->
<div class="mt-3">
    <h6>Descargar y escanear código QR</h6>
    @if(!empty($qrcode))
    <a href="{{ asset('qrcode/' . $qrcode->qrcode_path) }}" class="btn btn-block btn-primary" download="qr_code.png">
        <i class="fa fa-download"></i> <h4>Descargar Código QR</h4>
    </a>
    @endif
</div>


                        <!-- Checkout button -->


                    </div>
                </div>
            </div>

        </div>


    </div>

    <div class="container mt-5">
        <div class="card">

        </div>
    </div>
</main>
@endsection