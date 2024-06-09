<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $general_setting = getApplicationsettings();
        $adminNotifications = adminNotifications();
    @endphp

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('site_favicon/') }}<?php echo '/' . $general_setting->site_favicon; ?>" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('site_favicon/') }}<?php echo '/' . $general_setting->site_favicon; ?>" type="image/x-icon">
    <title>{{ $general_setting->site_name }} || @yield('title')</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/fontawesome.css') }}">

    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/icofont.css') }}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/themify.css') }}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/flag-icon.css') }}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/feather-icon.css') }}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/owlcarousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/prism.css') }}">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/custom/image-preview.css') }}">

    <link id="bootstrap-file" rel="stylesheet" type="text/css" href="#">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('admin/css/color-1.css') }}" media="screen">
    <!-- Responsive css-->
    <!-- Include Toastr.js CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <!-- Include Toastr.js JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/date-picker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/select2.css') }}">

    <style>
        /* input file  */
        .personal-image {
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin-top: 15px;
        }

        .personal-image input[type="file"] {
            display: none;
        }

        .personal-figure {
            position: relative;
            width: 150px;
            height: 150px;
        }

        .personal-avatar {
            cursor: pointer;
            width: 150px;
            height: 150px;
            box-sizing: border-box;
            border-radius: 100%;
            border: 2px solid transparent;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.2);
            transition: all ease-in-out .3s;
        }

        .personal-avatar:hover {
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.5);
        }

        .personal-figcaption {
            cursor: pointer;
            position: absolute;
            top: 0px;
            width: inherit;
            height: inherit;
            border-radius: 100%;
            opacity: .6;
            background-color: rgba(0, 0, 0, .3);
            transition: all ease-in-out .3s;
        }


        .personal-figcaption>img {
            margin-top: 32.5px;
            width: 50px;
            height: 50px;
        }
    </style>
</head>

