@extends('layouts.app')
@section('title', 'Home Page')
@section('content')
@php
$footerSection = getFooterSection();
@endphp
<section class="breadcrumb-sec">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-container">
                    <ul>
                        <li><a href="" class="">Home</a></li>
                        <li><a href="" class=""> Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>


@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<section class="contact-page space">
    <div class="container">
        <div class="contact-form-main">
			<div class="row no-gutters">
				<div class="col-lg-4 col-md-5">
					<div class="contact-leftside">
						<!--<div class="contact-leftImage">
							<img src="img/logo-icon-light.svg">
						</div>-->
						<div class="cont-item">
							<span>Address</span>
							<p>{!! isset($footerSection->address) ? $footerSection->address : ""!!}</p>
						</div>
						
						<div class="cont-item">
							<span>Hotline</span>
							<p><a href="tel:{{ isset($footerSection->phone) ? $footerSection->phone : ''}}">{{ isset($footerSection->phone) ? $footerSection->phone : ""}}</a></p>
						</div>
						
						<div class="cont-item">
							<span>Email ID</span>
							<p><a href="mailto:{{ isset($footerSection->email) ? $footerSection->email : ''}}">{{ isset($footerSection->email) ? $footerSection->email : ""}}</a></p>
						</div>
					</div>
				</div>
					<div class="col-lg-8 col-md-7">
						<div class="contact-RightSide">
							<div class="contact-RightHeading">
								<p>Contact Us</p>
								<h4>Get in touch with us</h4>
							</div>
							<form action="{{ route('contact.submit') }}" method="POST">
							    @csrf
							    <div class="row">
							        <div class="col-lg-6">
							            <div class="form-group">
							                <label>First Name</label>
							                <input class="form-control" name="first_name" placeholder="John" required type="text">
							            </div>
							        </div>

							        <div class="col-lg-6">
							            <div class="form-group">
							                <label>Last Name</label>
							                <input class="form-control" name="last_name" placeholder="Niclus" required type="text">
							            </div>
							        </div>

							        <div class="col-lg-6">
							            <div class="form-group">
							                <label>Email</label>
							                <input class="form-control" name="email" placeholder="example@gmail.com" required type="email">
							            </div>
							        </div>

							        <div class="col-lg-6">
							            <div class="form-group">
							                <label>Contact Number</label>
							                <input class="form-control" name="phone" placeholder="+91 4336 3463" required type="text">
							            </div>
							        </div>

							        <div class="col-lg-12">
							            <div class="form-group">
							                <label>Message</label>
							                <textarea cols="40" rows="3" class="form-control" name="message" required placeholder="Enter your message here..."></textarea>
							            </div>
							        </div>
							        <div class="col-lg-12">
							            <div class="form-group">
							                <button type="submit" class="green-btn contact-submit">Submit <img src="img/arrow-right3.svg" class=""></button>
							            </div>
							        </div>
							    </div>
							</form>

							</div>
						</div>
				</div>
			</div>			
        </div>
    
</section>

<section class="map-section">
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3613.11940326637!2d55.153619976080115!3d25.097819135717454!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f6b4164e9f477%3A0x873c65b1c9eb0f7e!2sConcord%20Tower%20-%20Al%20Sufouh%20-%20Al%20Sufouh%202%20-%20Dubai%20-%20United%20Arab%20Emirates!5e0!3m2!1sen!2sin!4v1722857107508!5m2!1sen!2sin" width="100%" height="550" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</section>


@endsection