<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @php
        $general_setting = getApplicationsettings();
        $category = getCategory();
    @endphp
    <title> Home || @yield('title') </title>
    <!-- favicons Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicons/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('site_favicon/') }}<?php echo '/' . $general_setting->site_favicon; ?>" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('site_favicon/') }}<?php echo '/' . $general_setting->site_favicon; ?>" />
    <link rel="manifest" href="{{ asset('assets/images/favicons/site.webmanifest') }}" />
    <meta name="description" content="{{ $general_setting->site_description }}" />

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
                                    <li><a href="{{ url('dashboard') }}"> <i class="icon-account"></i>
                                            {{ $user_session->name }} Account</a></li>
                                @else
                                    <li><a href="{{ url('Userlogin') }}"> <i class="icon-account"></i> Login</a></li>
                                    <li><a href="{{ url('signup') }}">Register</a></li>
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
                                        <a href="/">Home </a>

                                    </li>
                                    <li class="{{ Request::is('page/about') ? 'current' : '' }}">
                                        @foreach ($pages as $page)
                                            @if ($page->page_slug == 'about')
                                                <a
                                                    href="{{ url('page/' . $page->page_slug) }}">{{ $page->page_title }}</a>
                                            @endif
                                        @endforeach


                                    </li>
                                    <li class="{{ Request::is('projects') ? 'current' : '' }}">
                                        <a href="{{ url('projects') }}">Explore</a>

                                    </li>

                                    <li class="{{ Request::is('news') ? 'current' : '' }}">
                                        <a href="{{ url('news') }}">News</a>
                                    </li>

                                    <li class="{{ Request::is('page/contact') ? 'current' : '' }}">
                                        @foreach ($pages as $page)
                                        @if ($page->page_slug == 'contact')
                                            <a
                                                href="{{ url('page/' . $page->page_slug) }}">{{ $page->page_title }}</a>
                                        @endif
                                    @endforeach
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="main-menu__right">
                            <div class="main-menu__call-search-btn-box">
                                <div class="main-menu__call">
                                    <div class="main-menu__call-icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div class="main-menu__call-content">
                                        <p class="main-menu__call-sub-title">Call Anytime</p>
                                        <h5 class="main-menu__call-number"><a
                                                href="tel:{{ $general_setting->styling }}">+{{ $general_setting->styling }}</a>
                                        </h5>
                                    </div>
                                </div>
                                <div class="main-menu__search-box">
                                    <a href="#"
                                        class="main-menu__search search-toggler icon-magnifying-glass"></a>
                                </div>
                                <div class="main-menu__btn-box">
                                    <a href="{{ url('signup') }}" class="thm-btn main-menu__btn"><i
                                            class="icon-plus-symbol"></i>Add a Project</a>
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
                                    <p class="footer-widget__about-text">Lorem quas utamur delicata qui, vix ei prima
                                        mentitum omnesque. Duo corrumpit
                                        cotidieque ne.</p>
                                </div>

                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="200ms">
                            <div class="footer-widget__column footer-widget__Explore">
                                <div class="footer-widget__title-box">
                                    <h3 class="footer-widget__title">Explore</h3>
                                </div>
                                <ul class="footer-widget__Explore-list list-unstyled">

                                    <li>
                                        @foreach ($pages as $page)
                                            @if ($page->page_slug == 'about')
                                                <a
                                                    href="{{ url('page/' . $page->page_slug) }}">{{ $page->page_title }}</a>
                                            @endif
                                        @endforeach


                                    </li>
                                    <li>
                                        <a href="{{ url('projects') }}">Explore</a>

                                    </li>

                                    <li>
                                        <a href="{{ url('news') }}">News</a>
                                    </li>

                                    <li>
                                        @foreach ($pages as $page)
                                        @if ($page->page_slug == 'contact')
                                            <a
                                                href="{{ url('page/' . $page->page_slug) }}">{{ $page->page_title }}</a>
                                        @endif
                                    @endforeach
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="300ms">
                            <div class="footer-widget__column footer-widget__Fundraising">
                                <div class="footer-widget__title-box">
                                    <h3 class="footer-widget__title">Fundraising</h3>
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
                                    <h3 class="footer-widget__title">Contact</h3>
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
                    <i class="fa fa-envelope"></i>
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
                <label for="search" class="sr-only">search here</label><!-- /.sr-only -->
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
    <script src="{{ asset('assets/js/search-blog-list.js') }}"></script>
    <script src="{{ asset('assets/js/blog-comment-reply.js') }}"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">



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