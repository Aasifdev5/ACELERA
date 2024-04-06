@extends('master')
@section('title')
{{stripslashes($page_info->page_title)}}
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
                <li>{{ stripslashes($page_info->page_title) }}</li>
            </ul>
            <h2>{{ stripslashes($page_info->page_title) }}</h2>
        </div>
    </div>
</section>
<!--Page Header End-->
<br>
<div class="container" style="margin-bottom: 50px">
<!-- Start Contat Page -->
<div class="contact-page-area vfx-item-ptb vfx-item-info">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-8 col-md-7 col-sm-12 col-xs-12">
		 <div class="contact-form">

				@if (count($errors) > 0)
                <div class="message">
				<div class="alert alert-danger">
					<ul style="list-style: none;">
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
            </div>
				@endif

            @if(Session::has('flash_message'))
              <div class="alert alert-success">
                 {{ Session::get('flash_message') }}
               </div>
            @endif
            @if(Session::has('error_flash_message'))
              <div class="alert alert-danger">
                 {{ Session::get('error_flash_message') }}
               </div>
            @endif
           {!! Form::open(array('url' => 'contact_send','class'=>'row','id'=>'contact_form','role'=>'form')) !!}
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group mb-3">
                <label>Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Name" required>
              </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group mb-3">
				<label>Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
              </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group mb-3">
				<label>Phone</label>
                <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone Number">
              </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group mb-3">
				<label>Subject</label>
                <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject" required>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group mb-3">
              <label>Message</label>
                <textarea name="message" id="message" class="form-control" cols="30" rows="4" placeholder="Your Message..." required></textarea>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group">
                <button type="submit" class="btn btn-sm btn-block btn-primary">Submit</button>
              </div>
            </div>
          {!! Form::close() !!}
        </div>
      </div>
	  <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12">
	    @if($page_info->page_content)
        <div class="contact-form">
            {!!stripslashes($page_info->page_content)!!}
        </div>
        @endif
	  </div>
    </div>
  </div>
</div>
</div>

<!-- End Contact Page -->
@endsection
