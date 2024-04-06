@extends('admin.Master')
@section('title')
    {{ $title }}
@endsection
@section('content')
    <!-- Page content area start -->
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
                                <div class="form-vertical__item bg-style">
                                    <div class="item-top mb-30">
                                        <h2>{{ __('Add New Category') }}</h2>
                                    </div>
                                    <form id="Form">
                                        @csrf

                                        <div class="input__group mb-25">
                                            <label for="name"> {{ __('Name') }} </label>
                                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                                class="form-control flat-input" placeholder="{{ __('Name') }}">
                                            @if ($errors->has('name'))
                                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i>
                                                    {{ $errors->first('name') }}</span>
                                            @endif
                                        </div>

                                        <div class="input__group mb-25">
                                            <label for="is_feature"> {{ __('Feature') }} </label>
                                            <div>
                                                <label class="text-black"> <input type="checkbox" name="is_feature"
                                                        id="is_feature" value="yes"
                                                        {{ old('is_feature') == 'yes' ? 'checked' : '' }}>
                                                    {{ __('Yes') }} </label>
                                            </div>
                                        </div>

                                        <div class="custom-form-group mb-25">
                                            <label for="image" class="text-lg-right text-black mb-2">
                                                {{ __('Image') }} </label>
                                            <div class="upload-img-box mb-25">
                                                <img src="">
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
                                            <p>{{ __('Accepted Image Files') }}: PNG <br> {{ __('Recommend Size') }}: 60 x
                                                60 (1MB)</p>
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>{{ __('Meta Title') }}</label>
                                            <input type="text" name="meta_title" value="{{ old('meta_title') }}"
                                                placeholder="{{ __('Meta title') }}" class="form-control">
                                            @if ($errors->has('meta_title'))
                                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i>
                                                    {{ $errors->first('meta_title') }}</span>
                                            @endif
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>{{ __('Meta Description') }}</label>
                                            <input type="text" name="meta_description"
                                                value="{{ old('meta_description') }}"
                                                placeholder="{{ __('meta description') }}" class="form-control">
                                            @if ($errors->has('meta_description'))
                                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i>
                                                    {{ $errors->first('meta_description') }}</span>
                                            @endif
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>{{ __('Meta Keywords') }}</label>
                                            <input type="text" name="meta_keywords" value="{{ old('meta_keywords') }}"
                                                placeholder="{{ __('meta keywords') }}" class="form-control">
                                            @if ($errors->has('meta_keywords'))
                                                <span class="text-danger"><i class="fas fa-exclamation-triangle"></i>
                                                    {{ $errors->first('meta_keywords') }}</span>
                                            @endif
                                        </div>

                                        <div class="input__group mb-25">
                                            <label>{{ __('OG Image') }}</label>
                                            <div class="upload-img-box">
                                                <img src="">
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
                                                <span class="text-black">{{ __('Recommend Size') }}:</span> 1200 x 627
                                            </p>
                                        </div>
                                        <div class="input__group mb-25">
                                            <div class="">
                                                <button class="btn btn-primary" type="submit">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>F
            </div>
        </div>
    </div>
    <!-- Page content area end -->

    <script>
        $('#Form').submit(function(e) {
            e.preventDefault();

            let formData = new FormData(this); // Create FormData object

            $.ajax({
                type: "POST",
                url: "{{ route('category.store') }}",
                data: formData,
                dataType: "json",
                contentType: false, // Set contentType to false for file uploads
                processData: false, // Set processData to false to prevent jQuery from automatically transforming the data
                success: function(response) {
                    if (response.success) {
                        toastr.success("Category successfully created.", "", {
                            onHidden: function() {
                                window.location.href = "{{ route('category.index') }}";
                            }
                        });
                    } else {
                        toastr.error("Failed to create category.");
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    toastr.error("Failed to create category. Please try again later.");
                }
            });
        });
    </script>
@endsection
