@extends('master')
@section('title')
    Inicio
@endsection
@section('content')
    <!--Main Slider Start-->
    <section class="main-slider clearfix">
        <div class="swiper-container thm-swiper__slider"
            data-swiper-options='{"slidesPerView": 1, "loop": true,
        "effect": "fade",
        "pagination": {
        "el": "#main-slider-pagination",
        "type": "bullets",
        "clickable": true
        },
        "navigation": {
        "nextEl": "#main-slider__swiper-button-next",
        "prevEl": "#main-slider__swiper-button-prev"
        },
        "autoplay": {
        "delay": 5000
        }}'>
            <div class="swiper-wrapper">

                <div class="swiper-slide">
                    <div class="image-layer" style="background-image: url(assets/images/backgrounds/main-slider-1-1.jpg);">
                    </div>
                    <!-- /.image-layer -->
                    <div class="main-slider__shape-1">
                        <img src="assets/images/shapes/main-slider-shape-1.png" alt="">
                    </div>
                    <div class="main-slider__shape-2">
                        <img src="assets/images/shapes/main-slider-shape-2.png" alt="">
                    </div>
                    <div class="main-slider__shape-3">
                        <img src="assets/images/shapes/main-slider-shape-3.png" alt="">
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-7 col-lg-8">
                                <div class="main-slider__content">
                                    <p class="main-slider__sub-title">{{ __('Ahora es fácil recaudar dinero') }}!</p>
                                    <h2 class="main-slider__title">{{ __('Definitivo') }} <br>
                                        {{ __('Financiamiento colectivo') }}
                                        <br> {{ __('Plataformas') }}
                                    </h2>
                                    <div class="main-slider__btn-box">
                                        @if (!empty($user_session))
                                            <a href="{{ url('CreateProject') }}"
                                                class="thm-btn main-slider__btn">{{ __('Comenzar un proyecto') }}
                                            </a>
                                        @else
                                            <a href="{{ url('signup') }}"
                                                class="thm-btn main-slider__btn">{{ __('Comenzar un proyecto') }}
                                            </a>
                                        @endif

                                        <a href="#" class="main-slider__btn-two">{{ __('Hablar con un experto') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="image-layer" style="background-image: url(assets/images/backgrounds/main-slider-1-2.jpg);">
                    </div>
                    <!-- /.image-layer -->
                    <div class="main-slider__shape-1">
                        <img src="assets/images/shapes/main-slider-shape-1.png" alt="">
                    </div>
                    <div class="main-slider__shape-2">
                        <img src="assets/images/shapes/main-slider-shape-2.png" alt="">
                    </div>
                    <div class="main-slider__shape-3">
                        <img src="assets/images/shapes/main-slider-shape-3.png" alt="">
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-7 col-lg-8">
                                <div class="main-slider__content">
                                    <p class="main-slider__sub-title">{{ __('Ahora es fácil recaudar dinero') }}!</p>
                                    <h2 class="main-slider__title">{{ __('Definitivo') }} <br>
                                        {{ __('Financiamiento colectivo') }}
                                        <br> {{ __('Plataformas') }}
                                    </h2>
                                    <div class="main-slider__btn-box">
                                        @if (!empty($user_session))
                                            <a href="{{ url('CreateProject') }}"
                                                class="thm-btn main-slider__btn">{{ __('Comenzar un proyecto') }}
                                            </a>
                                        @else
                                            <a href="{{ url('signup') }}"
                                                class="thm-btn main-slider__btn">{{ __('Comenzar un proyecto') }}
                                            </a>
                                        @endif

                                        <a href="#" class="main-slider__btn-two">{{ __('Hablar con un experto') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="image-layer" style="background-image: url(assets/images/backgrounds/main-slider-1-3.jpg);">
                    </div>
                    <!-- /.image-layer -->
                    <div class="main-slider__shape-1">
                        <img src="assets/images/shapes/main-slider-shape-1.png" alt="">
                    </div>
                    <div class="main-slider__shape-2">
                        <img src="assets/images/shapes/main-slider-shape-2.png" alt="">
                    </div>
                    <div class="main-slider__shape-3">
                        <img src="assets/images/shapes/main-slider-shape-3.png" alt="">
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-7 col-lg-8">
                                <div class="main-slider__content">
                                    <p class="main-slider__sub-title">{{ __('Ahora es fácil recaudar dinero') }}!</p>
                                    <h2 class="main-slider__title">{{ __('Definitivo') }} <br>
                                        {{ __('Financiamiento colectivo') }}
                                        <br> {{ __('Plataformas') }}
                                    </h2>
                                    <div class="main-slider__btn-box">
                                        @if (!empty($user_session))
                                            <a href="{{ url('CreateProject') }}"
                                                class="thm-btn main-slider__btn">{{ __('Comenzar un proyecto') }}
                                            </a>
                                        @else
                                            <a href="{{ url('signup') }}"
                                                class="thm-btn main-slider__btn">{{ __('Comenzar un proyecto') }}
                                            </a>
                                        @endif

                                        <a href="#" class="main-slider__btn-two">{{ __('Hablar con un experto') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <!-- If we need navigation buttons -->
            <div class="main-slider__nav">
                <div class="swiper-button-prev" id="main-slider__swiper-button-next">
                    <i class="icon-right-arrow"></i>
                </div>
                <div class="swiper-button-next" id="main-slider__swiper-button-prev">
                    <i class="icon-right-arrow"></i>
                </div>
            </div>

        </div>
    </section>
    <!--Main Slider End-->

    <!--Categories One Start-->
    <section class="categories-one">
        <div class="container">
            <div class="categories-one__top">
                <div class="row">
                    <div class="col-xl-6 col-lg-7">
                        <div class="categories-one__top-left">
                            <div class="section-title text-left">
                                <span class="section-title__tagline">{{ __('Explorar categorías') }}</span>
                                <h2 class="section-title__title">{{ __('Ver en qué categoría estás interesado') }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="categories-one__backers ">
                    <div class="categories-one__backers-tagline">
                        <p>{{ __('Encuéntralo primero en ACELERA') }}</p>
                    </div>
                    <div class="categories-one__backers-box">
                        <div class="categories-one__backers-icon">
                            <span class="icon-computer"></span>
                        </div>
                        <div class="categories-one__backers-content">
                            <!-- <h3 class="count-text" data-stop="37400" data-speed="2000"></h3> -->
                            <h3 class="odometer" data-count="37400">00</h3>
                            <p>{{ __('Patrocinadores empresariales') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="categories-one__bottom">
                <div class="categories-one__bottom-inner">
                    <div class="row">
                        @foreach ($categories as $category)
                            <div class="col-xl-2 col-lg-4 col-md-6 wow fadeInLeft" data-wow-delay="100ms">
                                <div class="categories-one__single">
                                    <div class="categories-one__icon">
                                        <a href="{{ url('project_category/') }}/{{ $category->slug }}">
                                            @if (empty($category->icon))
                                                <img src="{{ getImageFile($category->image_path) }}"
                                                    alt="{{ $category->name }}">
                                            @else
                                                {!! $category->icon !!}
                                            @endif

                                        </a>


                                    </div>
                                    <a href="{{ url('project_category/') }}{{ '/' . $category->slug }}">
                                        <h4 class="categories-one__title">{{ $category->name }}</h4>
                                    </a>

                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
                <p class="categories-one__bottom-text">
                    {{ __('Descubre proyectos solo para ti y obtén excelentes recomendaciones cuando selecciones tus intereses.') }}
                </p>
            </div>
        </div>
    </section>
    <!--Categories One End-->

    <!--Project One Start-->
    <section class="project-one">
        <div class="container">
            <div class="project-one__top">
                <div class="section-title text-center">
                    <span class="section-title__tagline">{{ __('EMPRESAS A LAS QUE PUEDES APOYAR') }}</span>
                    <h2 class="section-title__title">{{ __('Explora los mejores proyectos destacados ahora') }} <br>
                        {{ __('Días restantes') }}
                    </h2>
                </div>
            </div>
            <div class="project-one__bottom">
                <div class="project-one__carousel owl-carousel owl-theme thm-owl__carousel"
                    data-owl-options='{
                "loop": true,
                "autoplay": false,
                "margin": 30,
                "nav": false,
                "dots": true,
                "smartSpeed": 500,
                "autoplayTimeout": 10000,
                "navText": ["<span class=\"fa fa-angle-left\"></span>","<span class=\"fa fa-angle-right\"></span>"],
                "responsive": {
                    "0": {
                        "items": 1
                    },
                    "768": {
                        "items": 2
                    },
                    "992": {
                        "items": 3
                    },
                    "1200": {
                        "items": 3
                    }
                }
            }'>

                    <!--Project One Single Start-->
                    @foreach ($project as $row)
                    <div class="item">
                        <div class="project-one__single">
                            <div class="project-one__img-box">
                                <div class="project-one__img">
                                    <img src="{{ getImageFile($row->image) }}" alt="">
                                </div>
                                @php
                                    $likeCount = \App\Models\Like::where('project_id', $row->id)->count();
                                @endphp
                                <div class="project-one__icon">
                                    <i class="far fa-heart" id="heart-icons{{ $row->id }}" data-project-id="{{ $row->id }}"></i>
                                    <br>
                                    <span id="like-count{{ $row->id }}" class="like-count" style="color:#fff">
                                        {{ $likeCount }}
                                    </span>
                                </div>
                            </div>
                            <div class="project-one__content">
                                <div class="project-one__tag">
                                    @php
                                        $category = \App\Models\Category::find($row->category_id);
                                        $days_left = $row->days_left();
                                        $amount_prefilled = $row->amount_prefilled();
                                    @endphp
                                    <p>{{ $category->name }}</p>
                                </div>
                                <h5 class="project-one__title" style="height: 50px; overflow: visible;"><a href="{{ url('project-details/') }}/{{ $row->slug }}">{{ $row->title }}</a></h5>
                                <div class="project-one__remaing">
                                    <div class="icon">
                                        <i class="fa fa-clock"></i>
                                    </div>
                                    <div class="text">
                                        <p>{{ $days_left }} {{ __('Días Restantes') }}</p>
                                    </div>
                                </div>
                                <div class="progress-levels">
                                    <!--Skill Box-->
                                    <div class="progress-box">
                                        <div class="inner count-box">
                                            <div class="bar">
                                                <div class="bar-innner">
                                                    <div class="skill-percent">
                                                        @foreach ($percentRaisedArray as $projectId => $percentRaised)
                                                            @if ($row->id == $projectId)
                                                                <span class="count-text" data-speed="3000" data-stop="{{ $percentRaised }}">0</span>
                                                                <span class="percent">%</span>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    <div class="bar-fill" data-percent="{{ $percentRaised }}"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="project-one__goals">
                                    <p class="project-one__goals-one">{{ __('Logrado') }}:<span id="like-count{{ $row->id }}">BS @foreach ($totalRaisedArray as $projectId => $Raised)
                                        @if ($row->id == $projectId)
                                            {{ $Raised }}
                                        @endif
                                    @endforeach</span></p>
                                    <p class="project-one__goals-one">{{ __('Meta') }}:<span>BS {{ $row->goal }}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach

                <script>
                    $(document).ready(function() {
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": true,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                        };

                        $('[id^="heart-icons"]').click(function() {
                            var projectId = $(this).data('project-id');
                            var icon = $(this);

                            $.ajax({
                                type: 'POST',
                                url: "{{ route('like') }}", // Use the named route
                                data: {
                                    projectId: projectId,
                                },
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(data) {
                                    if (data.success) {
                                        toastr.success(data.message, "", {
                                            onHidden: function() {
                                                window.location.reload(); // Reload the page after toastr is hidden
                                            }
                                        });
                                    } else {
                                        toastr.error(data.message); // Display error message
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error(xhr.responseText);
                                    toastr.error("Like Request Failed. Please try again later.");
                                }
                            });
                        });

                    });
                </script>
                </div>
            </div>
        </div>
    </section>
    <!--Project One End-->

    <div class="black-bg background-repeat-no background-position-top-right"
        style="background-image: url(assets/images/shapes/why-choose-funfact-bg-1-1.png);">
        <!--Why Choose One Start-->
        <section class="why-choose-one">
            <div class="container">
                <div class="why-choose-one__inner">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="why-choose-one__left">
                                <div class="section-title text-left">
                                    <span
                                        class="section-title__tagline">{{ __('LOS BENEFICIOS DE NUESTRA PLATAFORMA') }}</span>
                                    <h2 class="section-title__title">{{ __('Por qué Deberías Elegir la') }} <br>
                                        {{ __('Plataforma ACELERA') }} </h2>
                                </div>
                                <div class="why-choose-one__left-text">
                                    <p>{{ __('Hay ciertos atributos de una profesión y uno tiene que aprovecharlos para trabajar de manera eficiente y crecer en ese negocio. Comparto mi experiencia como diseñador/a de interiores, una profesión de gran estética.') }}
                                    </p>
                                </div>
                                <ul class="why-choose-one__points list-unstyled">
                                    <li>
                                        <div class="icon">
                                            <i class="icon-check-mark"></i>
                                        </div>
                                        <div class="content">
                                            <h3 class="title">{{ __('Tasas de Éxito del 100%') }}</h3>
                                            <p class="text">{{ __('Lorem ipsum velit anod ips aliquet enean quis.') }}
                                            </p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <i class="icon-check-mark"></i>
                                        </div>
                                        <div class="content">
                                            <h3 class="title">{{ __('Millones en Financiamiento') }}</h3>
                                            <p class="text">{{ __('Lorem ipsum velit anod ips aliquet enean quis.') }}
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                                @if (!empty($user_session))
                                    <a href="{{ url('CreateProject') }}" class="thm-btn">{{ __('Haz que Suceda') }}</a>
                                @else
                                    <a href="{{ url('signup') }}" class="thm-btn">{{ __('Haz que Suceda') }}</a>
                                @endif

                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="why-choose-one__right">
                                <div class="why-choose-one__img-box">
                                    <div class="why-choose-one__img">
                                        <img src="assets/images/resources/why-choose-1.1.jpg" alt="">
                                    </div>
                                    <div class="why-choose-one__trusted">
                                        <p>{{ __('Confiado por más') }} <br>{{ __('de') }} <span class="odometer"
                                                data-count="3500">00</span>
                                            <br>
                                            {{ __('clientes') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.why-choose-one__inner -->
            </div>
        </section>
        <!--Why Choose One End-->

        <!--Counter One Start-->
        <section class="counter-one">
            <div class="container">
                <div class="row">
                    <!--Counter One Single Start-->
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="100ms">
                        <div class="counter-one__single">
                            <div class="counter-one__single-inner">
                                <div class="counter-one__border-left"></div>
                                <div class="counter-one__border-right"></div>
                                <div class="counter-one__icon">
                                    <span class="icon-verified"></span>
                                </div>
                                <div class="counter-one__count-box">
                                    <h3 class="odometer" data-count="790">00</h3>
                                    <p class="counter-one__text">{{ __('Proyectos Completados') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Counter One Single End-->
                    <!--Counter One Single Start-->
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="200ms">
                        <div class="counter-one__single">
                            <div class="counter-one__single-inner">
                                <div class="counter-one__border-left"></div>
                                <div class="counter-one__border-right"></div>
                                <div class="counter-one__icon">
                                    <span class="icon-business"></span>
                                </div>
                                <div class="counter-one__count-box">
                                    <h3 class="odometer" data-count="260">00</h3>
                                    <p class="counter-one__text">{{ __('Financiamientos de Socios') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Counter One Single End-->
                    <!--Counter One Single Start-->
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="300ms">
                        <div class="counter-one__single">
                            <div class="counter-one__single-inner">
                                <div class="counter-one__border-left"></div>
                                <div class="counter-one__border-right"></div>
                                <div class="counter-one__icon">
                                    <span class="icon-stand-out"></span>
                                </div>
                                <div class="counter-one__count-box">
                                    <h3 class="odometer" data-count="86">00</h3>
                                    <span class="counter-one__letter">k</span>
                                    <p class="counter-one__text">{{ __('Recaudado Hasta la Fecha') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Counter One Single End-->
                    <!--Counter One Single Start-->
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="400ms">
                        <div class="counter-one__single">
                            <div class="counter-one__single-inner">
                                <div class="counter-one__border-left"></div>
                                <div class="counter-one__border-right"></div>
                                <div class="counter-one__icon">
                                    <span class="icon-coaching"></span>
                                </div>
                                <div class="counter-one__count-box">
                                    <h3 class="odometer" data-count="940">00</h3>
                                    <p class="counter-one__text">{{ __('Clientes Satisfechos') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Counter One Single End-->
                </div>
            </div>
        </section>
        <!--Counter One End-->
    </div><!-- /.black-bg -->


    <!--Newsletter Start-->
    {{-- <section class="newsletter">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-7">
                    <div class="newsletter__left">
                        <div class="section-title text-left">
                            <span class="section-title__tagline">Subscribe to newsletter</span>
                            <h2 class="section-title__title">Get our Complete Crowdfunding Guides</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-5">
                    <div class="newsletter__right">
                        <form class="newsletter__form">
                            <div class="newsletter__input-box">
                                <input type="email" placeholder="Enter your email" name="email">
                                <button type="submit" class="newsletter__btn"><i
                                        class="fas fa-paper-plane"></i></button>
                            </div>
                        </form>
                        <div class="checked-box">
                            <input type="checkbox" name="skipper1" id="skipper" checked="">
                            <label for="skipper"><span></span>I agree to all terms and policies of the
                                company</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!--Newsletter End-->

    <!--Recommended One Start-->
    {{-- <section class="recommended-one">
        <div class="container">
            <div class="recommended-one__top">
                <div class="section-title text-center">
                    <span class="section-title__tagline">{{ __('EMPRESAS A LAS QUE PUEDES APOYAR') }}</span>
                    <h2 class="section-title__title">{{ __('Recomendado para ti') }} <br>{{ __('Proyectos Nuevos') }}
                    </h2>
                </div>
            </div>
            <div class="recommended-one__bottom">
                <div class="recommended-one__carousel owl-carousel owl-theme thm-owl__carousel"
                    data-owl-options='{
                "loop": true,
                "autoplay": false,
                "margin": 30,
                "nav": false,
                "dots": true,
                "smartSpeed": 500,
                "autoplayTimeout": 10000,
                "navText": ["<span class=\"fa fa-angle-left\"></span>","<span class=\"fa fa-angle-right\"></span>"],
                "responsive": {
                    "0": {
                        "items": 1
                    },
                    "768": {
                        "items": 2
                    },
                    "992": {
                        "items": 3
                    },
                    "1200": {
                        "items": 4
                    }
                }
           }'>
                    <!--Recommended One Single Start-->
                    @foreach ($project as $row)
                    <div class="item">
                        <div class="recommended-one__single">
                            <div class="recommended-one__img-box">
                                <div class="recommended-one__img">
                                    <img src="{{ getImageFile($row->image) }}" alt="">
                                </div>
                                @php
                                    $likeCount = \App\Models\Like::where('project_id', $row->id)->count();
                                @endphp
                                <div class="recomanded-one__icon">
                                    <i class="far fa-heart" id="heart-icon{{ $row->id }}" data-project-id="{{ $row->id }}"></i>
                                    <br>
                                    <span id="like-count{{ $row->id }}" class="like-count" style="color:#fff">
                                        {{ $likeCount }}
                                    </span>
                                </div>
                            </div>

                            <div class="recommended-one__content">
                                <div class="recommended-one__tag-and-remaining">
                                    <div class="recommended-one-tag">
                                        @php
                                            $category = \App\Models\Category::find($row->category_id);
                                            $days_left = $row->days_left();
                                            $amount_prefilled = $row->amount_prefilled();
                                        @endphp
                                        <p>{{ $category->name }}</p>
                                    </div>
                                    <div class="recommended-one__remaing">
                                        <div class="icon">
                                            <i class="fa fa-clock"></i>
                                        </div>
                                        <div class="text">
                                            <p>{{ $days_left }} {{ __('Días Restantes') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="recommended-one__title"><a href="{{ url('project-details/') }}/{{ $row->slug }}">{{ $row->title }}</a></h3>
                                <div class="progress-levels">
                                    <!--Skill Box-->
                                    <div class="progress-box">
                                        <div class="inner count-box">
                                            <div class="bar">
                                                <div class="bar-innner">
                                                    <div class="skill-percent">
                                                        @foreach ($percentRaisedArray as $projectId => $percentRaised)
                                                            @if ($row->id == $projectId)
                                                                <span class="count-text" data-speed="3000" data-stop="{{ $percentRaised }}">0</span>
                                                                <span class="percent">%</span>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    <div class="bar-fill" data-percent="{{ $percentRaised }}"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="project-one__goals">
                                    <p class="project-one__goals-one">{{ __('Logrado') }}:<span id="like-count{{ $row->id }}">BS @foreach ($totalRaisedArray as $projectId => $Raised)
                                        @if ($row->id == $projectId)
                                            {{ $Raised }}
                                        @endif
                                    @endforeach</span></p>
                                    <p class="project-one__goals-one">{{ __('Meta') }}:<span>BS {{ $row->goal }}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <script>
                    $(document).ready(function() {
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": true,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                        };


                        $('[id^="heart-icon"]').click(function() {
                            var projectId = $(this).data('project-id');
                            var icon = $(this);

                            $.ajax({
                                type: 'POST',
                                url: "{{ route('like') }}", // Use the named route
                                data: {
                                    projectId: projectId,
                                },
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(data) {
                                    if (data.success) {
                                        toastr.success(data.message, "", {
                                            onHidden: function() {
                                                window.location.reload(); // Reload the page after toastr is hidden
                                            }
                                        });
                                    } else {
                                        toastr.error(data.message); // Display error message
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error(xhr.responseText);
                                    toastr.error("Like Request Failed. Please try again later.");
                                }
                            });
                        });
                    });
                </script>

        </div>
        </div>
        </div>
    </section> --}}
    <!--Recommended One End-->

    <!--Individuals Work Start-->
    {{-- <section class="individuals-work">
        <div class="individuals-work__bg" data-jarallax data-speed="0.2" data-imgPosition="50% 0%"
            style="background-image: url(assets/images/backgrounds/individuals-bg.jpg);"></div>
        <div class="container">
            <div class="individuals-work__inner">
                <div class="individuals-work__video-link">
                    <a href="https://www.youtube.com/watch?v=Get7rqXYrbQ" class="video-popup">
                        <div class="individuals-work__video-icon">
                            <span class="fa fa-play"></span>
                            <i class="ripple"></i>
                        </div>
                    </a>
                </div>
                <h3 class="individuals-work__title">ACELERA is evolving the way
                    <br>individuals works
                </h3>
            </div>
        </div>
    </section> --}}
    <!--Individuals Work End-->

    <!--Testimonial One Start-->
    {{-- <section class="testimonial-one">
        <div class="container">
            <div class="testimonial-one__slider">
                <div class="testimonial-one__main-content">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6">
                            <div class="testimonial-one__main-content-left">
                                <div class="testimonial-one__main-content-img">
                                    <img src="assets/images/testimonial/testimonial-one-main-content-img-1.jpg"
                                        alt="">
                                    <div class="testimonial-one__review-box">
                                        <p>{{ __('their') }} <br>{{ __('Reviews') }} </p>
                                        <div class="testimonial-one__review-icon">
                                            <img src="assets/images/icon/comment-icon.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <div class="testimonial-one__main-content-right">
                                <div class="section-title text-left">
                                    <span class="section-title__tagline">{{ __('Our Testimonials') }}</span>
                                    <h2 class="section-title__title">{{ __('Reviews Directly from the ACELERA') }}
                                    </h2>
                                </div>
                                <div class="swiper-container" id="testimonials-one__carousel">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="testimonial-one__rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <p class="testimonial-one__text-1">
                                                {{ __('tried this smart piano and learned
                                                                                                                                                                                                                                                how to play music in a day. There are many variations of passages of
                                                                                                                                                                                                                                                lorem ipsum but the majority have alteration in some form, by words
                                                                                                                                                                                                                                                look. It has survived not only five centuries.') }}
                                            </p>
                                            <div class="testimonial-one__client-info">
                                                <div class="testimonial-one__client-details">
                                                    <div class="testimonial-one__client-img">
                                                        <img src="assets/images/testimonial/testimonial-one-client-img-1.jpg"
                                                            alt="">
                                                    </div>
                                                    <div class="testimonial-one__client-content">
                                                        <h4>{{ __('Kevin Copoer') }}</h4>
                                                        <p>{{ __('CO Founder') }}</p>
                                                    </div>
                                                </div>
                                                <div class="testimonial-one__quote">
                                                    <span class="icon-quotes"></span>
                                                </div>
                                            </div>
                                        </div><!-- /.swiper-slide -->
                                        <div class="swiper-slide">
                                            <div class="testimonial-one__rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <p class="testimonial-one__text-1">
                                                {{ __('tried this smart piano
                                                                                                                                                                                                                                                and learned
                                                                                                                                                                                                                                                how to play music in a day. There are many variations of
                                                                                                                                                                                                                                                passages of
                                                                                                                                                                                                                                                lorem ipsum but the majority have alteration in some
                                                                                                                                                                                                                                                form, by words
                                                                                                                                                                                                                                                look. It has survived not only five centuries.') }}
                                            </p>
                                            <div class="testimonial-one__client-info">
                                                <div class="testimonial-one__client-details">
                                                    <div class="testimonial-one__client-img">
                                                        <img src="assets/images/testimonial/testimonial-one-client-img-2.jpg"
                                                            alt="">
                                                    </div>
                                                    <div class="testimonial-one__client-content">
                                                        <h4>{{ __('Sarah Albert') }}</h4>
                                                        <p>{{ __('CO Founder') }}</p>
                                                    </div>
                                                </div>
                                                <div class="testimonial-one__quote">
                                                    <span class="icon-quotes"></span>
                                                </div>
                                            </div>
                                        </div><!-- /.swiper-slide -->
                                        <div class="swiper-slide">
                                            <div class="testimonial-one__rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <p class="testimonial-one__text-1">
                                                {{ __('tried this smart piano
                                                                                                                                                                                                                                                and learned
                                                                                                                                                                                                                                                how to play music in a day. There are many variations of
                                                                                                                                                                                                                                                passages of
                                                                                                                                                                                                                                                lorem ipsum but the majority have alteration in some
                                                                                                                                                                                                                                                form, by words
                                                                                                                                                                                                                                                look. It has survived not only five centuries.') }}
                                            </p>
                                            <div class="testimonial-one__client-info">
                                                <div class="testimonial-one__client-details">
                                                    <div class="testimonial-one__client-img">
                                                        <img src="assets/images/testimonial/testimonial-one-client-img-3.jpg"
                                                            alt="">
                                                    </div>
                                                    <div class="testimonial-one__client-content">
                                                        <h4>{{ __('Kevin Martin') }}</h4>
                                                        <p>{{ __('CO Founder') }}</p>
                                                    </div>
                                                </div>
                                                <div class="testimonial-one__quote">
                                                    <span class="icon-quotes"></span>
                                                </div>
                                            </div>
                                        </div><!-- /.swiper-slide -->
                                        <div class="swiper-slide">
                                            <div class="testimonial-one__rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <p class="testimonial-one__text-1">
                                                {{ __('tried this smart piano
                                                                                                                                                                                                                                                and learned
                                                                                                                                                                                                                                                how to play music in a day. There are many variations of
                                                                                                                                                                                                                                                passages of
                                                                                                                                                                                                                                                lorem ipsum but the majority have alteration in some
                                                                                                                                                                                                                                                form, by words
                                                                                                                                                                                                                                                look. It has survived not only five centuries.') }}
                                            </p>
                                            <div class="testimonial-one__client-info">
                                                <div class="testimonial-one__client-details">
                                                    <div class="testimonial-one__client-img">
                                                        <img src="assets/images/testimonial/testimonial-one-client-img-4.jpg"
                                                            alt="">
                                                    </div>
                                                    <div class="testimonial-one__client-content">
                                                        <h4>{{ __('Jessica Brown') }}</h4>
                                                        <p>{{ __('CO Founder') }}</p>
                                                    </div>
                                                </div>
                                                <div class="testimonial-one__quote">
                                                    <span class="icon-quotes"></span>
                                                </div>
                                            </div>
                                        </div><!-- /.swiper-slide -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="testimonials-one__thumb-wrapper">
                    <div class="swiper-container" id="testimonials-one__thumb">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="testimonial-one__img-holder">
                                    <img src="assets/images/testimonial/testimonial-one-client-img-1.jpg" alt="">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="testimonial-one__img-holder">
                                    <img src="assets/images/testimonial/testimonial-one-client-img-2.jpg" alt="">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="testimonial-one__img-holder">
                                    <img src="assets/images/testimonial/testimonial-one-client-img-3.jpg" alt="">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="testimonial-one__img-holder">
                                    <img src="assets/images/testimonial/testimonial-one-client-img-4.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.testimonials-one__thumb-wrapper -->
                <div id="testimonials-one__carousel-pagination"></div>
            </div>
        </div>
    </section> --}}
    <!--Testimonial One End-->

    <!--Brand One Start-->
    {{-- <section class="brand-one">
    <div class="container">
        <div class="brand-one__title"></div>
        <div class="thm-swiper__slider swiper-container" data-swiper-options='{"spaceBetween": 100,
        "slidesPerView": 5,
        "loop": true,
        "navigation": {
            "nextEl": "#brand-one__swiper-button-next",
            "prevEl": "#brand-one__swiper-button-prev"
        },
        "autoplay": { "delay": 5000 },
        "breakpoints": {
            "0": {
                "spaceBetween": 30,
                "slidesPerView": 2
            },
            "375": {
                "spaceBetween": 30,
                "slidesPerView": 2
            },
            "575": {
                "spaceBetween": 30,
                "slidesPerView": 3
            },
            "767": {
                "spaceBetween": 50,
                "slidesPerView": 4
            },
            "991": {
                "spaceBetween": 50,
                "slidesPerView": 5
            },
            "1199": {
                "spaceBetween": 100,
                "slidesPerView": 5
            }
        }}'>
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="assets/images/brand/brand-1-1.png" alt="">
                </div><!-- /.swiper-slide -->
                <div class="swiper-slide">
                    <img src="assets/images/brand/brand-1-2.png" alt="">
                </div><!-- /.swiper-slide -->
                <div class="swiper-slide">
                    <img src="assets/images/brand/brand-1-3.png" alt="">
                </div><!-- /.swiper-slide -->
                <div class="swiper-slide">
                    <img src="assets/images/brand/brand-1-4.png" alt="">
                </div><!-- /.swiper-slide -->
                <div class="swiper-slide">
                    <img src="assets/images/brand/brand-1-5.png" alt="">
                </div><!-- /.swiper-slide -->
                <div class="swiper-slide">
                    <img src="assets/images/brand/brand-1-1.png" alt="">
                </div><!-- /.swiper-slide -->
                <div class="swiper-slide">
                    <img src="assets/images/brand/brand-1-2.png" alt="">
                </div><!-- /.swiper-slide -->
                <div class="swiper-slide">
                    <img src="assets/images/brand/brand-1-3.png" alt="">
                </div><!-- /.swiper-slide -->
                <div class="swiper-slide">
                    <img src="assets/images/brand/brand-1-4.png" alt="">
                </div><!-- /.swiper-slide -->
                <div class="swiper-slide">
                    <img src="assets/images/brand/brand-1-5.png" alt="">
                </div><!-- /.swiper-slide -->
            </div>
        </div>
        <!-- If we need navigation buttons -->
        <div class="brand-one__nav">
            <div class="swiper-button-prev" id="brand-one__swiper-button-next">
                <i class="fas fa-angle-left"></i>
            </div>
            <div class="swiper-button-next" id="brand-one__swiper-button-prev">
                <i class="fas fa-angle-right"></i>
            </div>
        </div>
    </div>
</section> --}}
    <!--Brand One End-->

    <!--News One Start-->
    <section class="news-one">
        <div class="news-one__bg-color"></div>
        <div class="container">
            <div class="section-title text-center">
                <span class="section-title__tagline">{{ __('DIRECTAMENTE DESDE LAS ENTRADAS DEL BLOG') }}</span>
                <h2 class="section-title__title">{{ __('Consulta las Últimas Noticias') }} <br> {{ __('y Artículos') }}
                </h2>
            </div>
            <div class="row">
                @foreach ($blogs as $row)
                    <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="100ms">
                        <!--News One Single Start-->
                        <div class="news-one__single">
                            <div class="news-one__img-box">
                                <div class="news-one__img">
                                    <img src="{{ getImageFile($row->image_path) }}" alt="">
                                    <a href="{{ $row->slug }}">
                                        <span class="news-one__plus"></span>
                                    </a>
                                </div>
                                <div class="news-one__date">
                                    <p>{{ \Carbon\Carbon::parse($row->created_at)->format('d') }}</p>

                                    <span>{{ \Carbon\Carbon::parse($row->created_at)->format('F') }}</span>

                                </div>
                            </div>
                            <div class="news-one__content">
                                <ul class="news-one__meta list-unstyled">
                                    <li>
                                        <a href="{{ url('blog_details/') }}{{ '/' . $row->slug }}"><i
                                                class="fas fa-user-circle"></i>{{ __('por Administrador') }}</a>
                                    </li>
                                    <li>
                                        @php
                                            $blogComments = \App\Models\BlogComment::active()
                                                ->where('blog_id', $row->id)
                                                ->whereNull('parent_id')
                                                ->get();
                                        @endphp
                                        <a href="{{ url('blog_details/') }}{{ '/' . $row->slug }}"><i
                                                class="fas fa-comments"></i>{{ @$blogComments->count() }}
                                            {{ __('Comentarios') }}</a>
                                    </li>
                                </ul>
                                <h3 class="news-one__title"><a
                                        href="{{ url('blog_details/') }}{{ '/' . $row->slug }}">{{ $row->title }}</a>
                                </h3>
                                <div class="news-one__bottom">
                                    <div class="news-one__button">
                                        <a
                                            href="{{ url('blog_details/') }}{{ '/' . $row->slug }}">{{ __('LEER MÁS') }}</a>
                                    </div>
                                    <div class="news-one__arrow">
                                        <a href="{{ url('blog_details/') }}{{ '/' . $row->slug }}"><span
                                                class="icon-right-arrow"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--News One Single Start-->
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!--News One End-->

    <!--Ready One Start-->
    <section class="ready-one">
        <div class="container">
            <div class="ready-one__inner">
                <div class="ready-one-shape-1 float-bob-x">
                    <img src="assets/images/shapes/ready-one-shape-1.png" alt="">
                </div>
                <div class="ready-one__big-icon float-bob-y-2">
                    <span class="icon-fundraiser"></span>
                </div>
                <div class="ready-one__left">
                    <div class="icon">
                        <span class="icon-fundraiser"></span>
                    </div>
                    <div class="content">
                        <p>{{ __('Tu historia comienza desde aquí') }}</p>
                        <h3>{{ __('Listo/a para recaudar fondos para una idea?') }}</h3>
                    </div>
                </div>
                <div class="ready-one__right">
                    @if (!empty($user_session))
                        <a href="{{ url('CreateProject') }}"
                            class="thm-btn ready-one__btn">{{ __('Haz que Suceda') }}</a>
                    @else
                        <a href="{{ url('signup') }}" class="thm-btn ready-one__btn">{{ __('Haz que Suceda') }}</a>
                    @endif

                </div>
            </div>
        </div>
    </section>
    <!--Ready One End-->
@endsection
