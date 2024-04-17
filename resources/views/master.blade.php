<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @php
        $general_setting = getApplicationsettings();
        $category = getCategory();
        $adminNotifications = userNotifications();

    @endphp
    <title> {{ $general_setting->site_name }} || @yield('title') </title>
    <!-- favicons Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('site_favicon/') }}<?php echo '/' . $general_setting->site_favicon; ?>" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('site_favicon/') }}<?php echo '/' . $general_setting->site_favicon; ?>" />
    <link rel="manifest" href="{{ asset('assets/images/favicons/site.webmanifest') }}" />
    <meta name="description" content="{{ $general_setting->site_description }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">

    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&amp;display=swap"
        rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/animate/animate.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/animate/custom-animate.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/fontawesome/css/all.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/jarallax/jarallax.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/vendors/jquery-magnific-popup/jquery.magnific-popup.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/nouislider/nouislider.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/nouislider/nouislider.pips.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/odometer/odometer.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/swiper/swiper.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/qrowd-icons/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/tiny-slider/tiny-slider.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/reey-font/stylesheet.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/owl-carousel/owl.carousel.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/vendors/owl-carousel/owl.theme.default.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/bxslider/jquery.bxslider.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/vendors/bootstrap-select/css/bootstrap-select.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/vegas/vegas.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/jquery-ui/jquery-ui.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/timepicker/timePicker.css') }}" />

    <!-- template styles -->
    <link rel="stylesheet" href="{{ asset('admin/css/custom/image-preview.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/qrowd.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/qrowd-responsive.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/datatables.css') }}">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/fontawesome.css') }}">

    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/icofont.css') }}">
    <!-- Themify icon-->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/themify.css') }}"> --}}
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/flag-icon.css') }}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/feather-icon.css') }}">

    <style>


    </style>
</head>

