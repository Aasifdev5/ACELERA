@extends('master')
@section('title')
{{ __('Iniciar sesión') }}
@endsection
@section('content')


    <section class="login-register">
        <div class="container">

            <div class="row">

                <div class="col-lg-12">
                    <h3 class="login-register__title">{{ __('Iniciar sesión') }}</h3><!-- /.login-register__title -->
                    <form class="login-register__form" action="{{ url('log') }}" method="post">
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



                        <div class="login-register__info">
                            <button type="submit" class="thm-btn login-register__btn">{{ __('Iniciar sesión') }}</button>

                        </div><!-- /.login-register__info -->

                    </form>
                    <div class="login-register__info">
                        <a href="{{ url('signup') }}" class="thm-btn login-register__btn">{{ __('Registrarse') }}</a>
                        <!-- Register link -->
                    </div><!-- /.login-register__info -->
                </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.login-register -->
@endsection
