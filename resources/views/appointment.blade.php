@extends('master')
@section('title')
    {{ $campaign->slug }}
@endsection
@section('content')
<style>
    .chat-box .toogle-bar {
        display: none;
    }

    .chat-box .chat-menu {
        max-width: 340px;
    }

    .chat-box .people-list .search {
        position: relative;
    }

    .chat-box .people-list .search .form-control {
        background-color: #f1f4fb;
        border: 1px solid #f6f7fb;
    }

    .chat-box .people-list .search .form-control::-webkit-input-placeholder {
        color: #aaaaaa;
    }

    .chat-box .people-list .search .form-control::-moz-placeholder {
        color: #aaaaaa;
    }

    .chat-box .people-list .search .form-control:-ms-input-placeholder {
        color: #aaaaaa;
    }

    .chat-box .people-list .search .form-control::-ms-input-placeholder {
        color: #aaaaaa;
    }

    .chat-box .people-list .search .form-control::placeholder {
        color: #aaaaaa;
    }

    .chat-box .people-list .search i {
        position: absolute;
        right: 10px;
        top: 10px;
        font-size: 14px;
        color: #e8ebf2;
    }

    .chat-box .people-list ul {
        padding: 0;
        list-style-type: none;
    }

    .chat-box .people-list ul li {
        padding-bottom: 20px;
    }

    .chat-box .people-list ul li:last-child {
        padding-bottom: 0;
    }

    .chat-box .user-image {
        float: left;
        width: 52px;
        height: 52px;
        margin-right: 5px;
    }

    .chat-box .about {
        float: left;
        margin-top: 5px;
        padding-left: 10px;
    }

    .chat-box .about .name {
        color: #2a3142;
        letter-spacing: 1px;
        font-weight: 600;
    }

    .chat-box .status {
        color: #aaaaaa;
        letter-spacing: 1px;
        font-size: 12px;
        margin-top: 5px;
    }

    .chat-box .status .chat-status {
        font-weight: 600;
        color: #313131;
    }

    .chat-box .status p {
        font-size: 14px;
    }

    .chat-box .chat-right-aside .chat .chat-header {
        padding: 15px;
        border-bottom: 1px solid #f6f7fb;
    }

    .chat-box .chat-right-aside .chat .chat-header img {
        float: left;
        width: 50px;
        height: 50px;
        -webkit-box-shadow: 1px 1px 4px 1px #e8ebf2;
        box-shadow: 1px 1px 4px 1px #e8ebf2;
    }

    .chat-box .chat-right-aside .chat .chat-header .chat-menu-icons {
        margin-top: 15px;
    }

    .chat-box .chat-right-aside .chat .chat-header .chat-menu-icons li {
        margin-right: 24px;
    }

    .chat-box .chat-right-aside .chat .chat-header .chat-menu-icons li a i {
        color: #777777;
        font-size: 25px;
        cursor: pointer;
    }

    .chat-box .chat-right-aside .chat .chat-msg-box {
        padding: 20px;
        overflow-y: auto;
        height: 560px;
        margin-bottom: 90px;
    }

    .chat-box .chat-right-aside .chat .chat-msg-box .chat-user-img {
        margin-top: -35px;
    }

    .chat-box .chat-right-aside .chat .chat-msg-box .message-data {
        margin-bottom: 10px;
    }

    .chat-box .chat-right-aside .chat .chat-msg-box .message-data-time {
        letter-spacing: 1px;
        font-size: 12px;
        color: #aaaaaa;
        font-family: work-Sans, sans-serif;
    }

    .chat-box .chat-right-aside .chat .chat-msg-box .message {
        color: #2a3142;
        padding: 20px;
        line-height: 1.9;
        letter-spacing: 1px;
        font-size: 14px;
        margin-bottom: 30px;
        width: 50%;
        position: relative;
    }

    .chat-box .chat-right-aside .chat .chat-msg-box .my-message {
        border: 1px solid #f6f7fb;
        border-radius: 10px;
        border-top-left-radius: 0;
    }

    .chat-box .chat-right-aside .chat .chat-msg-box .other-message {
        background-color: #f6f6f6;
        border-radius: 10px;
        border-top-right-radius: 0;
    }

    .chat-box .chat-right-aside .chat .chat-message {
        padding: 20px;
        border-top: 1px solid #f1f4fb;
        position: absolute;
        width: calc(100% - 15px);
        background-color: #fff;
        bottom: 0;
    }

    .chat-box .chat-right-aside .chat .chat-message .smiley-box {
        background: #eff0f1;
        padding: 10px;
        display: block;
        border-radius: 4px;
        margin-right: 0.5rem;
    }

    .chat-box .chat-right-aside .chat .chat-message .text-box {
        position: relative;
    }

    .chat-box .chat-right-aside .chat .chat-message .text-box .input-txt-bx {
        height: 50px;
        border: 2px solid #4466f2;
        padding-left: 18px;
        font-size: 12px;
        letter-spacing: 1px;
    }

    .chat-box .chat-right-aside .chat .chat-message .text-box i {
        position: absolute;
        right: 20px;
        top: 20px;
        font-size: 20px;
        color: #e8ebf2;
        cursor: pointer;
    }

    .chat-box .chat-right-aside .chat .chat-message .text-box .btn {
        font-size: 16px;
        font-weight: 500;
    }

    .chat-box .chat-menu {
        border-left: 1px solid #f6f7fb;
    }

    .chat-box .chat-menu .tab-pane {
        padding: 0 15px;
    }

    .chat-box .chat-menu ul li .about .status i {
        font-size: 10px;
    }

    .chat-box .chat-menu .user-profile {
        margin-top: 30px;
    }

    .chat-box .chat-menu .user-profile .user-content h5 {
        margin: 25px 0;
    }

    .chat-box .chat-menu .user-profile .user-content hr {
        margin: 25px 0;
    }

    .chat-box .chat-menu .user-profile .user-content p {
        font-size: 16px;
    }

    .chat-box .chat-menu .user-profile .image {
        position: relative;
    }

    .chat-box .chat-menu .user-profile .image .icon-wrapper {
        position: absolute;
        bottom: 0;
        left: 55%;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        height: 35px;
        width: 35px;
        border-radius: 50%;
        background-color: #fff;
        cursor: pointer;
        overflow: hidden;
        margin: 0 auto;
        font-size: 14px;
        -webkit-box-shadow: 1px 1px 3px 1px #f6f7fb;
        box-shadow: 1px 1px 3px 1px #f6f7fb;
    }

    .chat-box .chat-menu .user-profile .image .avatar img {
        border-radius: 50%;
        border: 5px solid #f6f7fb;
    }

    .chat-box .chat-menu .user-profile .border-right {
        border-right: 1px solid #f6f7fb;
    }

    .chat-box .chat-menu .user-profile .follow {
        margin-top: 0;
    }

    .chat-box .chat-menu .user-profile .follow .follow-num {
        font-size: 22px;
        color: #000;
    }

    .chat-box .chat-menu .user-profile .follow span {
        color: #1b252a;
        font-size: 14px;
        letter-spacing: 1px;
    }

    .chat-box .chat-menu .user-profile .social-media a {
        color: #aaaaaa;
        font-size: 15px;
        padding: 0 7px;
    }

    .chat-box .chat-menu .user-profile .chat-profile-contact p {
        font-size: 14px;
        color: #aaaaaa;
    }

    .chat-box .chat-menu .nav {
        margin-bottom: 20px;
    }

    .chat-box .chat-menu .nav-tabs .nav-item {
        width: 33.33%;
    }

    .chat-box .chat-menu .nav-tabs .nav-item a {
        padding: 15px !important;
        color: #aaaaaa !important;
        letter-spacing: 1px;
        font-size: 14px;
        font-weight: 600;
        height: 80px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
    }

    .chat-box .chat-menu .nav-tabs .nav-item .material-border {
        border-width: 1px;
        border-color: #4466f2;
    }

    .chat-box .chat-menu .nav-tabs .nav-item .nav-link.active {
        color: #000 !important;
    }

    .chat-box .chat-history .call-content {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        min-width: 300px;
    }

    .chat-box .chat-history .total-time h2 {
        font-size: 50px;
        color: #eff0f1;
        font-weight: 600;
        margin-bottom: 30px;
    }

    .chat-box .chat-history .receiver-img {
        margin-top: 55px;
    }

    .chat-box .chat-history .receiver-img img {
        border-radius: 5px;
    }

    .chat-box .chat-history .call-icons {
        margin-bottom: 35px;
    }

    .chat-box .chat-history .call-icons ul li {
        width: 60px;
        height: 60px;
        border: 1px solid #f6f7fb;
        border-radius: 50%;
        padding: 12px;
    }

    .chat-box .chat-history .call-icons ul li+li {
        margin-left: 10px;
    }

    .chat-box .chat-history .call-icons ul li a {
        color: #999;
        font-size: 25px;
    }

    .chat-left-aside>.media {
        margin-bottom: 15px;
    }

    .chat-left-aside .people-list {
        height: 625px;
    }

    .chat-left-aside ul li {
        position: relative;
    }

    .status-circle {
        width: 10px;
        height: 10px;
        position: absolute;
        top: 40px;
        left: 40px;
        border-radius: 50%;
        border: 2px solid #fff;
    }

    .away {
        background-color: #ff9f40;
    }

    .online {
        background-color: #22af47;
    }

    .offline {
        background-color: #ff5370;
    }

    .chat-container .aside-chat-left {
        width: 320px;
    }

    .chat-container .chat-right-aside {
        width: 320px;
    }

    .call-chat-sidebar {
        max-width: 320px;
    }

    .call-chat-sidebar .card .card-body,
    .chat-body .card .card-body {
        padding: 15px;
    }
