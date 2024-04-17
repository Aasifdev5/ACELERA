@extends('master')
@section('title')
    {{ $blog_details->slug }}
@endsection
@section('content')
    @php
        $general_setting = getApplicationsettings();
    @endphp


    <!--News Details Start-->
    <section class="news-details">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7">
                    <div class="news-details__left">
                        <div class="news-details__img">
                            <img src="{{ getImageFile($blog_details->image_path) }}" alt="">
                            <div class="news-details__date">
                                <p>{{ \Carbon\Carbon::parse($blog_details->created_at)->format('d') }}</p>
                                <span>{{ \Carbon\Carbon::parse($blog_details->created_at)->format('F') }}</span>
                            </div>
                        </div>
                        <div class="news-details__content">
                            <ul class="list-unstyled news-details__meta">
                                <li><a href="#"><i class="fas fa-user-circle"></i>{{ __('por Administrador') }} </a>
                                </li>
                                <li><a href="#"><i class="fas fa-comments"></i> {{ @$blogComments->count() }}
                                    {{ __('Comentarios') }} </a>
                                </li>
                            </ul>
                            <h3 class="news-details__title">{{ $blog_details->title }}</h3>
                            <p class="news-details__text-1">{!! $blog_details->details !!}</p>
                        </div>
                        <div class="news-details__bottom">
                            <p class="news-details__tags">
                                <span>{{ __('Etiquetas') }}</span>
                                @php
                                    $tagNames = [];
                                    if (!empty($blog_details->id)) {
                                        $tagNames = \DB::table('blog_tags')
                                            ->join('tags', 'blog_tags.tag_id', '=', 'tags.id')
                                            ->where('blog_tags.blog_id', $blog_details->id)
                                            ->pluck('tags.name')
                                            ->toArray();
                                    }
                                @endphp

                                @foreach ($tagNames as $tagName)
                                    <a href="#">{{ $tagName }}</a>
                                @endforeach


                            </p>
                            <div class="news-details__social-list">
                                <a href="{{ $general_setting->footer_twitter_link }}"><i class="fab fa-twitter"></i></a>
                                <a href="{{ $general_setting->footer_fb_link }}"><i class="fab fa-facebook"></i></a>
                                <a href="{{ $general_setting->footer_instagram_link }}"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>

                        <!-- Customer Comments and Reply Section-->
                        <div class="blog-comments-section mt-4">
                            <div class="appendCommentList">
                                <h6 class="blog-comment-title">{{ @$blogComments->count() }} {{ __('Comentarios') }}</h6>
                                <br>
                                @foreach ($blogComments as $blogComment)
                                    <!-- Main Comment -->
                                    <div class="main-comment mb-4">
                                        <div class="blog-comment-item d-flex align-items-start">
                                            <div class="comment-author-img radius-50 overflow-hidden me-3">
                                                @if (!empty($blogComment->user->image_path))
                                                    <img src="{{ getImageFile($blogComment->user->image_path) }}"
                                                        alt="avatar">
                                                @else
                                                    <img src="{{ asset('149071.png') }}" alt="dummy-avatar"
                                                        style="width: 50px; height: 50px;">
                                                @endif
                                            </div>
                                            <div class="author-details flex-grow-1">
                                                <h6 class="author-name font-16">{{ $blogComment->user->name }}</h6>
                                                <div class="comment-date-time color-gray font-12 mb-2">
                                                    {{ $blogComment->created_at->format('j M, Y') }} {{ __('AT') }}
                                                    {{ $blogComment->created_at->format('h:i A') }}
                                                </div>
                                                <p class="mb-0">{{ $blogComment->comment }}</p>
                                                @guest
                                                    <button
                                                        class="replyBtn blog-reply-btn btn btn-sm btn-outline-primary font-medium reply-btn mt-2"
                                                        data-bs-toggle="modal" data-bs-target="#commentReplyModal"
                                                        data-parent_id="{{ $blogComment->id }}">
                                                        {{ __('Reply') }}
                                                        <span class="iconify" data-icon="la:angle-right"></span>
                                                    </button>
                                                @endguest
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Replies -->
                                    @foreach ($blogComment->blogCommentReplies as $reply)
                                        <div class="reply-comment mb-4">
                                            <div class="blog-comment-item d-flex align-items-start">
                                                <div class="comment-author-img radius-50 overflow-hidden me-3">
                                                    @if (!empty($reply->user->image_path))
                                                        <img src="{{ getImageFile($reply->user->image_path) }}"
                                                            alt="avatar">
                                                    @else
                                                        <img src="{{ asset('149071.png') }}" alt="dummy-avatar"
                                                            style="width: 50px; height: 50px;">
                                                    @endif
                                                </div>
                                                <div class="author-details flex-grow-1">
                                                    <h6 class="author-name font-16">{{ $reply->user->name }}</h6>
                                                    <div class="comment-date-time color-gray font-12 mb-2">
                                                        {{ $reply->created_at->format('j M, Y') }} {{ __('AT') }}
                                                        {{ $reply->created_at->format('h:i A') }}
                                                    </div>
                                                    <p class="mb-0">{{ $reply->comment }}</p>
                                                    @guest
                                                        <button
                                                            class="replyBtn blog-reply-btn btn btn-sm btn-outline-primary font-medium reply-btn mt-2"
                                                            data-bs-toggle="modal" data-bs-target="#commentReplyModal"
                                                            data-parent_id="{{ $blogComment->id }}">
                                                            {{ __('Reply') }} <span class="iconify"
                                                                data-icon="la:angle-right"></span>
                                                        </button>
                                                    @endguest
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>


                        <!-- Customer Comments and Reply Section-->
                        @php
                            // Check if $user_session exists and has an id
                            $userId = !empty($user_session) ? $user_session->id : null;
                        @endphp
                        @if (!empty($user_session))
                            <!-- Leave a Comment Area-->
                            <div class="comment-form">
                                <h3 class="comment-form__title">{{ __('Leave a comment') }}</h3>
                                <form id="commentForm" class="comment-one__form contact-form-validated">
                                    @csrf
                                    <input type="hidden" class="blog_id" name="blog_id" value="{{ $blog_details->id }}">
                                    @if ($userId)
                                        <input type="hidden" name="user_id" class="user_id" value="{{ $userId }}">
                                    @endif


                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="comment-form__input-box">
                                                <input type="text" placeholder="Your Name" name="name"
                                                    value="{{ $user_session->name }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="comment-form__input-box">
                                                <input type="email" placeholder="Email Address" name="email"
                                                    value="{{ $user_session->email }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="comment-form__input-box text-message-box">
                                                <textarea name="comment" placeholder="Write a Comment"></textarea>
                                            </div>
                                            <div class="comment-form__btn-box">
                                                <button type="submit" class="thm-btn comment-form__btn">{{ __('Submit
                                                    Comment') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Leave a Comment Area-->
                        @endif

                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="sidebar">
                        <div class="sidebar__single sidebar__search">
                            <form action="#" class="sidebar__search-form">
                                <input type="search" placeholder="Buscar Aquí">
                                <button type="submit"><i class="icon-magnifying-glass"></i></button>
                            </form>
                        </div>
                        <div class="sidebar__single sidebar__post">
                            <h3 class="sidebar__title">{{ __('Últimas Entradas') }}</h3>
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
                            <h3 class="sidebar__title">Categorías</h3>
                            <ul class="sidebar__category-list list-unstyled">
                                @php
                                    $categoryList = \App\Models\BlogCategory::all();
                                @endphp

                                @foreach ($categoryList as $category)
                                    <li class="{{ $blog_details->blog_category_id == $category->id ? 'active' : '' }}">
                                        <a href="{{ url('news-category') }}{{ '/'.$category->slug }}">{{ $category->name }}<span
                                                class="icon-right-arrow"></span></a>
                                    </li>
                                @endforeach



                            </ul>
                        </div>
                        <div class="sidebar__single sidebar__tags">
                            <h3 class="sidebar__title">{{ __('Etiquetas') }}</h3>
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
                            <h3 class="sidebar__title">{{ __('Comentarios') }}</h3>
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
    <!--News Details End-->
    <!-- Comment Reply Modal Start -->
    @if ($userId)
        <div class="modal fade" id="commentReplyModal" tabindex="-1" aria-labelledby="writeReviewModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title" id="writeReviewModalLabel">{{ __('Comment Reply') }}</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <form id="ReplycommentForm">
                        @csrf

                        <input type="hidden" name="blog_id" class="blog_id" value="{{ $blog_details->id }}">

                        <input type="hidden" name="user_id" class="user_id" value="{{ $userId }}">

                        <input type="hidden" name="parent_id" id="modalParentId">

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">{{ __('Your Name') }}</label>
                                        <input type="text" name="name" class="form-control" required
                                            value="{{ $user_session->name }}" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">{{ __('Your Email') }}</label>
                                        <input type="email" name="email" class="form-control" id="cus_email"
                                            required value="{{ $user_session->email }}" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label for="comment" class="form-label">{{ __('Your Comments') }}</label>
                                        <textarea name="comment" rows="3" class="form-control" id="cus_comment" required
                                            placeholder="{{ __('Your Comments *') }}"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('Submit Review') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <!-- jQuery (required) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Toastr JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        $(document).on('click', '.replyBtn', function() {
            let parent_id = $(this).data('parent_id');
            $('#modalParentId').val(parent_id);
        });
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

            $('#ReplycommentForm').submit(function(e) {
                e.preventDefault();

                let formData = $(this).serialize();
                let user_id = $('.user_id').val();
                // Validation checks
                if (!user_id) {
                    toastr.warning("You need to login first!");
                    return;
                }
                $.ajax({
                    type: "POST",
                    url: "{{ route('blog-comment-reply.store') }}",
                    data: formData,
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            $('#ReplycommentForm')[0].reset();
                            $('.appendCommentList').prepend(response.html);
                            $('.blog-comments-section').animate({
                                scrollTop: $('.blog-comments-section').prop(
                                    "scrollHeight")
                            }, 1000);
                            toastr.success(response.message, "", {
                                onHidden: function() {
                                    window.location
                                        .reload(); // Reload the page after toastr is hidden
                                }
                            });
                        } else {
                            toastr.error(response.message); // Display error message
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        toastr.error("Failed to store comment. Please try again later.");
                    }
                });
            });


            // Submit event handler for main comment form
            $('#commentForm').submit(function(e) {
                e.preventDefault();

                let formData = $(this).serialize();

                $.ajax({
                    type: "POST",
                    url: "{{ route('blog-comment.store') }}",
                    data: formData,
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            $('#commentForm')[0].reset();
                            $('.appendCommentList').prepend(response.html);
                            $('.blog-comments-section').animate({
                                scrollTop: $('.blog-comments-section').prop(
                                    "scrollHeight")
                            }, 1000);
                            toastr.success("Comment successfully added.", "", {
                                onHidden: function() {
                                    window.location
                                        .reload(); // Corrected to add parentheses for function execution
                                }
                            });
                        } else {
                            toastr.error("Failed to store comment.");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        toastr.error("Failed to store comment. Please try again later.");
                    }
                });
            });

        });
    </script>
@endsection
