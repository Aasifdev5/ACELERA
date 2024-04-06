@extends('master')
@section('title')
    News
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
                    <li>News Sidebar</li>
                </ul>
                <h2>News Sidebar</h2>
            </div>
        </div>
    </section>
    <!--Page Header End-->


    <section class="news-sidebar">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7">
                    <div class="blog-sidebar__left">
                        <div class="news-sidebar__content">
                            @foreach ($news as $blog_details)
                                <div class="news-sidebar__single">
                                    <div class="news-sidebar__img">
                                        <img src="{{ getImageFile($blog_details->image_path) }}" alt="">
                                        <div class="news-sidebar__date">
                                            <p>{{ \Carbon\Carbon::parse($blog_details->created_at)->format('d') }}</p>
                                            <span>{{ \Carbon\Carbon::parse($blog_details->created_at)->format('F') }}</span>
                                        </div>
                                    </div>
                                    <div class="news-sidebar__content-box">
                                        <ul class="list-unstyled news-sidebar__meta">
                                            <li><a href="{{ url('blog_details/') }}{{ '/' . $blog_details->slug }}"><i
                                                        class="fas fa-user-circle"></i>by
                                                    Admin</a>
                                            </li>
                                            <li><a href="{{ url('blog_details/') }}{{ '/' . $blog_details->slug }}"><i
                                                        class="fas fa-comments"></i>02
                                                    Comments</a>
                                            </li>
                                        </ul>
                                        <h3 class="news-sidebar__title">
                                            <a
                                                href="{{ url('blog_details/') }}{{ '/' . $blog_details->slug }}">{{ $blog_details->title }}</a>
                                        </h3>
                                        <p class="news-sidebar__text">{!! new \Illuminate\Support\HtmlString(\Illuminate\Support\Str::words($blog_details->details, 15, '...')) !!}</p>


                                        <div class="news-sidebar__bottom">
                                            <a href="{{ url('blog_details/') }}{{ '/' . $blog_details->slug }}"
                                                class="news-sidebar__read-more">Read More</a>
                                            <a href="{{ url('blog_details/') }}{{ '/' . $blog_details->slug }}"
                                                class="news-sidebar__arrow"><span class="icon-right-arrow"></span></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach



                        </div>
                        <div class="news-sidebar__bottom-box">
                            <div class="news-sidebar__bottom-box-icon">
                                <img src="assets/images/icon/news-sidebar-bottom-box-icon.png" alt="">
                            </div>
                            <p class="news-sidebar__bottom-box-text">There are many variations of passages of Lorem
                                Ipsum available, but majority have suffered alteration in some form, by injected
                                humour, or randomised words which don't look even slightly believable.</p>
                        </div>
                        <div class="news-sidebar__delivering-services">
                            <div class="news-sidebar__delivering-services-icon">
                                <a href="news-details.html"><img
                                        src="assets/images/icon/news-sidebar__delivering-services-icon.png"
                                        alt=""></a>
                            </div>
                            <h3 class="news-sidebar__delivering-services-title"><a href="news-details.html">Take
                                    your startup to the next level</a></h3>
                        </div>
                        <div class="news-sidebar__load-more">
                            <a href="news-details.html" class="thm-btn news-sidebar__load-more-btn">Load More
                                Posts</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="sidebar">
                        <div class="sidebar__single sidebar__search">
                            <form action="#" class="sidebar__search-form">
                                <input type="search" placeholder="Search here">
                                <button type="submit"><i class="icon-magnifying-glass"></i></button>
                            </form>
                        </div>
                        <div class="sidebar__single sidebar__post">
                            <h3 class="sidebar__title">Latest Posts</h3>
                            <ul class="sidebar__post-list list-unstyled">
                                @foreach ($latest_posts as $lp)
                                    <li>
                                        <div class="sidebar__post-image">
                                            <img src="{{ getImageFile($lp->image_path) }}" alt="">
                                        </div>
                                        <div class="sidebar__post-content">
                                            <h3>
                                                <span class="sidebar__post-content-meta"><i
                                                        class="fas fa-clock"></i>{{ \Carbon\Carbon::parse($lp->created_at)->format('j F, Y') }}
                                                </span>
                                                <a
                                                    href="{{ url('blog_details/') }}{{ '/' . $lp->slug }}">{{ $lp->title }}</a>
                                            </h3>
                                        </div>
                                    </li>
                                @endforeach


                            </ul>
                        </div>
                        <div class="sidebar__single sidebar__category">
                            <h3 class="sidebar__title">Categories</h3>
                            <ul class="sidebar__category-list list-unstyled">
                                @php
                                    $categoryList = \App\Models\BlogCategory::all();
                                @endphp

                                @foreach ($categoryList as $category)
                                    <li>
                                        <a href="#">{{ $category->name }}<span
                                                class="icon-right-arrow"></span></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="sidebar__single sidebar__tags">
                            <h3 class="sidebar__title">Tags</h3>
                            <div class="sidebar__tags-list">
                                @php
                                    $tagList = \App\Models\Tag::all();
                                @endphp
                                @foreach ($tagList as $row)
                                    <a href="#">{{ $row->name }}</a>
                                @endforeach
                            </div>
                        </div>
                        <div class="sidebar__single sidebar__comments">
                            <h3 class="sidebar__title">Comments</h3>
                            <ul class="sidebar__comments-list list-unstyled">
                                @foreach ($blogComments as $row)
                                    <li>
                                        <div class="sidebar__comments-icon">
                                            <i class="fas fa-comment"></i>
                                        </div>
                                        <div class="sidebar__comments-text-box">
                                            <p>{{ new \Illuminate\Support\HtmlString(\Illuminate\Support\Str::words($row->comment, 15, '...')) }}</p>
                                        </div>
                                    </li>
                                @endforeach


                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