<body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="loader bg-white">
            <div class="whirly-loader"> </div>
        </div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper">
        <!-- Page Header Start-->
        <div class="page-main-header">
            <div class="main-header-right row">
                <div class="main-header-left col-auto px-0 d-lg-none">
                    <div class="logo-wrapper"><a href="{{ url('admin/dashboard') }}"><img
                                src="{{ asset('logo-removebg-preview.png') }}" alt=""></a>
                    </div>
                </div>
                <div class="vertical-mobile-sidebar col-auto ps-3 d-none"><i class="fa fa-bars sidebar-bar"></i></div>
                <div class="mobile-sidebar col-auto ps-0 d-block">
                    <div class="media-body switch-sm">
                        <label class="switch"><a href="#"><i id="sidebar-toggle"
                                    data-feather="align-left"></i></a></label>
                    </div>
                </div>
                <div class="nav-right col p-0">
                    <ul class="nav-menus">
                        <li>
                            <form class="form-inline search-form" action="#" method="get">
                                <div class="form-group me-0">
                                    <div class="Typeahead Typeahead--twitterUsers">
                                        <div class="u-posRelative">
                                            <input class="Typeahead-input form-control-plaintext" id="demo-input"
                                                type="text" name="q" placeholder="Search...">
                                            <div class="spinner-border Typeahead-spinner" role="status"><span
                                                    class="sr-only">Loading...</span></div><span
                                                class="d-sm-none mobile-search"><i data-feather="search"></i></span>
                                        </div>
                                        <div class="Typeahead-menu"></div>
                                    </div>
                                </div>
                            </form>
                        </li>
                        <li><a class="sidebar-header" href="{{ url('/') }}"><i
                                    data-feather="monitor"></i><span></span></a></li>
                        <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i
                                    data-feather="maximize"></i></a></li>


                        <li class="admin-notification-menu position-relative">
                            <a href="#" class="btn btn-dropdown site-language position-relative"
                                id="dropdownNotification" data-bs-toggle="dropdown" aria-expanded="false">
                                <span
                                    style="position: absolute; top: 5px; left: 75%; transform: translate(-50%, -50%);"
                                    class="badge rounded-pill bg-danger">
                                    @if ($adminNotifications)
                                        {{ count($adminNotifications) }}
                                    @else
                                        0
                                    @endif
                                </span>
                                <i data-feather="bell"></i>
                            </a>

                            <!-- Notification Dropdown Start -->
                            <div class="dropdown-menu" aria-labelledby="dropdownNotification">
                                <ul class="dropdown-list custom-scrollbar">
                                    @isset($adminNotifications)
                                        @forelse($adminNotifications as $notification)
                                            @if ($notification->sender)
                                                <li>
                                                    <a href="{{ route('notification.url', [$notification->uuid]) }}"
                                                        class="message-user-item dropdown-item">
                                                        <div class="message-user-item-left">
                                                            <div
                                                                class="single-notification-item d-flex align-items-center">
                                                                <div class="flex-shrink-0">
                                                                    <div class="user-img-wrap position-relative radius-50">

                                                                        @if (!empty(\App\Models\User::getUserInfo($notification->sender_id)->profile_photo))
                                                                            <img src="{{ asset('profile_photo/') }}<?php echo '/' . \App\Models\User::getUserInfo($notification->sender_id)->profile_photo; ?>"
                                                                                alt="img"
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
                                        <button type="submit"
                                            class="dropdown-item dropdown-footer">{{ __('Mark all as read') }}</button>
                                    </form>
                                @endif
                            </div>
                            <!-- Notification Dropdown End -->
                        </li>



                        <li>
                            <a href="#" class="btn btn-dropdown site-language" id="dropdownLanguage"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset(selectedLanguage(session()->get('local'))->flag) }}"
                                    width="50px" height="30px" alt="icon">
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownLanguage">
                                @foreach (appLanguages() as $app_lang)
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ url('admin/local/' . $app_lang->iso_code) }}">
                                            <img src="{{ asset($app_lang->flag) }}" width="50px" height="30px"
                                                alt="icon">
                                            <span>{{ $app_lang->language }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>


                        <li class="onhover-dropdown">
                            <div class="media align-items-center"><img
                                    class="align-self-center pull-right img-50 rounded-circle"
                                    src="{{ asset('profile_photo/') }}<?php echo '/' . $user_session->profile_photo; ?>" alt="header-user">
                                <div class="dotted-animation"><span class="animate-circle"></span><span
                                        class="main-circle"></span>
                                </div>
                            </div>
                            <ul class="profile-dropdown onhover-show-div p-20">
                                <li><a href="{{ url('admin/edit_profile') }}"><i data-feather="user"></i>
                                        {{ __('Editar Perfil') }}</a></li>

                                <li><a href="{{ url('admin/change_password') }}"><i
                                            data-feather="lock"></i>{{ __('Cambiar Contraseña') }} </a></li>
                                {{-- <li><a href="#"><i data-feather="settings"></i>{{ __('Settings') }} </a></li> --}}
                                <li><a href="{{ url('admin/logout') }}"><i data-feather="log-out"></i>
                                        {{ __('Cerrar Sesión') }}</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div class="d-lg-none mobile-toggle pull-right"><i data-feather="more-horizontal"></i></div>
                </div>
                <script id="result-template" type="text/x-handlebars-template">
                    <div class="ProfileCard u-cf">
            <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
            <div class="ProfileCard-details">
            <div class="ProfileCard-realName"></div>
            </div>
            </div>
          </script>
                <script id="empty-template" type="text/x-handlebars-template">
                    <div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div>

          </script>
            </div>
        </div>
        <!-- Page Header Ends   -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            <div class="page-sidebar">
                <div class="main-header-left d-none d-lg-block">
                    <div class="logo-wrapper"><a href="{{ url('admin/dashboard') }}"><img
                                src="{{ asset('site_logo/') }}<?php echo '/' . $general_setting->site_logo; ?>" style="width: 200px;height:60px"
                                alt=""></a>
                    </div>
                </div>
                <div class="sidebar custom-scrollbar">
                    <div class="sidebar-user text-center">
                        <div>
                            @if (!empty($user_session->profile_photo))
                                <img src="{{ asset('profile_photo/') }}<?php echo '/' . $user_session->profile_photo; ?>" class="personal-avatar"
                                    alt="avatar">
                            @else
                                <img src="images/profile photo.png" class="personal-avatar" alt="avatar">
                            @endif
                            <div class="profile-edit"><a href="edit_profile" target="_blank"><i
                                        data-feather="edit"></i></a>
                            </div>
                        </div>
                        <h6 class="mt-3 f-14"><?php
                        echo $user_session->name;
                        ?></h6>

                    </div>
                    @if ($user_session->is_super_admin == 1)
                        <ul class="sidebar-menu">
                            <li><a class="sidebar-header" href="{{ url('admin/dashboard') }}"><i
                                        data-feather="home"></i><span> {{ __('Panel de Control') }}</span></a>

                            </li>


                            </li>
                            <li><a class="sidebar-header" href="#"><i
                                        data-feather="settings"></i><span>{{ __('Configuraciones de Aplicación') }}
                                    </span><i class="fa fa-angle-right pull-right"></i></a>
                                <ul class="sidebar-submenu">

                                    <li><a href="{{ url('admin/smtp_setting') }}"><i
                                                class="fa fa-circle"></i>{{ __('Configuración SMTP') }}
                                        </a></li>
                                    <li><a href="{{ url('admin/payment_gateway') }}"><i
                                                class="fa fa-circle"></i>{{ __('Pasarela de Pago') }} </a></li>
                                    <li><a href="{{ url('admin/social_lite_login') }}"><i
                                                class="fa fa-circle"></i>{{ __('Configuración de Socialite') }}</a>
                                    </li>
                                    <li><a href="{{ url('admin/website_setting') }}"><i class="fa fa-circle"></i>
                                            {{ __('Configuración General') }} </a></li>
                                </ul>
                            </li>

                            <li>
                                <a class="sidebar-header" href="#">
                                    <i data-feather="settings"></i>
                                    <span>{{ __('Application') }}</span>
                                </a>
                                <ul class="sidebar-submenu">

                                    <li class="">
                                        <a href="{{ route('settings.general_setting') }}">
                                            <i class="fa fa-circle"></i>
                                            <span>{{ __('Global Settings') }}</span>
                                        </a>
                                    </li>



                                    <li class="">
                                        <a href="{{ route('settings.location.country.index') }}">
                                            <i class="fa fa-circle"></i>
                                            <span>{{ __('Location Settings') }}</span>
                                        </a>
                                    </li>


                                    {{-- <li class="">
                            <a href="{{ route('settings.theme-setting') }}">
                                <i class="fa fa-circle"></i>
                                <span>{{__('Home Settings')}}</span>
                            </a>
                        </li> --}}



                                    <li class="">
                                        <a href="{{ route('settings.mail-configuration') }}">
                                            <i class="fa fa-circle"></i>
                                            <span>{{ __('Mail Configuration') }}</span>
                                        </a>
                                    </li>


                                    <li class="">
                                        <a href="{{ route('settings.payment_method_settings') }}">
                                            <i class="fa fa-circle"></i>
                                            <span>{{ __('Payment Options') }}</span>
                                        </a>
                                    </li>




                                    {{-- <li class="">
                            <a href="{{ route('settings.faq.cms') }}">
                                <i class="fa fa-circle"></i>
                                <span>{{__('FAQ')}}</span>
                            </a>
                        </li> --}}
                                    <li class="">
                                        <a href="{{ route('settings.support-ticket.cms') }}">
                                            <i class="fa fa-circle"></i>
                                            <span>{{ __('Support Ticket') }}</span>
                                        </a>
                                    </li>

                                    <li class="">
                                        <a href="{{ route('settings.about.gallery-area') }}">
                                            <i class="fa fa-circle"></i>
                                            <span>{{ __('About Us') }}</span>
                                        </a>
                                    </li>

                                    <li class="">
                                        <a href="{{ route('settings.contact.cms') }}">
                                            <i class="fa fa-circle"></i>
                                            <span>{{ __('Contact Us') }}</span>
                                        </a>
                                    </li>





                                </ul>
                            </li>

                            <li><a class="sidebar-header" href="{{ url('admin/banners') }}"><i
                                        data-feather="monitor"></i><span>{{ __('Configuración de la Página de Inicio') }}
                                    </span></a></li>

                            <li class="">
                                <a class="has-arrow sidebar-header" href="#">
                                    <i class="icofont icofont-social-blogger"></i>
                                    <span>{{ __('Administrar Blog') }}</span>
                                </a>
                                <ul class="sidebar-submenu">
                                    <li>
                                        <a href="{{ route('blog.create') }}">
                                            <i class="fa fa-circle"></i>
                                            <span>{{ __('Agregar Blog') }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('blog.index') }}">
                                            <i class="fa fa-circle"></i>
                                            <span>{{ __('Todo el Blog') }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('blog.blog-comment-list') }}">
                                            <i class="fa fa-circle"></i>
                                            <span>{{ __('Lista de Comentarios de Blog') }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('blog.blog-category.index') }}">
                                            <i class="fa fa-circle"></i>
                                            <span>{{ __('Categoría de Blog') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="sidebar-header" href="{{ url('admin/qrcode') }}"><i
                                        class="fa fa-empire"></i> CÓDIGO QR </a></li>
                                        <li>
                                            <a class="sidebar-header" href="{{ route('permissions.index') }}">
                                                <i class="fa fa-key"></i>
                                                <span>{{ __('Permissions') }}</span>
                                            </a>
                                        </li>
                            <li>
                                <a class="sidebar-header" href="{{ route('role.index') }}">
                                    <i class="fa fa-key"></i>
                                    <span>{{ __('Roles') }}</span>
                                </a>
                            </li>

                            <li><a class="sidebar-header" href="{{ url('admin/pages') }}"><i
                                        data-feather="book"></i><span>{{ __('Pages') }} </span></a> </li>
                            <li>
                                <a href="{{ url('admin/mail-templates') }}" class="sidebar-header">
                                    <i data-feather="mail"></i><span>{{ __('Plantillas de Correo') }} </span>
                                </a>
                            </li>
                            <li>
                                <a class="sidebar-header" href="#">
                                    <i class="fa fa-language"></i>
                                    <span>{{ __('Administrar Idioma') }}</span>
                                </a>
                                <ul class="sidebar-submenu">
                                    <li>
                                        <a href="{{ url('admin/language') }}" class="sidebar-header">
                                            <i class="fa fa-circle"></i>
                                            <span>{{ __('Configuraciones de Idioma') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="sidebar-header" href="{{ url('admin/users') }}"><i
                                        data-feather="users"></i><span>{{ __('Gestión de Usuarios') }} </span></a>
                            </li>

                            <li><a class="sidebar-header" href="#"><i data-feather="layers"></i><span>
                                        {{ __('Gestión de Proyectos') }} </span><i
                                        class="fa fa-angle-right pull-right"></i></a>
                                <ul class="sidebar-submenu">
                                    <li>
                                        <a href="{{ route('category.index') }}">
                                            <i class="fa fa-circle"></i>
                                            <span>{{ __('Categoría de Proyecto') }}</span>
                                        </a>
                                    </li>
                                    {{-- <li><a href="categories"><i class="fa fa-circle"></i>Project Category</a></li> --}}
                                    <li><a href="{{ url('admin/Course_list') }}"><i
                                                class="fa fa-circle"></i>{{ __('Lista de Proyectos') }}
                                        </a></li>

                                </ul>
                            </li>

                            <li><a class="sidebar-header" href="{{ url('admin/transactions_report') }}"><i
                                        data-feather="dollar-sign"></i><span>{{ __('Recibir Fondos') }} </span></a>
                            </li>

                        </ul>
                    @endif
                    @if ($user_session->is_super_admin == 0 and $user_session->account_type == 'admin')
                    @endif
                </div>
            </div>
            <!-- Page Sidebar Ends-->
            <!-- Right sidebar Start-->

            <!-- Right sidebar Ends-->
            @yield('content')
            <!-- footer start-->
            <!-- <footer class="footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 footer-copyright">
                <p class="mb-0">Copyright 2024 © Aasif All rights reserved.</p>
              </div>
              <div class="col-md-6">
                <p class="pull-right mb-0">Hand crafted & made with<i class="fa fa-heart"></i></p>
              </div>
            </div>
          </div>
        </footer> -->
        </div>
    </div>
    <!-- latest jquery-->

    <script src="{{ asset('admin/js/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('admin/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('admin/js/feather.min.js') }}"></script>
    <script src="{{ asset('admin/js/feather-icon.js') }}"></script>
    <!-- Sidebar jquery-->
    <script src="{{ asset('admin/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('admin/js/config.js') }}"></script>
    <!-- Plugins JS start-->
    <script src="{{ asset('admin/js/raphael.js') }}"></script>
    <script src="{{ asset('admin/js/morris.js') }}"></script>
    <script src="{{ asset('admin/js/prettify.min.js') }}"></script>
    <script src="{{ asset('admin/js/chart.min.js') }}"></script>
    <script src="{{ asset('admin/js/knob.min.js') }}"></script>
    <script src="{{ asset('admin/js/knob-chart.js') }}"></script>
    <script src="{{ asset('admin/js/prism.min.js') }}"></script>
    <script src="{{ asset('admin/js/clipboard.min.js') }}"></script>
    <script src="{{ asset('admin/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('admin/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('admin/js/counter-custom.js') }}"></script>
    <script src="{{ asset('admin/js/custom-card.js') }}"></script>
    <script src="{{ asset('admin/js/owl.carousel2.js') }}"></script>
    <script src="{{ asset('admin/js/chart.custom.js') }}"></script>
    <script src="{{ asset('admin/js/morris-script.js') }}"></script>
    <script src="{{ asset('admin/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('admin/js/handlebars.js') }}"></script>
    <script src="{{ asset('admin/js/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('admin/js/typeahead.custom.js') }}"></script>
    <script src="{{ asset('admin/js/typeahead.custom2.js') }}"></script>
    <script src="{{ asset('admin/js/chat-menu.js') }}"></script>
    <script src="{{ asset('admin/js/height-equal.js') }}"></script>
    <script src="{{ asset('admin/js/tooltip-init.js') }}"></script>
    <script src="{{ asset('admin/js/handlebars.js') }}"></script>
    <script src="{{ asset('admin/js/typeahead-custom.js') }}"></script>
    <script
        src="{{ asset('admin/js/laravel.pixelstrap.com_endless_assets_js_datatable_datatables_datatable.custom.js') }}">
    </script>
    <script src="{{ asset('admin/js/select2-custom.js') }}"></script>

    <script src="{{ asset('admin/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/js/select2-custom.js') }}"></script>
    <script src="{{ asset('admin/js/select2.full.min.js') }}"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('admin/js/script.js') }}"></script>
    <script src="{{ asset('admin/js/customizer.js') }}"></script>
    <script src="{{ asset('admin/js/email-app.js') }}"></script>

    <!-- Plugin used-->


    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">


    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

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

    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>

</body>

</html>
