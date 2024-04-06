@extends('master')
@section('title')
    Explore Project || {{ $title }}
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
                    <li>Explore</li>
                </ul>
                <h2>Projects || {{ $title }}</h2>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <!--Project Page Two Start-->
    <section class="project-page-two">
        <div class="container">
            <div class="row">
                <!--Recommended One Single Start-->
                @foreach ($campaigns as $row)

                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="recommended-one__single">
                            <div class="recommended-one__img-box">
                                <div class="recommended-one__img">
                                    <img src="{{ getImageFile($row->image) }}" alt="">
                                </div>
                                <div class="recomanded-one__icon">
                                    <i class="far fa-heart"></i>
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
                                                <p>{{ $days_left }} Days Remaining</p>
                                            </div>
                                        </div>
                                    </div>
                                    <h3 class="recommended-one__title"><a
                                            href="{{ url('project-details/') }}{{ '/' . $row->slug }}">{{ $row->title }}</a>
                                    </h3>
                                    <div class="progress-levels">
                                        <!--Skill Box-->
                                        <div class="progress-box">
                                            <div class="inner count-box">
                                                <div class="bar">
                                                    <div class="bar-innner">
                                                        <div class="skill-percent">
                                                            <span class="count-text" data-speed="3000"
                                                                data-stop="70">0</span>
                                                            <span class="percent">%</span>
                                                        </div>
                                                        <div class="bar-fill" data-percent="70"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="project-one__goals">
                                        <p class="project-one__goals-one"><span>$@if ($amount_prefilled)
                                                    {{ implode(',', $amount_prefilled) }}
                                                @else
                                                    No amount prefilled
                                                @endif
                                            </span>
                                            <br>Goal of ${{ $row->goal }}
                                        </p>
                                        <p class="project-one__goals-one"><span class="odometer project-one__plus"
                                                data-count="12"></span>
                                            <br>Backers We Got
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!--Recommended One Single End-->

            </div>
        </div>
    </section>
    <!--Project Page Two End-->
@endsection
