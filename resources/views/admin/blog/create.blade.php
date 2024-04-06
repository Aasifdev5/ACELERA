@extends('admin.Master')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <!-- Page content area start -->

    <div class="page-body">

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
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
                        <div class="card-header">

                        </div>
                        <div class="card-body">
                            <div class="page-content">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="breadcrumb__content">
                                                <div class="breadcrumb__content__left">
                                                    <div class="breadcrumb__title">
                                                        <h2>{{ __('Add Blog') }}</h2>
                                                    </div>
                                                </div>
                                                <div class="breadcrumb__content__right">
                                                    <nav aria-label="breadcrumb">
                                                        <ul class="breadcrumb">
                                                            <li class="breadcrumb-item"><a
                                                                    href="{{ url('admin/dashboard') }}">{{ __('Dashboard') }}</a>
                                                            </li>
                                                            <li class="breadcrumb-item"><a
                                                                    href="{{ url('admin/blog') }}">{{ __('All Blog') }}</a>
                                                            </li>
                                                            <li class="breadcrumb-item active" aria-current="page">
                                                                {{ __('Add Blog') }}</li>
                                                        </ul>
                                                    </nav>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="customers__area bg-style mb-30">
                                                <div class="item-title d-flex justify-content-between">
                                                    <h2>{{ __('Add Blog') }}</h2>
                                                </div>
                                                <form action="{{ route('blog.store') }}" method="post"
                                                    class="form-horizontal" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{ $user_session->id }}">
                                                    <div class="input__group mb-25">
                                                        <label>{{ __('Title') }} <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" name="title" value="{{ old('title') }}"
                                                            placeholder="{{ __('Title') }}" class="form-control slugable"
                                                            onkeyup="slugable()">
                                                        @if ($errors->has('title'))
                                                            <span class="text-danger"><i
                                                                    class="fas fa-exclamation-triangle"></i>
                                                                {{ $errors->first('title') }}</span>
                                                        @endif
                                                    </div>

                                                    <div class="input__group mb-25">
                                                        <label>{{ __('Slug') }} <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" name="slug" value="{{ old('slug') }}"
                                                            placeholder="{{ __('Slug') }}" class="form-control slug"
                                                            onkeyup="getMyself()">
                                                        @if ($errors->has('slug'))
                                                            <span class="text-danger"><i
                                                                    class="fas fa-exclamation-triangle"></i>
                                                                {{ $errors->first('slug') }}</span>
                                                        @endif
                                                    </div>

                                                    <div class="input__group mb-25">
                                                        <label for="blog_category_id"> {{ __('Blog Category') }} </label>
                                                        <select name="blog_category_id" class="form-control"
                                                            id="blog_category_id">
                                                            <option value="">--{{ __('Select Option') }}--</option>
                                                            @foreach ($blogCategories as $blogCategory)
                                                                <option value="{{ $blogCategory->id }}">
                                                                    {{ $blogCategory->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="input__group mb-25">
                                                        <label for="tag_ids"> {{ __('Tag') }} </label>
                                                        <select name="tag_ids[]" multiple id="tag_ids"
                                                            class="multiple-basic-single form-control">
                                                            @foreach ($tags as $tag)
                                                                <option value="{{ $tag->id }}">{{ $tag->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="input__group mb-25">
                                                        <label>{{ __('Details') }} <span
                                                                class="text-danger">*</span></label>
                                                        <textarea name="details" class="editor">{{ old('details') }}</textarea>

                                                        @if ($errors->has('details'))
                                                            <span class="text-danger"><i
                                                                    class="fas fa-exclamation-triangle"></i>
                                                                {{ $errors->first('details') }}</span>
                                                        @endif

                                                    </div>

                                                    <div class="row">
                                                        <label>{{ __('Image') }}</label>
                                                        <div class="col-md-3">
                                                            <div class="upload-img-box mb-25">
                                                                <img src="">
                                                                <input type="file" name="image" class="form-control"
                                                                    id="image" accept="image/*"
                                                                    onchange="previewFile(this)">
                                                                <div class="upload-img-box-icon">
                                                                    <i class="fa fa-camera"></i>
                                                                    <p class="m-0">{{ __('Image') }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if ($errors->has('image'))
                                                            <span class="text-danger"><i
                                                                    class="fas fa-exclamation-triangle"></i>
                                                                {{ $errors->first('image') }}</span>
                                                        @endif
                                                        <p>{{ __('Accepted Files') }}: JPEG, JPG, PNG <br>
                                                            {{ __('Recommend Size') }}: 870 x 500 (1MB)</p>
                                                    </div>

                                                    <div class="input__group mb-25">
                                                        <label>{{ __('Meta Title') }}</label>
                                                        <input type="text" name="meta_title"
                                                            value="{{ old('meta_title') }}"
                                                            placeholder="{{ __('Meta title') }}" class="form-control">
                                                        @if ($errors->has('meta_title'))
                                                            <span class="text-danger"><i
                                                                    class="fas fa-exclamation-triangle"></i>
                                                                {{ $errors->first('meta_title') }}</span>
                                                        @endif
                                                    </div>

                                                    <div class="input__group mb-25">
                                                        <label>{{ __('Meta Description') }}</label>
                                                        <input type="text" name="meta_description"
                                                            value="{{ old('meta_description') }}"
                                                            placeholder="{{ __('meta description') }}"
                                                            class="form-control">
                                                        @if ($errors->has('meta_description'))
                                                            <span class="text-danger"><i
                                                                    class="fas fa-exclamation-triangle"></i>
                                                                {{ $errors->first('meta_description') }}</span>
                                                        @endif
                                                    </div>

                                                    <div class="input__group mb-25">
                                                        <label>{{ __('Meta Keywords') }}</label>
                                                        <input type="text" name="meta_keywords"
                                                            value="{{ old('meta_keywords') }}"
                                                            placeholder="{{ __('meta keywords') }}" class="form-control">
                                                        @if ($errors->has('meta_keywords'))
                                                            <span class="text-danger"><i
                                                                    class="fas fa-exclamation-triangle"></i>
                                                                {{ $errors->first('meta_keywords') }}</span>
                                                        @endif
                                                    </div>

                                                    <div class="input__group mb-25">
                                                        <label>{{ __('OG Image') }}</label>
                                                        <div class="upload-img-box">
                                                            <img src="">
                                                            <input type="file" class="form-control" name="og_image"
                                                                id="og_image" accept="image/*"
                                                                onchange="previewFile(this)">
                                                            <div class="upload-img-box-icon">
                                                                <i class="fa fa-camera"></i>
                                                                <p class="m-0">{{ __('OG Image') }}</p>
                                                            </div>
                                                        </div>
                                                        @if ($errors->has('og_image'))
                                                            <span class="text-danger"><i
                                                                    class="fas fa-exclamation-triangle"></i>
                                                                {{ $errors->first('og_image') }}</span>
                                                        @endif
                                                        <p><span class="text-black">{{ __('Accepted Files') }}:</span>
                                                            PNG, JPG <br> <span
                                                                class="text-black">{{ __('Recommend Size') }}:</span> 1200
                                                            x 627</p>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <div class="col-md-12 text-right">
                                                            <button class="btn btn-primary" type="submit">Save</button>
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
                <!-- DOM / jQuery  Ends-->


            </div>
        </div>


        <!-- Container-fluid Ends-->
        <!-- Container-fluid Ends-->
    </div>
    <!-- Page content area end -->
@endsection
