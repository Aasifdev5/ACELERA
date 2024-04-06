@extends('master')
@section('title')
    {{ $campaign->slug }}
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
                    <li><a href="index.html">Home</a></li>
                    <li><span>/</span></li>
                    <li>Project</li>
                </ul>
                <h2>Project Details</h2>
            </div>
        </div>
    </section>
    <!--Page Header End-->

    <!--Project Details Top Start-->
    <section class="project-details-top">
        <div class="container">
            <div class="row">

                <div class="col-xl-7 col-lg-6">
                    <div class="project-details-top__left">
                        <div class="project-details-top__img">
                            <img src="{{ getImageFile($campaign->image) }}" alt="">
                            <div class="project-details-top__icon">
                                <i class="far fa-heart"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6">
                    <div class="project-details-top__right">
                        <div class="project-details-top__tag-address">
                            <div class="project-details-top__tag">
                                @php
                                    $category = \App\Models\Category::find($campaign->category_id);
                                    $days_left = $campaign->days_left();
                                    $amount_prefilled = $campaign->amount_prefilled();
                                    $countryNameJson = \App\Models\Country::where('id', $campaign->country_id)
                                        ->pluck('name')
                                        ->first();
                                    $countryData = json_decode($countryNameJson, true);

                                    // Access the "en" value
                                    $englishValue = isset($countryData['en']) ? $countryData['en'] : '';

                                @endphp
                                <p>{{ $category->name }}</p>
                            </div>
                            <div class="project-details-top__address">
                                <p><i class="fas fa-map-marker"></i>{{ $campaign->address }}, {{ $englishValue }}</p>
                            </div>
                        </div>
                        <h3 class="project-details-top__title">{{ $campaign->title }}</h3>
                        <ul class="list-unstyled project-details-top__list">
                            <li>
                                <div class="project-details-top__list-content">
                                    <h3>$@if ($amount_prefilled)
                                            {{ implode(',', $amount_prefilled) }}
                                        @else
                                            No amount prefilled
                                        @endif
                                    </h3>
                                    <p>Pledged</p>
                                </div>
                            </li>
                            <li>
                                <div class="project-details-top__list-content">
                                    <h3>80</h3>
                                    <p>Backers</p>
                                </div>
                            </li>
                            <li>
                                <div class="project-details-top__list-content">
                                    <h3>{{ $days_left }}</h3>
                                    <p>Days Left</p>
                                </div>
                            </li>
                        </ul>
                        <div class="progress-levels">
                            <!--Skill Box-->
                            <div class="progress-box">
                                <div class="inner count-box">
                                    <div class="text">Raised</div>
                                    <div class="bar">
                                        <div class="bar-innner">
                                            <div class="skill-percent">
                                                <span class="count-text" data-speed="3000" data-stop="70">0</span>
                                                <span class="percent">%</span>
                                            </div>
                                            <div class="bar-fill" data-percent="70"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="project-details-top__goal"><span>Goal:</span> {{ $campaign->goal }} USD</p>
                        <p class="project-details-top__text">{{ $campaign->short_description }}.</p>
                        <div class="project-details-top__person">
                            <div class="project-details-top__person-img">
                                <img src="assets/images/project/project-details-top-person-img-1.jpg" alt="">
                            </div>
                            <div class="project-details-top__person-content">
                                <h5><span>by</span>Kevin Martin</h5>
                                <p>2 Campaigns / 10 Backed</p>
                            </div>
                        </div>
                        <ul class="list-unstyled project-details-top__money">
                            <li>$10</li>
                            <li>$20</li>
                            <li>$30</li>
                        </ul>
                        <div class="project-details-top__quantity-btn-social">
                            <div class="quantity-box">
                                <button type="button" class="sub"><i class="fa fa-minus"></i></button>
                                <input type="number" id="1" value="00" />
                                <button type="button" class="add"><i class="fa fa-plus"></i></button>
                            </div>
                            <div class="project-details-top__btn-box">
                                <a href="#" class="thm-btn project-details-top__btn">Back this
                                    Project</a>
                            </div>
                            <div class="project-details-top__social">
                                <a href="{{ $general_setting->footer_twitter_link }}"><i class="fab fa-twitter"></i></a>
                                <a href="{{ $general_setting->footer_fb_link }}"><i class="fab fa-facebook"></i></a>
                                <a href="{{ $general_setting->footer_instagram_link }}"><i
                                        class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Project Details Top End-->

    <!--Project Details Bottom Start-->
    <section class="project-details-bottom">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7">
                    <div class="project-details__tab-box tabs-box">
                        <ul class="tab-buttons clearfix list-unstyled clearfix">
                            <li data-tab="#story" class="tab-btn active-btn"><span>Story</span></li>
                            <li data-tab="#faqs" class="tab-btn"><span>FAQs</span></li>
                            <li data-tab="#updates" class="tab-btn"><span>Updates</span></li>
                            <li data-tab="#reviews" class="tab-btn"><span>Reviews (2)</span></li>
                        </ul>
                        <div class="tabs-content">
                            <!--tab-->
                            <div class="tab active-tab" id="story">
                                <div class="project-details__tab-box-story">
                                    {!! $campaign->description !!}
                                </div>
                            </div>
                            <!--tab-->
                            <div class="tab " id="faqs">
                                <div class="project-details__faq">
                                    <div class="accrodion-grp faq-one-accrodion" data-grp-name="faq-one-accrodion-1">
                                        <div class="accrodion">
                                            <div class="accrodion-title">
                                                <h4>Is my campaign allowed on qrowd?</h4>
                                            </div>
                                            <div class="accrodion-content">
                                                <div class="inner">
                                                    <p>There are many variations of passages the majority have
                                                        suffered alteration in some fo injected humour, or
                                                        randomised words believable. Cras malesuada nec magna eu
                                                        blandit. Nam sed efficitur ante.</p>
                                                </div><!-- /.inner -->
                                            </div>
                                        </div>
                                        <div class="accrodion active">
                                            <div class="accrodion-title">
                                                <h4>How to soft launch your campaign</h4>
                                            </div>
                                            <div class="accrodion-content">
                                                <div class="inner">
                                                    <p>There are many variations of passages the majority have
                                                        suffered alteration in some fo injected humour, or
                                                        randomised words believable. Cras malesuada nec magna eu
                                                        blandit. Nam sed efficitur ante.</p>
                                                </div><!-- /.inner -->
                                            </div>
                                        </div>
                                        <div class="accrodion">
                                            <div class="accrodion-title">
                                                <h4>How to turn visitors into contributors</h4>
                                            </div>
                                            <div class="accrodion-content">
                                                <div class="inner">
                                                    <p>There are many variations of passages the majority have
                                                        suffered alteration in some fo injected humour, or
                                                        randomised words believable. Cras malesuada nec magna eu
                                                        blandit. Nam sed efficitur ante.</p>
                                                </div><!-- /.inner -->
                                            </div>
                                        </div>
                                        <div class="accrodion">
                                            <div class="accrodion-title">
                                                <h4>How can i find my campaign?</h4>
                                            </div>
                                            <div class="accrodion-content">
                                                <div class="inner">
                                                    <p>There are many variations of passages the majority have
                                                        suffered alteration in some fo injected humour, or
                                                        randomised words believable. Cras malesuada nec magna eu
                                                        blandit. Nam sed efficitur ante.</p>
                                                </div><!-- /.inner -->
                                            </div>
                                        </div>
                                        <div class="accrodion">
                                            <div class="accrodion-title">
                                                <h4>Simple tools that get big results</h4>
                                            </div>
                                            <div class="accrodion-content">
                                                <div class="inner">
                                                    <p>There are many variations of passages the majority have
                                                        suffered alteration in some fo injected humour, or
                                                        randomised words believable. Cras malesuada nec magna eu
                                                        blandit. Nam sed efficitur ante.</p>
                                                </div><!-- /.inner -->
                                            </div>
                                        </div>
                                        <div class="accrodion last-chiled">
                                            <div class="accrodion-title">
                                                <h4>Customer loyalty</h4>
                                            </div>
                                            <div class="accrodion-content">
                                                <div class="inner">
                                                    <p>There are many variations of passages the majority have
                                                        suffered alteration in some fo injected humour, or
                                                        randomised words believable. Cras malesuada nec magna eu
                                                        blandit. Nam sed efficitur ante.</p>
                                                </div><!-- /.inner -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--tab-->
                            <div class="tab " id="updates">
                                <div class="project-details__updates">
                                    <div class="project-details__updates-single">
                                        <div class="project-details__updates-title-box">
                                            <p class="project-details__updates-sub-title">20 Hours Ago</p>
                                            <h5 class="project-details__updates-title">This is the first update of
                                                our
                                                new project</h5>
                                        </div>
                                        <p class="project-details__updates-text-1">Lorem ipsum dolor sit amet,
                                            consectetur adipiscing elit. Praesent vulputate sed mauris vitae
                                            pellentesque. Nunc ut ullamcorper libero. Aenean fringilla mauris quis
                                            risus laoreet interdum. Quisque imperdiet orci in metus aliquam egestas.
                                            Fusce elit libero, imperdiet nec orci quis, convallis hendrerit nisl.
                                            Cras auctor nec purus at placerat.</p>
                                        <p class="project-details__updates-text-2">Quisque consectetur, lectus in
                                            ullamcorper tempus, dolor arcu suscipit elit, id laoreet tortor justo
                                            nec arcu. Nam eu dictum ipsum. Morbi in mi eu urna placerat finibus a
                                            vel neque. Nulla in ex at mi viverra sagittis ut non erat. Praesent nec
                                            congue elit.</p>
                                        <div class="project-details__updates-img">
                                            <img src="assets/images/project/project-details-updates-img-1.jpg"
                                                alt="">
                                        </div>
                                    </div>
                                    <div class="project-details__updates-single mrb-0">
                                        <div class="project-details__updates-title-box">
                                            <p class="project-details__updates-sub-title">20 Hours Ago</p>
                                            <h5 class="project-details__updates-title">This is the first update of
                                                our
                                                new project</h5>
                                        </div>
                                        <p class="project-details__updates-text-1">Lorem ipsum dolor sit amet,
                                            consectetur adipiscing elit. Praesent vulputate sed mauris vitae
                                            pellentesque. Nunc ut ullamcorper libero. Aenean fringilla mauris quis
                                            risus laoreet interdum. Quisque imperdiet orci in metus aliquam egestas.
                                            Fusce elit libero, imperdiet nec orci quis, convallis hendrerit nisl.
                                            Cras auctor nec purus at placerat.</p>
                                        <p class="project-details__updates-text-2">Quisque consectetur, lectus in
                                            ullamcorper tempus, dolor arcu suscipit elit, id laoreet tortor justo
                                            nec arcu. Nam eu dictum ipsum. Morbi in mi eu urna placerat finibus a
                                            vel neque. Nulla in ex at mi viverra sagittis ut non erat. Praesent nec
                                            congue elit.</p>
                                        <div class="project-details__updates-img">
                                            <img src="assets/images/project/project-details-updates-img-2.jpg"
                                                alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab " id="reviews">
                                <div class="project-details__reviews">
                                    <div class="project-details__review-one">
                                        <h3 class="project-details__review-title">2 comments</h3>
                                        <div class="project-details__review-single">
                                            <div class="project-details__review-image">
                                                <img src="assets/images/project/project-details-review-img-1-1.jpg"
                                                    alt="">
                                            </div>
                                            <div class="project-details__review-content">
                                                <h3>Kevin Martin</h3>
                                                <p>Mauris non dignissim purus, ac commodo diam. Donec sit amet
                                                    lacinia nulla.
                                                    Aliquam quis purus in justo pulvinar tempor. Aliquam tellus
                                                    nulla,
                                                    sollicitudin at euismod.</p>
                                                <div class="project-details__review-star">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="project-details__review-single">
                                            <div class="project-details__review-image">
                                                <img src="assets/images/project/project-details-review-img-1-2.jpg"
                                                    alt="">
                                            </div>
                                            <div class="project-details__review-content">
                                                <h3>Sarah Albert</h3>
                                                <p>Mauris non dignissim purus, ac commodo diam. Donec sit amet
                                                    lacinia nulla.
                                                    Aliquam quis purus in justo pulvinar tempor. Aliquam tellus
                                                    nulla,
                                                    sollicitudin at euismod.</p>
                                                <div class="project-details__review-star">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="project-details__review-form">
                                        <h3 class="project-details__review-form-title">Submit Review</h3>
                                        <div class="project-details__review-form-rate-box">
                                            <p>Rate this Product?</p>
                                            <div class="project-details__review-rate">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                        <form action="https://qrowd-html.vercel.app/main-html/assets/inc/sendemail.php"
                                            class="project-details__review-form-one contact-form-validated"
                                            novalidate="novalidate">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="project-details__review-form-input-box text-message-box">
                                                        <textarea name="message" placeholder="Write a Comment"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="project-details__review-form-input-box">
                                                        <input type="text" placeholder="Your Name" name="name">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="project-details__review-form-input-box">
                                                        <input type="email" placeholder="Email Address" name="email">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="project-details__review-form-btn-box">
                                                        <button type="submit"
                                                            class="thm-btn project-details__review-form-btn">Submit
                                                            Review</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="project-details__right">
                        <div class="project-details__rewards">
                            <h5 class="project-details__rewards-title">Rewards</h5>
                            <p class="project-details__rewards-price"><span>$100</span> or More</p>
                            <div class="project-details__rewards-img">
                                <img src="assets/images/project/project-details-rewards-img.jpg" alt="">
                            </div>
                            <p class="project-details__rewards-text-1">Reward description goes here. Lorem ipsum
                                dolor sit amet, piscing elit. Vivamus dictum congue nunc.</p>
                            <p class="project-details__rewards-date">20 July, 2022</p>
                            <p class="project-details__rewards-delivery">Estimated Delivery</p>
                            <ul class="list-unstyled project-details__rewards-bottom">
                                <li>
                                    <div class="icon">
                                        <i class="fas fa-user-circle"></i>
                                    </div>
                                    <div class="text">
                                        <p>1 Backers</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon">
                                        <i class="fas fa-trophy"></i>
                                    </div>
                                    <div class="text">
                                        <p>1 Backers</p>
                                    </div>
                                </li>
                            </ul>
                            <div class="project-details__rewards-btn-box">
                                <a href="project-details.html" class="thm-btn project-details__rewards-btn">Select a
                                    Reward</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Project Details Bottom End-->

    <!--Similar Project Start-->
    <section class="similar-project">
        <div class="container">
            <div class="section-title text-center">
                <span class="section-title__tagline">Businesses You Can Back</span>
                <h2 class="section-title__title">Checkout Our Similar <br> Projects</h2>
            </div>
            <div class="row">
                <!--Project One Single Start-->
                @foreach ($projects as $row)
                    <div class="col-xl-4 col-lg-4 wow fadeInUp" data-wow-delay="100ms">
                        <div class="project-one__single">
                            <div class="project-one__img-box">
                                <div class="project-one__img">
                                    <img src="{{ getImageFile($row->image) }}" alt="">
                                </div>
                                <div class="project-one__icon">
                                    <i class="far fa-heart"></i>
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
                                <h3 class="project-one__title"><a
                                        href="{{ url('project-details/') }}{{ '/' . $row->slug }}">{{ $row->title }}</a>
                                </h3>
                                <div class="project-one__remaing">
                                    <div class="icon">
                                        <i class="fa fa-clock"></i>
                                    </div>
                                    <div class="text">
                                        <p>{{ $days_left }} Days Remaining</p>
                                    </div>
                                </div>
                                <div class="progress-levels">
                                    <!--Skill Box-->
                                    <div class="progress-box">
                                        <div class="inner count-box">
                                            <div class="text">Raised</div>
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
                                    <p class="project-one__goals-one">Achieved:<span>$ @if ($amount_prefilled)
                                                {{ implode(',', $amount_prefilled) }}
                                            @else
                                                No amount prefilled
                                            @endif
                                        </span></p>
                                    <p class="project-one__goals-one">Goal:<span>${{ $row->goal }}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!--Similar Project End-->
@endsection
