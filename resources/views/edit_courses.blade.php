@extends('master')
@section('title')
Editar Project
@endsection
@section('content')

<div class="container" style="margin-bottom: 50px">
    <div class="row">
        <div class="col-md-10 col-xs-12">

            <form action="{{ url('update_project') }}" enctype="multipart/form-data" id="startCampaignForm" class=" theme-form form-horizontal" method="post">
                @if (Session::has('success'))
                        <div class="alert alert-success" style="background-color: green;">
                            <p style="color: #fff;">{{ session::get('success') }}</p>
                        </div>
                    @endif
                    @if (Session::has('fail'))
                        <div class="alert alert-danger" style="background-color: red;">
                            <p style="color: #fff;">{{ session::get('fail') }}</p>
                        </div>
                    @endif
                @csrf
                <input type="hidden" name="id" value="{{$project_detail->id}}">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <i class="fa fa-info-circle"></i> Feature Available Information
                    </div>
                </div>
                <div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
                    <label for="category" class="col-sm-4 control-label">Category <span class="field-required">*</span></label>
                    <div class="col-sm-8">
                        <select class="form-control select2" name="category">
                            <option value="">Select a Category</option>
                            @foreach ($category as $cat)
                            <option value="{{ $cat->id }}" {{ $project_detail->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        {!! $errors->has('category') ? '<p class="help-block">' . $errors->first('category') . '</p>' : '' !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    <label for="title" class="col-sm-4 control-label">Title <span class="field-required">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="title" value="{{ $project_detail->title }}" name="title" placeholder="Title">
                        {!! $errors->has('title') ? '<p class="help-block">' . $errors->first('title') . '</p>' : '' !!}
                        <p class="text-info">Great title information</p>
                    </div>
                </div>

                <div class="form-group {{ $errors->has('short_description') ? 'has-error' : '' }}">
                    <label for="short_description" class="col-sm-4 control-label">Short Description</label>
                    <div class="col-sm-8">
                        <textarea name="short_description" id="" class=" form-control" rows="3">{{ $project_detail->short_description }}</textarea>
                        {!! $errors->has('short_description') ? '<p class="help-block">' . $errors->first('short_description') . '</p>' : '' !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                    <label for="description" class="col-sm-3 control-label">Description <span class="field-required">*</span></label>
                    <div class="col-sm-12">
                        <div class="alert alert-info"> Image Insert Limitation </div>
                    </div>
                    <div class="col-sm-12">
                        <textarea name="description" class="editor form-control description" rows="8">{{ $project_detail->description }}</textarea>
                        {!! $errors->has('description') ? '<p class="help-block">' . $errors->first('description') . '</p>' : '' !!}
                        <p class="text-info"> Description Info Text</p>
                    </div>
                </div>


                <div class="alert alert-info">
                    <h3><i class="fa fa-money"></i> You Will Get 80% of Total Raised</h3>
                </div>

                <div class="form-group {{ $errors->has('goal') ? 'has-error' : '' }}">
                    <label for="goal" class="col-sm-4 control-label">Goal <span class="field-required">*</span></label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="goal" value="{{ $project_detail->goal }}" name="goal" placeholder="Goal">
                        {!! $errors->has('goal') ? '<p class="help-block">' . $errors->first('goal') . '</p>' : '' !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('recommended_amount') ? 'has-error' : '' }}">
                    <label for="recommended_amount" class="col-sm-4 control-label">Recommended Amount</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="recommended_amount" value="{{ $project_detail->recommended_amount }}" name="recommended_amount" placeholder="Recommended Amount">
                        {!! $errors->has('recommended_amount') ? '<p class="help-block">' . $errors->first('recommended_amount') . '</p>' : '' !!}
                    </div>
                </div>



                <div class="form-group {{ $errors->has('amount_prefilled') ? 'has-error' : '' }}">
                    <label for="amount_prefilled" class="col-sm-4 control-label">Amount Prefilled</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="amount_prefilled" value="{{ $project_detail->amount_prefilled }}" name="amount_prefilled" placeholder="Amount Prefilled">
                        {!! $errors->has('amount_prefilled') ? '<p class="help-block">' . $errors->first('amount_prefilled') . '</p>' : '' !!}
                        <p class="text-info"> Amount Prefilled Info Text</p>
                    </div>
                </div>

                <div class="form-group {{ $errors->has('end_method') ? 'has-error' : '' }}">
                    <label for="end_method" class="col-sm-4 control-label">Campaign End Method</label>
                    <div class="col-sm-8">
                        <label>
                            <input type="radio" name="end_method" value="goal_achieve" {{ $project_detail->end_method == 'goal_achieve' ? 'checked' : '' }}> After Goal Achieve
                        </label> <br />

                        <label>
                            <input type="radio" name="end_method" value="end_date" {{ $project_detail->end_method == 'end_date' ? 'checked' : '' }}> After End Date
                        </label> <br />

                        {!! $errors->has('end_method') ? '<p class="help-block">' . $errors->first('end_method') . '</p>' : '' !!}
                        <p class="text-info"> End Method Info Text</p>
                    </div>
                </div>


                <div class="custom-form-group mb-25">
                    <label for="image" class="text-lg-right text-black mb-2">{{ __('Image') }}</label>
                    <div class="upload-img-box mb-25">
                        <img src="{{ $project_detail->image ? asset($project_detail->image) : '' }}" id="image_preview" style="max-width: 100%; max-height: 200px;" />
                        <input type="file" name="image" id="image" accept="image/*" onchange="previewFile(this)">
                        <div class="upload-img-box-icon">
                            <i class="fa fa-camera"></i>
                            <p class="m-0">{{ __('Image') }}</p>
                        </div>
                    </div>
                    @if ($errors->has('image'))
                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('image') }}</span>
                    @endif
                    <p>{{ __('Accepted Image Files') }}: PNG <br> {{ __('Recommend Size') }}: 60 x 60 (1MB)</p>
                </div>


                <div class="form-group {{ $errors->has('video') ? 'has-error' : '' }}">
                    <label for="video" class="col-sm-4 control-label">Video</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="video" value="{{ old('video') }}" name="video" placeholder="Video">
                        {!! $errors->has('video') ? '<p class="help-block">' . $errors->first('video') . '</p>' : '' !!}
                        <p class="text-info"> Video Info Text</p>
                    </div>
                </div>

                <div class="input__group mb-25">
                    <label>{{ __('OG Image') }}</label>
                    <div class="upload-img-box">
                        <img src="{{ $project_detail->og_image ? asset($project_detail->og_image) : '' }}" id="og_image_preview" style="max-width: 100%; max-height: 200px;" />
                        <input type="file" name="og_image" id="og_image" accept="image/*" onchange="previewFile(this)">
                        <div class="upload-img-box-icon">
                            <i class="fa fa-camera"></i>
                            <p class="m-0">{{ __('OG Image') }}</p>
                        </div>
                    </div>
                    @if ($errors->has('og_image'))
                    <span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('og_image') }}</span>
                    @endif
                    <p><span class="text-black">{{ __('Accepted Files') }}:</span> PNG, JPG <br>
                        <span class="text-black">{{ __('Recommend Size') }}:</span> 1200 x 627
                    </p>
                </div>

                <div class="form-group {{ $errors->has('country_id') ? 'has-error' : '' }}">
                    <label for="country_id" class="col-sm-4 control-label">Country <span class="field-required">*</span></label>
                    <div class="col-sm-8">
                        <select class="form-control select2" name="country_id">
                            <option value="">Select a Country</option>
                            @foreach ($countries as $country)
                            @php
                            // Assuming $country['name'] is a JSON string
                            $countryData = json_decode($country['name'], true);

                            // Access the "en" value
                            $englishValue = isset($countryData['en']) ? $countryData['en'] : '';
                            @endphp
                            <option value="{{ $country->id }}" {{ $project_detail->country_id == $country->id ? 'selected' : '' }}>{{ $englishValue }}</option>
                            <!-- Add more table cells for additional fields as needed -->
                            @endforeach
                        </select>
                        {!! $errors->has('country_id') ? '<p class="help-block">' . $errors->first('country_id') . '</p>' : '' !!}
                    </div>
                </div>


                <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                    <label for="address" class="col-sm-4 control-label">Address</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="address" value="{{ $project_detail->address }}" name="address" placeholder="Address">
                        {!! $errors->has('address') ? '<p class="help-block">' . $errors->first('address') . '</p>' : '' !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
                    <label for="start_date" class="col-sm-4 control-label">Start Date</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="start_date" value="{{ $project_detail->start_date }}" name="start_date" placeholder="Start Date">
                        {!! $errors->has('start_date') ? '<p class="help-block">' . $errors->first('start_date') . '</p>' : '' !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('end_date') ? 'has-error' : '' }}">
                    <label for="end_date" class="col-sm-4 control-label">End Date</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="end_date" value="{{ $project_detail->end_date }}" name="end_date" placeholder="End Date">
                        {!! $errors->has('end_date') ? '<p class="help-block">' . $errors->first('end_date') . '</p>' : '' !!}
                    </div>
                </div>


                <br>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-primary">Update Project</button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