<body class="custom-cursor">

    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>


    <div class="preloader" id="preloader"
        style="background-image: url('{{ asset('site_logo/' . $general_setting->site_logo) }}');">
        <div class="preloader__image"
            style="-webkit-animation-fill-mode: both; animation-fill-mode: both; -webkit-animation-name: flipInY; animation-name: flipInY; -webkit-animation-duration: 5s; animation-duration: 5s; -webkit-animation-iteration-count: infinite; animation-iteration-count: infinite; background-repeat: no-repeat; background-size: 30% 30%; background-position: center;  width:10%; height:15%;">
        </div>
    </div>



    <!-- /.preloader -->

    <div class="page-wrapper">
        <header class="main-header">
            <div class="main-header__top">
                <div class="main-header__top-inner">
                    <div class="main-header__top-left">
                        <ul class="list-unstyled main-header__contact-list">
                            {{-- <li>
                                <a href="#" class="btn btn-dropdown site-language" id="dropdownLanguage"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset(selectedLanguage(session()->get('local'))->flag) }}"
                                        width="40px" height="23px" alt="icon">
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownLanguage">
                                    @foreach (appLanguages() as $app_lang)
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ url('local/' . $app_lang->iso_code) }}">
                                                <img src="{{ asset($app_lang->flag) }}" width="40px" height="23px"
                                                    alt="icon">
                                                <span>{{ $app_lang->language }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li> --}}
                            <li>
                                <div class="icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="text">
                                    <p>{{ $general_setting->address }}</p>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="text">
                                    <p><a
                                            href="mailto:{{ $general_setting->site_email }}">{{ $general_setting->site_email }}</a>
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="main-header__top-right">
                        <div class="main-header__login">
                            <ul class="list-unstyled main-header__login-list">
                                @if (!empty($user_session))
                                    <li class="admin-notification-menu position-relative">
                                        <a href="#" class="btn btn-dropdown site-language position-relative"
                                            id="dropdownNotification" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <span
                                                style="position: absolute; top: 5px; left: 75%; transform: translate(-50%, -50%);"
                                                class="badge rounded-pill bg-danger">
                                                @php
                                                 $Notifications=   \App\Models\Notification::where('user_type', 2)
                                                        ->where('is_seen', 'no')
                                                        ->where('user_id', $user_session->id)
                                                        ->orderByDesc('created_at')
                                                        ->paginate(5);
                                                @endphp
                                                @if ($Notifications)
                                                    {{ count($Notifications) }}
                                                @else
                                                    0
                                                @endif
                                            </span>
                                            <!-- Fallback Icon -->
                                            <i class="fa fa-bell"></i>
                                        </a>


                                        <!-- Notification Dropdown Start -->
                                        <div class="dropdown-menu" aria-labelledby="dropdownNotification">
                                            <ul class="dropdown-list custom-scrollbar">
                                                @isset($adminNotifications)
                                                    @forelse($adminNotifications as $notification)
                                                        @if ($notification->user_id == $user_session->id)
                                                            <li>
                                                                <a href="{{ route('notification.url', [$notification->uuid]) }}"
                                                                    class="message-user-item dropdown-item">
                                                                    <div class="message-user-item-left">
                                                                        <div
                                                                            class="single-notification-item d-flex align-items-center">
                                                                            <div class="flex-shrink-0">
                                                                                <div
                                                                                    class="user-img-wrap position-relative radius-50">
                                                                                    @if (!empty(\App\Models\User::getUserInfo($notification->sender_id)->profile_photo))
                                                                                        <img src="{{ asset('profile_photo/') }}<?php echo '/' . \App\Models\User::getUserInfo($notification->sender_id)->profile_photo; ?>"
                                                                                            alt="img"
                                                                                            class="radius-50"
                                                                                            style="width: 50px; height: 50px; border-radius: 50%;">
                                                                                    @else
                                                                                        <img src="{{ asset('149071.png') }}"
                                                                                            alt="dummy-avatar"
                                                                                            style="width: 50px; height: 50px; border-radius: 50%;">
                                                                                    @endif

                                                                                </div>
                                                                            </div>
                                                                            <div class="flex-grow-1 ms-2">
                                                                                <h6 class="color-heading font-14">
                                                                                    {{ $notification->sender->name }}
                                                                                </h6>
                                                                                <p class="font-13 mb-0">
                                                                                    {{ __($notification->text) }}
                                                                                </p>
                                                                                <div class="font-11 color-gray mt-1">
                                                                                    {{ $notification->created_at->diffForHumans() }}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                        @endif
                                                    @empty
                                                        <li>
                                                            <p class="text-center">{{ __('No Data Found') }}</p>
                                                        </li>
                                                    @endforelse
                                                @else
                                                    <li>
                                                        <p class="text-center">{{ __('No Notifications Found') }}</p>
                                                    </li>
                                                @endisset
                                            </ul>
                                            @if ($adminNotifications && count($adminNotifications) > 0)
                                                <div class="dropdown-divider"></div>
                                                <form action="{{ route('notification.all-read') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="user_id"
                                                        value="{{ $user_session->id }}">
                                                    <button type="submit"
                                                        class="dropdown-item dropdown-footer">{{ __('Mark all as read') }}</button>
                                                </form>
                                            @endif
                                        </div>
                                        <!-- Notification Dropdown End -->
                                    </li>



                                    <li class="nav-item dropdown">
                                        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown"
                                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            @if (!empty(\App\Models\User::getUserInfo($user_session->id)->profile_photo))
                                                <img src="{{ asset('profile_photo/') }}<?php echo '/' . \App\Models\User::getUserInfo($user_session->id)->profile_photo; ?>"
                                                    class="rounded-circle user-image" width="25px" height="25px"
                                                    alt="{{ $user_session->name }}">
                                            @else
                                                <img src="{{ asset('149071.png') }}" alt="dummy-avatar"
                                                    style="width: 25px; height: 25px;">
                                            @endif {{ $user_session->name }} <span
                                                class="caret"></span>
                                        </a>
                                        <ul class="shadow-box dropdown-menu" aria-labelledby="navbarDropdown">
                                            <li><a class="dropdown-item" href="{{ url('dashboard') }}"><i
                                                        class="icofont icofont-finger-print"></i>
                                                    {{ __('Panel de Control') }}</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ url('edit_profile') }}">
                                                    <i class="icofont icofont-user-male"></i>
                                                    {{ __('Editar Perfil') }}
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ url('change_password') }}">
                                                    <i class="icofont icofont-ui-lock"></i>
                                                    {{ __('Cambiar Contraseña') }}
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ url('logout') }}">
                                                    <i class="fa fa-sign-out"></i>{{ __('Cerrar Sesión') }}
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                @else
                                    <li style="margin-right:18px"><a href="{{ url('Userlogin') }}"> <i
                                                class="icon-account"></i> {{ __('Iniciar sesión') }} </a></li>
                                    <li><a href="{{ url('signup') }}"> / {{ __('Registrarse') }}</a></li>
                                @endif

                            </ul>
                        </div>
                        <div class="main-header__social">
                            <a href="{{ $general_setting->footer_twitter_link }}"><i class="fab fa-twitter"></i></a>
                            <a href="{{ $general_setting->footer_fb_link }}"><i class="fab fa-facebook"></i></a>
                            <a href="{{ $general_setting->footer_instagram_link }}"><i
                                    class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="main-menu">
                <div class="main-menu__wrapper">
                    <div class="main-menu__wrapper-inner clearfix">
                        <div class="main-menu__left">
                            <div class="main-menu__logo">
                                <a href="/"><img src="{{ asset('site_logo/') }}<?php echo '/' . $general_setting->site_logo; ?>"
                                        height="60"></a>
                            </div>
                            <div class="main-menu__main-menu-box">
                                <a href="#" class="mobile-nav__toggler"><i class="fa fa-bars"></i></a>
                                <ul class="main-menu__list">
                                    <li class="{{ Request::is('/') ? 'current' : '' }}">
                                        <a href="/">Inicio </a>

                                    </li>
                                    <li class="{{ Request::is('page/about') ? 'current' : '' }}">
                                        @foreach ($pages as $page)
                                            @if ($page->page_slug == 'about')
                                                <a
                                                    href="{{ url('page/' . $page->page_slug) }}">{{ __('Acerca de') }}</a>
                                            @endif
                                        @endforeach


                                    </li>
                                    <li class="{{ Request::is('projects') ? 'current' : '' }}">
                                        <a href="{{ url('projects') }}">{{ __('Explorar') }}</a>

                                    </li>

                                    <li class="{{ Request::is('news') ? 'current' : '' }}">
                                        <a href="{{ url('news') }}">{{ __('Noticias') }}</a>
                                    </li>

                                    <li class="{{ Request::is('page/contact') ? 'current' : '' }}">
                                        @foreach ($pages as $page)
                                            @if ($page->page_slug == 'contact')
                                                <a
                                                    href="{{ url('page/' . $page->page_slug) }}">{{ __('Contacto') }}</a>
                                            @endif
                                        @endforeach
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="main-menu__right">
                            <div class="main-menu__call-search-btn-box">
                                {{-- <div class="main-menu__call">
                                    <div class="main-menu__call-icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div class="main-menu__call-content">
                                        <p class="main-menu__call-sub-title">Call Anytime</p>
                                        <h5 class="main-menu__call-number"><a
                                                href="tel:{{ $general_setting->styling }}">+{{ $general_setting->styling }}</a>
                                        </h5>
                                    </div>
                                </div> --}}
                                <div class="main-menu__search-box">
                                    <a href="#"
                                        class="main-menu__search search-toggler icon-magnifying-glass"></a>
                                </div>
                                <div class="main-menu__btn-box">
                                    @if (!empty($user_session))
                                        <a href="{{ url('CreateProject') }}" class="thm-btn main-menu__btn"><i
                                                class="icon-plus-symbol"></i>{{ __(' Agregar un proyecto') }}</a>
                                    @else
                                        <a href="{{ url('signup') }}" class="thm-btn main-menu__btn"><i
                                                class="icon-plus-symbol"></i> {{ __('Agregar un proyecto') }} </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <div class="stricky-header stricked-menu main-menu">
            <div class="sticky-header__content"></div><!-- /.sticky-header__content -->
        </div><!-- /.stricky-header -->

        @yield('content')

        <!--Site Footer Start-->
        <footer class="site-footer">
            <div class="site-footer__top">
                <div class="site-footer__shape-1 float-bob-x">
                    <img src="assets/images/shapes/site-footer-shape-1.png" alt="">
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="100ms">
                            <div class="footer-widget__column footer-widget__about">
                                <div class="footer-widget__logo">
                                    <a href="/" aria-label="logo image"><img
                                            src="{{ asset('site_logo/') }}<?php echo '/' . $general_setting->site_logo; ?>" height="75"></a>
                                </div>
                                <div class="footer-widget__about-text-box">
                                    <p class="footer-widget__about-text"></p>
                                </div>

                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="200ms">
                            <div class="footer-widget__column footer-widget__Explore">
                                <div class="footer-widget__title-box">
                                    <h3 class="footer-widget__title">{{ __('Explorar') }}</h3>
                                </div>
                                <ul class="footer-widget__Explore-list list-unstyled">

                                    <li>
                                        @foreach ($pages as $page)
                                            @if ($page->page_slug == 'about')
                                                <a
                                                    href="{{ url('page/' . $page->page_slug) }}">{{ __('Acerca de') }}</a>
                                            @endif
                                        @endforeach


                                    </li>
                                    <li>
                                        <a href="{{ url('projects') }}">{{ __('Explorar') }}</a>

                                    </li>

                                    <li>
                                        <a href="{{ url('news') }}">{{ __('Noticias') }}</a>
                                    </li>

                                    <li>
                                        @foreach ($pages as $page)
                                            @if ($page->page_slug == 'contact')
                                                <a
                                                    href="{{ url('page/' . $page->page_slug) }}">{{ __('Contacto') }}</a>
                                            @endif
                                        @endforeach
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="300ms">
                            <div class="footer-widget__column footer-widget__Fundraising">
                                <div class="footer-widget__title-box">
                                    <h3 class="footer-widget__title">{{ __('Recaudación de Fondos') }}</h3>
                                </div>
                                <ul class="footer-widget__Explore-list list-unstyled">
                                    @foreach ($category as $row)
                                        <li><a
                                                href="{{ url('project_category/') }}{{ '/' . $row->slug }}">{{ $row->name }}</a>
                                        </li>
                                    @endforeach


                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="400ms">
                            <div class="footer-widget__column footer-widget__Contact">
                                <div class="footer-widget__title-box">
                                    <h3 class="footer-widget__title">{{ __('Contacto') }}</h3>
                                </div>
                                <ul class="footer-widget__Contact-list list-unstyled">
                                    <li>
                                        <div class="icon">
                                            <span class="icon-telephone"></span>
                                        </div>
                                        <div class="text">
                                            <p><a
                                                    href="tel:+{{ $general_setting->styling }}">+{{ $general_setting->styling }}</a>
                                            </p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <span class="icon-email"></span>
                                        </div>
                                        <div class="text">
                                            <p><a
                                                    href="mailto:{{ $general_setting->site_email }}">{{ $general_setting->site_email }}</a>
                                            </p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <span class="icon-pin"></span>
                                        </div>
                                        <div class="text">
                                            <p>{{ $general_setting->address }}</p>
                                        </div>
                                    </li>
                                </ul>
                                <div class="site-footer__social">
                                    <a href="{{ $general_setting->footer_twitter_link }}"><i
                                            class="fab fa-twitter"></i></a>
                                    <a href="{{ $general_setting->footer_fb_link }}"><i
                                            class="fab fa-facebook"></i></a>
                                    <a href="{{ $general_setting->footer_instagram_link }}"><i
                                            class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="site-footer__bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="site-footer__bottom-inner">
                                <p class="site-footer__bottom-text">{!! $general_setting->site_copyright !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!--Site Footer End-->


    </div><!-- /.page-wrapper -->


    <div class="mobile-nav__wrapper">
        <div class="mobile-nav__overlay mobile-nav__toggler"></div>
        <!-- /.mobile-nav__overlay -->
        <div class="mobile-nav__content">
            <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>

            <div class="logo-box">
                <a href="/" aria-label="logo image"><img src="{{ asset('site_logo/') }}<?php echo '/' . $general_setting->site_logo; ?>"
                        width="100" height="75"></a>
            </div>
            <!-- /.logo-box -->
            <div class="mobile-nav__container"></div>
            <!-- /.mobile-nav__container -->

            <ul class="mobile-nav__contact list-unstyled">
                <li>
                    <div class="icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <a href="mailto:{{ $general_setting->site_email }}">{{ $general_setting->site_email }}</a>
                </li>
                <li>
                    <i class="fa fa-phone-alt"></i>
                    <a href="tel:+{{ $general_setting->styling }}">+{{ $general_setting->styling }}</a>
                </li>
            </ul><!-- /.mobile-nav__contact -->
            <div class="mobile-nav__top">
                <div class="mobile-nav__social">
                    <a href="{{ $general_setting->footer_twitter_link }}"><i class="fab fa-twitter"></i></a>
                    <a href="{{ $general_setting->footer_fb_link }}"><i class="fab fa-facebook"></i></a>
                    <a href="{{ $general_setting->footer_instagram_link }}"><i class="fab fa-instagram"></i></a>
                </div><!-- /.mobile-nav__social -->
            </div><!-- /.mobile-nav__top -->



        </div>
        <!-- /.mobile-nav__content -->
    </div>
    <!-- /.mobile-nav__wrapper -->

    <div class="search-popup">
        <div class="search-popup__overlay search-toggler"></div>
        <!-- /.search-popup__overlay -->
        <div class="search-popup__content">
            <form action="#">
                <label for="search" class="sr-only">{{ __('search here') }}</label><!-- /.sr-only -->
                <input type="text" id="search" placeholder="Search Here..." />
                <button type="submit" aria-label="search submit" class="thm-btn">
                    <i class="icon-magnifying-glass"></i>
                </button>
            </form>
        </div>
        <!-- /.search-popup__content -->
    </div>
    <!-- /.search-popup -->

    <a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="icon-right-arrow"></i></a>



    <script src="{{ asset('assets/vendors/jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jarallax/jarallax.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-ajaxchimp/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-appear/jquery.appear.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-circle-progress/jquery.circle-progress.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/odometer/odometer.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/swiper/swiper.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/tiny-slider/tiny-slider.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/wnumb/wNumb.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/wow/wow.js') }}"></script>
    <script src="{{ asset('assets/vendors/isotope/isotope.js') }}"></script>
    <script src="{{ asset('assets/vendors/countdown/countdown.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bxslider/jquery.bxslider.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/vegas/vegas.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-ui/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/vendors/timepicker/timePicker.js') }}"></script>
    <script src="{{ asset('assets/vendors/circleType/jquery.circleType.js') }}"></script>
    <script src="{{ asset('assets/vendors/circleType/jquery.lettering.min.js') }}"></script>
    <!-- template js -->
    <script src="{{ asset('assets/js/qrowd.js') }}"></script>
    <script src="{{ asset('js/notification.js') }}"></script>
    <script src="{{ asset('assets/js/search-blog-list.js') }}"></script>
    <script src="{{ asset('assets/js/blog-comment-reply.js') }}"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <script
        src="{{ asset('admin/js/laravel.pixelstrap.com_endless_assets_js_datatable_datatables_datatable.custom.js') }}">
    </script>
    <script src="{{ asset('admin/js/jquery.dataTables.min.js') }}"></script>

    <!-- Toastr JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Toastr with global options
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
            };
        });
    </script>
    <script src="{{ asset('admin/js/custom/image-preview.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            ClassicEditor
                .create(document.querySelector('.editor'))
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
</body>

</html>
