@extends('master')
@section('title')
    {{ __('Registrarse') }}
@endsection
@section('content')


    <section class="login-register">
        <div class="container">

            <div class="row">

                <div class="col-lg-12">
                    <h3 class="login-register__title">{{ __('Registrarse') }}</h3><!-- /.login-register__title -->
                    <form class="login-register__form" action="{{ url('reg') }}" method="post">
                        @if (Session::has('success'))
                            <div class="alert alert-success" style="background-color: green;">
                                <p style="color: #fff;">{{ session::get('success') }}</p>
                            </div>
                        @endif
                        @if (Session::has('fail'))
                            <div class="alert alert-danger" style="background-color: red;">
                                <p style="color: #fff;">{{ session::get('fail') }}</p>
                            </div>
                        @endif
                        @csrf
                        <div class="contact-form__input-box">
                            <label class=""><i class="fa fa-asterisk"></i>{{ __('Nombre') }}</label>
                            <input name="name" type="text" value="{{ old('name') }}" class="form-control">
                            <span class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div><!-- /.contact-form__input-box -->
                        <div class="contact-form__input-box">
                            <label class="">{{ __('Correo Electrónico') }}</label>
                            <input name="email" type="email" placeholder="Correo Electrónico" autocomplete="off"
                                value="{{ old('email') }}" class="form-control">
                            <span class="text-danger">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="contact-form__input-box">
                            <label class="control-label">{{ __('Contraseña') }}</label>
                            <input name="password" type="password" placeholder="Contraseña" value="{{ old('password') }}"
                                autocomplete="new-password" class="form-control" id="password-input">

                            <span class="text-danger" style="color:red;">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="contact-form__input-box">
                            <label class="">{{ __('Número de Teléfono Móvil') }}</label>
                            <input name="mobile_number" type="text" placeholder="Número de Teléfono Móvil" autocomplete="off"
                                value="{{ old('mobile_number') }}" class="form-control">
                            <span class="text-danger">
                                @error('mobile_number')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="contact-form__input-box">
                            <label class="">{{ __('Tipo de Cuenta') }}</label>
                            <select name="account_type" id="" class="form-control">
                                <option value="">{{ __('Por favor seleccione') }}</option>
                                <option value="creators">{{ __('Creadores') }}</option>

                                <option value="backers">{{ __('Patrocinadores') }}</option>

                            </select>
                            <span class="text-danger">
                                @error('account_type')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="login-register__info">
                            <button type="submit" class="thm-btn login-register__btn">{{ __('Registrarse') }}</button>

                        </div><!-- /.login-register__info -->

                    </form>
                    <div class="login-register__info">
                        <a href="{{ url('Userlogin') }}" class="thm-btn login-register__btn pull-right">{{ __('Iniciar sesión') }}</a>
                        <!-- Register link -->
                    </div><!-- /.login-register__info -->
                </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.login-register -->
@endsection
