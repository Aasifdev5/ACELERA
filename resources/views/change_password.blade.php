@extends('dashboard')
@section('title')
    {{ __('Cambiar Contraseña') }}
@endsection
@section('content')
    <div class="container" style="margin-bottom: 50px;">
        <div class="text-center"><img src="assets/images/endless-logo.png" alt=""></div>
        <div class="card mt-4 p-4">
            <h4 class="text-center">{{ __('Cambiar Contraseña') }}</h4>

            <form class="theme-form" action="update_password" method="post">
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
                @csrf
                <input type="hidden" name="user_id" value="{{ $user_session->id }}">
                <div class="row g-1">

                        <div class="mb-3">
                            <label class="col-form-label">{{ __('Nueva Contraseña') }}</label>
                            <input class="form-control" type="password" name="new_password"
                                value="{{ old('new_password') }}">
                            <span class="text-danger">
                                @error('new_password')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                </div>
                <div class="mb-3">
                    <label class="col-form-label">{{ __('Confirmar Contraseña') }}</label>
                    <input class="form-control" type="password" name="confirm_password"
                        value="{{ old('confirm_password') }}">
                    <span class="text-danger">
                        @error('confirm_password')
                            {{ $message }}
                        @enderror
                    </span>

                </div>


                <div class="row g-2">
                    <div class="col-sm-4">
                        <button class="btn btn-primary btn-block" type="submit">{{ __('Actualizar') }}</button>
                    </div>

                </div>

            </form>
        </div>
    </div>
    </div>
@endsection
