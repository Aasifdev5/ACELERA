@extends('master')
@section('title')
    SignUp
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
                    <li>Register</li>
                </ul>
                <h2>Register</h2>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <section class="login-register">
        <div class="container">

            <div class="row">

                <div class="col-lg-12">
                    <h3 class="login-register__title">Register</h3><!-- /.login-register__title -->
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
                            <label class=""><i class="fa fa-asterisk"></i>Name</label>
                            <input name="name" type="text" value="{{ old('name') }}" class="form-control">
                            <span class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div><!-- /.contact-form__input-box -->
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
                        <div class="contact-form__input-box">
                            <label class="">Mobile Number</label>
                            <input name="mobile_number" type="text" placeholder="Mobile Number" autocomplete="off"
                                value="{{ old('mobile_number') }}" class="form-control">
                            <span class="text-danger">
                                @error('mobile_number')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="contact-form__input-box">
                            <label class="">Account Type</label>
                            <select name="account_type" id="" class="form-control">
                                <option value="">Please Select</option>
                                <option value="creators">creators</option>

                                <option value="backers">backers</option>

                            </select>
                            <span class="text-danger">
                                @error('account_type')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="login-register__info">
                            <button type="submit" class="thm-btn login-register__btn">Register</button>

                        </div><!-- /.login-register__info -->

                    </form>
                    <div class="login-register__info">
                        <a href="{{ url('Userlogin') }}" class="thm-btn login-register__btn pull-right">Login</a>
                        <!-- Register link -->
                    </div><!-- /.login-register__info -->
                </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.login-register -->
@endsection
