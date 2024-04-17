@extends('master')
@section('title')
    {{ $campaign->slug }}
@endsection
@section('content')


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
                                    // dd($campaign);
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
                                <p>
                                    @if ($category)
                                        {{ $category->name }}
                                    @endif
                                </p>
                            </div>
                            <div class="project-details-top__address">
                                <p><i class="fas fa-map-marker"></i>{{ $campaign->address }}, {{ $englishValue }}</p>
                            </div>
                        </div>
                        <h3 class="project-details-top__title">{{ $campaign->title }}</h3>
                        <ul class="list-unstyled project-details-top__list">
                            <li>
                                <div class="project-details-top__list-content">
                                    <h3>BS @php
                                        $currentRaisedFund = \App\Models\Payment::whereHas('campaign', function (
                                            $query,
                                        ) use ($campaign) {
                                            $query->where('id', $campaign->id);
                                        })
                                            ->where('accepted', 1)
                                            ->sum('amount');
                                    @endphp
                                        @if ($currentRaisedFund)
                                            {{ $currentRaisedFund }}
                                        @else
                                            0
                                        @endif

                                    </h3>
                                    <p>Prometido</p>
                                </div>
                            </li>
                            <li>
                                <div class="project-details-top__list-content">
                                    <h3>{{ \App\Models\Payment::where('campaign_id', $campaign->id)->where('accepted', 1)->get()->count() }}
                                    </h3>
                                    <p>{{ __('Patrocinadores') }}</p>
                                </div>
                            </li>
                            <li>
                                <div class="project-details-top__list-content">
                                    <h3>{{ $days_left }}</h3>
                                    <p>{{ __('Días Restantes') }}</p>
                                </div>
                            </li>
                        </ul>
                        <div class="progress-levels">
                            <!--Skill Box-->
                            <div class="progress-box">
                                <div class="inner count-box">
                                    <div class="text">{{ __('Recaudado') }}</div>
                                    <div class="bar">
                                        <div class="bar-innner">
                                            @php
                                                $campaign = \App\Models\Campaign::where('slug', $campaign->slug)->first();

                                                $totalRaised = \App\Models\Payment::whereHas('campaign', function ($query) use (
                                                    $campaign,
                                                ) {
                                                    $query->where('id', $campaign->id);
                                                })
                                                    ->where('accepted', 1)
                                                    ->sum('amount');

                                                $percentRaised = intval(($totalRaised / $campaign->goal) * 100);

                                            @endphp
                                            <div class="skill-percent">
                                                <span class="count-text" data-speed="3000"
                                                    data-stop="{{ $percentRaised }}">0</span>
                                                <span class="percent">%</span>
                                            </div>
                                            <div class="bar-fill" data-percent="{{ $percentRaised }}"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="project-details-top__goal"><span>{{ __('Meta') }}:</span> {{ $campaign->goal }} BS
                        </p>
                        <p class="project-details-top__text">{{ $campaign->short_description }}.</p>
                        <div class="project-details-top__person">
                            <div class="project-details-top__person-img">
                                @if (!empty(\App\Models\User::getUserInfo($campaign->user_id)->profile_photo))
                                    <img src="{{ asset('profile_photo/') }}<?php echo '/' . \App\Models\User::getUserInfo($campaign->user_id)->profile_photo; ?>"
                                        class="personal-avatar rounded-circle" width="100px" height="40px" alt="avatar"
                                        id="profileImagePreview">
                                @else
                                    <img src="{{ asset('149071.png') }}" alt="dummy-avatar"
                                        style="width: 50px; height: 50px;">
                                @endif
                            </div>
                            <div class="project-details-top__person-content">
                                <h5><span>Por</span> {{ \App\Models\User::getUserFullname($campaign->user_id) }}</h5>
                                <p>{{ \App\Models\Campaign::where('user_id', $campaign->user_id)->get()->count() }}
                                    {{ __('Campañas') }} /
                                    {{ \App\Models\Payment::where('campaign_id', $campaign->id)->where('accepted', 1)->get()->count() }}
                                    {{ __('Apoyado/a') }} </p>
                            </div>
                        </div>
                        {{-- <ul class="list-unstyled project-details-top__money">
                            <li>$10</li>
                            <li>$20</li>
                            <li>$30</li>
                        </ul> --}}
                        <br>
                        <div class="project-details-top__quantity-btn-social">
                            {{-- <div class="quantity-box">
                                <button type="button" class="sub"><i class="fa fa-minus"></i></button>
                                <input type="number" id="1" value="00" />
                                <button type="button" class="add"><i class="fa fa-plus"></i></button>
                            </div> --}}
                            <div class="project-details-top__btn-box">
                                @if (!empty($user_session))
                                    <a href="{{ url('back/') }}{{ '/' . $campaign->id }}"
                                        class="thm-btn project-details-top__btn">{{ __('Apoyar este Proyecto') }}</a>
                                @else
                                    <a href="{{ url('signup') }}"
                                        class="thm-btn project-details-top__btn">{{ __('Apoyar este Proyecto') }}</a>
                                @endif

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
                            <li data-tab="#story" class="tab-btn active-btn"><span>{{ __('Historia') }}</span></li>

                            <li data-tab="#updates" class="tab-btn"><span>{{ __('Actualización') }}</span></li>

                        </ul>
                        <div class="tabs-content">
                            <!--tab-->
                            <div class="tab active-tab" id="story">
                                <div class="project-details__tab-box-story">
                                    {!! $campaign->description !!}
                                </div>
                            </div>
                            <!--tab-->

                            <!--tab-->
                            <div class="tab " id="updates">
                                <div class="project-details__updates">
                                    <div class="project-details__updates-single">
                                        <div class="project-details__updates-title-box">
                                            <p class="project-details__updates-sub-title">20 {{ __('Hours Ago') }}</p>
                                            <h5 class="project-details__updates-title">
                                                {{ __('This is the first update of
                                                                                                                                                our
                                                                                                                                                new project') }}
                                            </h5>
                                        </div>
                                        <p class="project-details__updates-text-1">Lorem ipsum dolor sit amet,
                                            consectetur adipiscing elit. Praesent vulputate sed mauris vitae
                                            pellentesque. Nunc ut ullamcorper libero. Aenean fringilla mauris quis
                                            risus laoreet interdum. Quisque imperdiet orci in metus aliquam egestas.
                                            Fusce elit libero, imperdiet nec orci quis, convallis hendrerit nisl.
                                            Cras auctor nec purus at placerat.</p>

                                        <div class="project-details__updates-img">
                                            <img src="assets/images/project/project-details-updates-img-1.jpg"
                                                alt="">
                                        </div>
                                    </div>

                                </div>
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
                <span class="section-title__tagline">{{ __('NEGOCIOS QUE PUEDES APOYAR') }}</span>
                <h2 class="section-title__title">{{ __('Revisa Nuestros  Similares') }} <br> {{ __('Proyectos') }}</h2>
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
                                        // dd($row);
                                        $category = \App\Models\Category::find($row->category_id);
                                        $days_left = $row->days_left();
                                        $amount_prefilled = $row->amount_prefilled();

                                    @endphp
                                    <p>
                                        @if ($category)
                                            {{ $category->name }}
                                        @endif
                                    </p>
                                </div>
                                <h3 class="project-one__title"><a
                                        href="{{ url('project-details/') }}{{ '/' . $row->slug }}">{{ $row->title }}</a>
                                </h3>
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
                                            <div class="text">{{ __('Recaudado') }}</div>
                                            <div class="bar">
                                                <div class="bar-innner">
                                                    <?php
                                                    // Assuming you are in a view file or a blade template
                                                    $campaign = new \App\Models\Campaign(); // Or you retrieve the campaign object from somewhere else

                                                    // Output the percentage raised in your HTML

                                                    ?>
                                                    @foreach ($percentRaisedArray as $projectId => $percentRaised)
                                                        @if ($row->id == $projectId)
                                                            <div class="skill-percent">
                                                                <span class="count-text" data-speed="3000"
                                                                    data-stop="{{ $percentRaised }}">0</span>
                                                                <span class="percent">%</span>
                                                            </div>


                                                            <div class="bar-fill" data-percent="{{ $percentRaised }}">
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="project-one__goals">
                                    <p class="project-one__goals-one">{{ __('Logrado') }}:<span>BS @foreach ($totalRaisedArray as $projectId => $Raised)
                                                @if ($row->id == $projectId)
                                                    {{ $Raised }}
                                                @endif
                                            @endforeach
                                        </span></p>
                                    <p class="project-one__goals-one">{{ __('Meta') }}:<span>BS
                                            {{ $row->goal }}</span></p>
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
