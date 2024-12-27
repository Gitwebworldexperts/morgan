@extends('layouts.app')


@section('title', $career->job_name)
@section('meta')

@endsection
@section('content')

<section class="banner inr-banner" style="background-image: url('{{ asset('img/inr-banner.png') }}');">
    <div class="container">
        <div class="slider-info">
            <div class="BannerBox">
                <div class="banner-heading text-center">
                    <h1>Careers</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="breadcrumb-sec">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-container">
                    <ul>
                        <li><a href="" class="">Home</a></li>
                        <li><a href="" class="">Careers</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="jobs-section space">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                    <div class="content-wrapper">
                        <div class="job-location">
                            <ul>
                                <li><img src="{{ asset('img/clock.svg') }}" alt=""> {{ $career->job_type }}</li>
                                <li><img src="{{ asset('img/location.svg') }}" alt=""> {{ $career->job_location }}</li>
                            </ul>
                        </div>
                        
                        <div class="job-detail-topbar">
                            <div class="company-logo">
                                <img src="{{ asset('img/compnay-logo.png') }}" class="" alt="">
                            </div>
                        
                            <div class="job-info">
                                <span>{{ $career->position }}</span>
                                <h3>{{ $career->job_name }}</h3>
                            </div>
                        </div>
                        
                        <div class="seperator"></div>
                        
                        <h4>Description</h4>
                        {!! $career->description !!}

                        <div class="seperator"></div>
                        
                        <h4>Responsibilities</h4>
                        {!! $career->responsibilities !!}
                    </div>
            </div>
            
            
            <div class="col-lg-6 col-md-6 col-12">
                <div class="list-from">
                    <h2 class="mb-2">Apply Job</h2>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <p class="mb-4">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.</p>
                    <form action="{{ route('career.submit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="career_id" value="{{ base64_encode($career->id) }}">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input class="form-control" placeholder="John Doe" name="full_name" type="text">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" placeholder="example@gmail.com" name="email" type="email">
                        </div>
                        <div class="form-group">
                            <label>Experience</label>
                            <input class="form-control" placeholder="" name="experience" type="text">
                        </div>
                        <div class="form-group">
                            <label>Contact Number</label>
                            <input class="form-control" placeholder="1234567890" name="contact_number" type="text">
                        </div>
                        <div class="form-group">
                            <label>Add Resume</label>
                            <input class="form-control" name="resume" type="file">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="green-btn submit-btn">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
            
            
            
        </div>
    </div>
</section>
      


@endsection