</style>
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
                                                $campaign = \App\Models\Campaign::where(
                                                    'slug',
                                                    $campaign->slug,
                                                )->first();

                                                $totalRaised = \App\Models\Payment::whereHas('campaign', function (
                                                    $query,
                                                ) use ($campaign) {
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
                                    <a class="btn btn-sm btn-dark"
                                        onclick="openChat('{{ $campaign->user_id }}', '{{ \App\Models\User::getUserInfo($campaign->user_id)->name }}', '{{ !empty(\App\Models\User::getUserInfo($campaign->user_id)->profile_photo) ? asset('profile_photo/' . \App\Models\User::getUserInfo($campaign->user_id)->profile_photo) : asset('149071.png') }}','{{ \App\Models\User::getUserInfo($campaign->user_id)->last_seen }}');">Chat</a>



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
        <div class="container" style="margin-top: 10px">
            <div class="col call-chat-body">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row chat-box">
                            <!-- Chat right side start-->
                            <div class="col pe-0 chat-right-aside">
                                <!-- chat start-->
                                <div class="chat" style="display: none">
                                    <!-- chat-header start-->
                                    <div class="chat-header clearfix"><img class="rounded-circle"
                                            src="../assets/images/user/8.jpg" alt="">
                                        <div class="about">
                                            <div class="name"> <span
                                                    class="font-primary f-12"></span></div>
                                            <div class="status digits"></div>
                                        </div>
                                        <ul
                                            class="list-inline float-start float-sm-end chat-menu-icons">
                                            <li class="list-inline-item"><a href="#"><i
                                                        class="icon-search"></i></a>
                                            </li>
                                            <li class="list-inline-item"><a href="#"><i
                                                        class="icon-clip"></i></a>
                                            </li>
                                            <li class="list-inline-item"><a href="#"><i
                                                        class="icon-headphone-alt"></i></a></li>
                                            <li class="list-inline-item"><a href="#"><i
                                                        class="icon-video-camera"></i></a></li>
                                            <li class="list-inline-item toogle-bar"><a
                                                    href="#"><i class="icon-menu"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- chat-header end-->

                                    <div class="chat-history chat-msg-box custom-scrollbar">
                                        <ul id="messages-container" style="list-style-type: none;">
                                            <!-- Messages will be dynamically added here -->
                                        </ul>
                                    </div>

                                    <!-- end chat-history-->
                                    <div class="chat-message clearfix">
                                        <div class="row">
                                            <div class="col-xl-12 d-flex">
                                                <form id="chat-form">
                                                    @csrf
                                                    <input type="hidden" name="sender_id"
                                                        value="{{ Session::get('LoggedIn') }}">
                                                    <input type="hidden" class="receiver_id"
                                                        name="receiver_id" value="">
                                                    <div class="input-group text-box">
                                                        <input class="form-control input-txt-bx"
                                                            id="message" type="text"
                                                            name="message"
                                                            placeholder="Type a message...">
                                                        <button
                                                            class="btn btn-primary input-group-text"
                                                            type="submit">{{ __('SEND') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- end chat-message-->
                                    <!-- chat end-->
                                    <!-- Chat right side ends-->
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('assets/vendors/jquery/jquery-3.6.0.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                // Submit chat message form using AJAX
                $('#chat-form').submit(function(e) {
                    e.preventDefault();
                    sendMessage();
                });


            });

            function fetchChatMessages() {
                let receiverId = $('.receiver_id').val();
                let senderId = "{{ Session::get('LoggedIn') }}";
                $.ajax({
                    url: "{{ route('chat.messages') }}",
                    method: "GET",
                    data: {
                        sender_id: senderId,
                        receiver_id: receiverId
                    },
                    success: function(response) {
                        // Log the response for debugging
                        console.log(response);

                        // Display all messages received from the server
                        displayMessages(response.messages, senderId);

                        // Call fetchChatMessages again after a short delay (e.g., 5 seconds)
                        setTimeout(fetchChatMessages, 5000); // 5000 milliseconds = 5 seconds
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);

                        // Retry fetching messages after a short delay (e.g., 5 seconds)
                        setTimeout(fetchChatMessages, 5000); // 5000 milliseconds = 5 seconds
                    }
                });
            }

            // Initial call to fetchChatMessages
            fetchChatMessages();


            function openChat(receiverId, receiverName, receiverImage, lastSeen) {
                // Show the chat section
                $('.chat').show();

                // Set the receiver_id
                $('.receiver_id').val(receiverId);

                // Update the chat header name
                $('.chat-header .name').text(receiverName);

                // Update the chat header image
                if (receiverImage && receiverImage.trim() !== '') {
                    $('.chat-header img').attr('src', receiverImage);
                    $('.chat-header img').css({
                        'width': '40px',
                        'height': '40px'
                    });
                } else {
                    $('.chat-header img').attr('src', '{{ asset('149071.png') }}');
                    $('.chat-header img').css({
                        'width': '40px',
                        'height': '40px'
                    });
                }


                // Convert the timestamp to a Date object
                var lastSeenDate = new Date(lastSeen);

                // Format the last seen time
                var lastSeenFormatted = formatDate(lastSeenDate);

                // Update the last seen status
                $('.chat-header .status.digits').text('Last Seen ' + lastSeenFormatted);

                // Fetch messages for the selected receiver
                fetchChatMessages(receiverId);
            }


            // Function to format date into human-readable format
            function formatDate(date) {
                var hours = date.getHours();
                var minutes = date.getMinutes();
                var ampm = hours >= 12 ? 'PM' : 'AM';
                hours = hours % 12;
                hours = hours ? hours : 12; // Handle midnight (0 hours)
                minutes = minutes < 10 ? '0' + minutes : minutes;
                var strTime = hours + ':' + minutes + ' ' + ampm;
                // Concatenate date with time
                var formattedDateTime = date.toLocaleDateString() + ' ' + strTime;
                return formattedDateTime;
            }


            function sendMessage() {
                let message = $('#message').val();
                let receiverId = $('.receiver_id').val();

                $.ajax({
                    url: "{{ route('chat.send') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        sender_id: "{{ Session::get('LoggedIn') }}",
                        receiver_id: receiverId,
                        message: message
                    },
                    success: function(response) {
                        $('#message').val(''); // Clear input field after sending message
                        fetchChatMessages(receiverId); // Fetch updated chat messages
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }

            function displayMessages(messages, senderId) {
                // Clear previous messages
                $('.chat-history ul').empty();

                // Iterate through each message
                messages.forEach(function(message) {
                    // Determine the CSS class for the message based on the sender
                    let messageClass = message.sender_id == senderId ? 'my-message' : 'other-message';

                    // Determine the position class for the message
                    let positionClass = message.sender_id == senderId ? 'float-start' : 'float-end';

                    // Determine the background color class for the message container
                    let bgColorClass = message.sender_id == senderId ? 'bg-primary' : 'bg-secondary';

                    // Format the message timestamp
                    let messageTime = new Date(message.created_at).toLocaleTimeString([], {
                        hour: '2-digit',
                        minute: '2-digit'
                    });

                    // Determine the profile photo URL based on the sender and receiver
                    let profilePhotoUrl;

                    // Handle null sender_photo gracefully (use default profile image)
                    if (message.sender_photo === null) {
                        profilePhotoUrl = '{{ asset('149071.png') }}';
                    } else {
                        // Construct profile photo URL with error handling
                        try {
                            profilePhotoUrl = '{{ asset('profile_photo/') }}' + '/' + message.sender_photo;
                        } catch (error) {
                            console.error('Error constructing sender profile photo URL:', error);
                            profilePhotoUrl = '{{ asset('149071.png') }}'; // Use default if error occurs
                        }
                    }

                    let messageHtml = `
        <li>
          <div class="message ${messageClass} ">
            <img class="rounded-circle chat-user-img img-30 ${positionClass}" src="${profilePhotoUrl}" alt="" style="width: 40px; height: 40px;">
            <div class="message-data ${message.sender_id != senderId ? 'pull-right' : 'text-end'}">
              <span class="message-data-time">${messageTime}</span>
            </div>
            <div class="message-content">
              ${message.message}
            </div>
          </div>
        </li>
        `;

                    // Append the message to the chat history container
                    $('.chat-history ul').append(messageHtml);
                });
            }
        </script>
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
