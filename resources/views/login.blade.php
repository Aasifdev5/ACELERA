@extends('master')
@section('title')
    Login
@endsection
@section('content')
    <!--Page Header Start-->
    <section class="page-header">
        <div class="page-header-bg" style="background-image: url(assets/images/backgrounds/page-header-bg.jpg)">
        </div>
        <div class="page-header-shape-1 float-bob-x">
            <img src="assets/images/shapes/page-header-shape-1.png" alt="">
        </div>
        <div class="page-header-shape-2 float-bob-y">
            <img src="assets/images/shapes/page-header-shape-2.png" alt="">
        </div>
        <div class="page-header-shape-3 float-bob-x">
            <img src="assets/images/shapes/page-header-shape-3.png" alt="">
        </div>
        <div class="container">
            <div class="page-header__inner">
                <ul class="thm-breadcrumb list-unstyled">
                    <li><a href="/">Home</a></li>
                    <li><span>/</span></li>
                    <li>Login</li>
                </ul>
                <h2>Login</h2>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <section class="login-register">
        <div class="container">

            <div class="row">

                <div class="col-lg-12">
                    <h3 class="login-register__title">Login</h3><!-- /.login-register__title -->
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
                            <label class="">Email</label>
                            <input name="email" type="email" placeholder="Email" autocomplete="off"
                                value="{{ old('email') }}" class="form-control">
                            <span class="text-danger">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="contact-form__input-box">
                            <label class="control-label">Password</label>
                            <input name="password" type="password" placeholder="Password" value="{{ old('password') }}"
                                autocomplete="new-password" class="form-control" id="password-input">

                            <span class="text-danger" style="color:red;">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>



                        <div class="login-register__info">
                            <button type="submit" class="thm-btn login-register__btn">Login</button>

                        </div><!-- /.login-register__info -->

                    </form>
                    <div class="login-register__info">
                        <a href="{{ url('signup') }}" class="thm-btn login-register__btn">Register</a>
                        <!-- Register link -->
                    </div><!-- /.login-register__info -->
                </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.login-register -->
@endsection
