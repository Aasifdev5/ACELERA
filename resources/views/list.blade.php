@extends('master')
@section('title')
    {{ __('Explorar') }} || Proyectos
@endsection
@section('content')


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
                                                <p>{{ $days_left }} {{ __('Días Restantes') }}</p>
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


                                                                <div class="bar-fill"
                                                                    data-percent="{{ $percentRaised }}"></div>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="project-one__goals">
                                        <p class="project-one__goals-one"><span>BS  @foreach ($totalRaisedArray as $projectId => $Raised)
                                            @if ($row->id == $projectId)
                                                {{ $Raised }}
                                            @endif
                                        @endforeach
                                            </span>
                                            <br>{{ __('Meta de') }} BS {{ $row->goal }}
                                        </p>
                                        <p class="project-one__goals-one"><span class="odometer project-one__plus"
                                                data-count="{{ \App\Models\Payment::where('campaign_id', $row->id)->where('accepted', 1)->get()->count() }}"></span>
                                            <br>{{ __('Patrocinadores que Hemos Obtenido') }}
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
