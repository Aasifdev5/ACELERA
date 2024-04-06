@extends('admin.Master')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <!-- sign up page start-->
            <div class="auth-bg-video">
                <video id="bgvid" poster="{{ asset('admin/images/coming-soon-bg.jpg') }}" playsinline="" autoplay=""
                    muted="" loop="">
                    <source src="{{ asset('admin/video/auth-bg.mp4') }}" type="video/mp4">
                </video>
                <div class="authentication-box" style="width: 1080px;">
                    <div class="text-center"><img src="assets/images/endless-logo.png" alt=""></div>
                    <div class="card mt-4 p-4">


                        <div class="row">
                            <div class="col-md-12">
                                <div class="customers__area bg-style mb-30">
                                    <div class="item-title d-flex justify-content-between">
                                        <h2>{{ __('Edit Blog') }}</h2>
                                    </div>
                                    <form action="{{ url('admin/blog/update', [$blog->uuid]) }}" method="post"
                                        class="theme-form form-horizontal" enctype="multipart/form-data">
                                        @if (Session::has('success'))
                                            <div class="alert alert-success">
                                                <p>{{ session::get('success') }}</p>
                                            </div>
                                        @endif
                                        @if (Session::has('fail'))
                                            <div class="alert alert-danger">
                                                <p>{{ session::get('fail') }}</p>
                                            </div>
                                        @endif
                                        @csrf

                                        <div class="input__group mb-25">
                                            <label>{{ __('Title') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="title" value="{{ $blog->title }}"
                                                placeholder="{{ __('Title') }}" class="form-control slugable"
                                                onkeyup="slugable()">
                                            @if ($errors->has('title'))
                                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i>
                                                    {{ $errors->first('title') }}</span>
                                            @endif
                                        </div>
                                        <br>
                                        <div class="input__group mb-25">
                                            <label>{{ __('Slug') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="slug" value="{{ $blog->slug }}"
                                                placeholder="{{ __('Slug') }}" class="form-control slug"
                                                onkeyup="getMyself()">
                                            @if ($errors->has('slug'))
                                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i>
                                                    {{ $errors->first('slug') }}</span>
                                            @endif
                                        </div>
                                        <br>
                                        <div class="input__group mb-25">
                                            <label for="blog_category_id"> {{ __('Blog category') }} </label>
                                            <select name="blog_category_id" id="blog_category_id" class="form-control">
                                                <option value="">--{{ __('Select Option') }}--</option>
                                                @foreach ($blogCategories as $blogCategory)
                                                    <option value="{{ $blogCategory->id }}"
                                                        @if ($blogCategory->id = $blog->blog_category_id) selected @endif>
                                                        {{ $blogCategory->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <br>
                                        <div class="input__group mb-25">
                                            <label>Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="">--{{ __('Select Option') }}--</option>
                                                <option value="1" @if ($blog->status == 1) selected @endif>
                                                    {{ __('Published') }}</option>
                                                <option value="0" @if ($blog->status != 1) selected @endif>
                                                    {{ __('Unpublished') }}</option>
                                            </select>
                                        </div>
                                        <br>
                                        <div class="input__group mb-25">
                                            <label for="tag_ids"> {{ __('Tag') }} </label>
                                            <select name="tag_ids[]" multiple id="tag_ids"
                                                class="multiple-basic-single form-control">
                                                @foreach ($tags as $tag)
                                                    <option value="{{ $tag->id }}"
                                                        {{ in_array($tag->id, @$blog->tags->pluck('tag_id')->toArray() ?? []) ? 'selected' : null }}>
                                                        {{ $tag->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="input__group mb-25">
                                            <label>{{ __('Details') }} <span class="text-danger">*</span></label>
                                            <textarea name="details" class="editor">{{ $blog->details }}</textarea>

                                            @if ($errors->has('details'))
                                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i>
                                                    {{ $errors->first('details') }}</span>
                                            @endif

                                        </div>
                                        <br>
                                        <div class="row">
                                            <label>{{ __('OG Image') }}</label>
                                            <div class="col-md-3">
                                                <div class="upload-img-box mb-25">
                                                    @if ($blog->image)
                                                        <img src="{{ asset($blog->image_path) }}" alt="img">
                                                    @else
                                                        <img src="" alt="No img">
                                                    @endif
                                                    <input type="file" name="image" id="image" accept="image/*"
                                                        onchange="previewFile(this)">
                                                    <div class="upload-img-box-icon">
                                                        <i class="fa fa-camera"></i>
                                                        <p class="m-0">{{ __('Image') }}</p>
                                                    </div>
                                                </div>
                                                @if ($errors->has('image'))
                                                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i>
                                                        {{ $errors->first('image') }}</span>
                                                @endif
                                                <p>{{ __('Accepted Files') }}: JPEG, JPG, PNG <br>
                                                    {{ __('Recommend Size') }}: 870 x 500 (1MB)</p>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="input__group mb-25">
                                            <label>{{ __('Meta Title') }}</label>
                                            <input type="text" name="meta_title"
                                                value="{{ old('meta_title', $blog->meta_title) }}"
                                                placeholder="{{ __('Meta title') }}" class="form-control">
                                            @if ($errors->has('meta_title'))
                                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i>
                                                    {{ $errors->first('meta_title') }}</span>
                                            @endif
                                        </div>
                                        <br>
                                        <div class="input__group mb-25">
                                            <label>{{ __('Meta Description') }}</label>
                                            <input type="text" name="meta_description"
                                                value="{{ old('meta_description', $blog->meta_description) }}"
                                                placeholder="{{ __('meta description') }}" class="form-control">
                                            @if ($errors->has('meta_description'))
                                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i>
                                                    {{ $errors->first('meta_description') }}</span>
                                            @endif
                                        </div>
                                        <br>
                                        <div class="input__group mb-25">
                                            <label>{{ __('Meta Keywords') }}</label>
                                            <input type="text" name="meta_keywords"
                                                value="{{ old('meta_keywords', $blog->meta_keywords) }}"
                                                placeholder="{{ __('meta keywords') }}" class="form-control">
                                            @if ($errors->has('meta_keywords'))
                                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i>
                                                    {{ $errors->first('meta_keywords') }}</span>
                                            @endif
                                        </div>
                                        <br>
                                        <div class="input__group mb-25">
                                            <label>{{ __('OG Image') }}</label>
                                            <div class="upload-img-box">
                                                @if ($blog->og_image != null && $blog->og_image != '')
                                                    <img src="{{ getImageFile($blog->og_image) }}">
                                                @else
                                                    <img src="">
                                                @endif
                                                <input type="file" name="og_image" id="og_image" accept="image/*"
                                                    onchange="previewFile(this)">
                                                <div class="upload-img-box-icon">
                                                    <i class="fa fa-camera"></i>
                                                    <p class="m-0">{{ __('OG Image') }}</p>
                                                </div>
                                            </div>
                                            @if ($errors->has('og_image'))
                                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i>
                                                    {{ $errors->first('og_image') }}</span>
                                            @endif
                                            <p><span class="text-black">{{ __('Accepted Files') }}:</span> PNG, JPG <br>
                                                <span class="text-black">{{ __('Recommend Size') }}:</span> 1200 x 627</p>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-12 text-right">
                                                <button class="btn btn-primary" type="submit">Update</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
    <!-- page-wrapper Ends-->
@endsection
