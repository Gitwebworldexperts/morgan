@extends('layouts.app')
@section('title', $foundProperty['page_title'] ?? '')
@section('meta')

@endsection
@section('content')
{{ dd('hello'); }}
<section class="banner inr-banner" style="background-image: url(img/inr-banner.png);">
         <div class="container">
            <div class="slider-info">
               <div class="BannerBox">
                  <div class="banner-heading">
                     <h1>List With Us</h1>
					 <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.</p>
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
                                <li><a href="{{ asset('/') }}" class="">Home</a></li>
                                <li><span class="">List with us</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="welcome-text-section space">
            <div class="container">
                <div class="row">
					<div class="col-lg-8 mx-auto">
						<div class="welcome-text text-center">
							<h2>Sell Your Luxury Home With Morgan's</h2>	
							<p class="mb-4"><b>Start with a professional luxury home valuation today.</b></p>
							<a href="" class="green-btn mx-auto">Book an instant property valuation</a>
						</div>
					</div>
				</div>
			</div>
		</section>
        <section class="dark-report-sec space position-relative pt-0">
        <div class="container">
          <div class="dark-report-main">
            <div class="row">
              <div class="col-lg-7 col-12">
                <div class="heading-pnel fff mb-0">
                  <div class="dark-report-content">
                    <h2 class="mb-3">The Convenient Way To Sell Your Luxury Home in Dubai</h2>
                    <p class="mb-4">Work with a dedicated Morgan's International Realty agent who will listen to your needs and goals, use data and creativity to optimize your property for potential buyers, and stand beside you for every step of the selling process. We welcome expectations because we hold ourselves to the highest standard and know that our success is defined by yours. If you’re considering selling your home, or just want to get a sense of your home’s value, we would love to connect. </p>
                  </div>
                </div>
              </div>
              <div class="col-lg-5 col-12 order--1">
                <div class="dark-report-img">
                  <img src="img/shed-image.png" class="w-100" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
    <section class="studio-panel space pt-0">
		<div class="container">
			<div class="row">
				<div class="col-lg-4">
					<div class="studio-box">
						<div class="studio-head">
							<h2>Lights, Camera, <br> Real Estate</h2>
						</div>
						<a href="">
							<figure>
								<img src="img/studio/1.png" class="w-100" alt="">
								<figcaption>
									<h3>Morgan's Studios</h3>
								</figcaption>
							</figure>
						</a>
					</div>
				</div>
				
				<div class="col-lg-4">
					<div class="studio-box">
						<div class="studio-head">
							<h2>Tech Powered <br> Solutions</h2>
						</div>
						<a href="">
							<figure>
								<img src="img/studio/2.png" class="w-100" alt="">
								<figcaption>
									<h3>Morgan's Instant Valuations</h3>
								</figcaption>
							</figure>
						</a>
					</div>
				</div>
				
				<div class="col-lg-4">
					<div class="studio-box">
						<div class="studio-head">
							<h2>Data Driven <br> Property Reports</h2>
						</div>
						<a href="">
							<figure>
								<img src="img/studio/3.png" class="w-100" alt="">
								<figcaption>
									<h3>Morgan's Reports</h3>
								</figcaption>
							</figure>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
    <section class="list-us-sec studio-list-form space">
            <div class="container">
				<div class="row">
					<div class="col-12">
						<div class="heading-pnel fff text-center">
							<h2>Listing form</h2>
						</div>
					</div>
                </div>
                <div class="row">
					<div class="col-lg-12">
						<div class="list-from">
							<form action="">							
								<div class="row">
									<div class="col-lg-4 col-md-6 col-12">
										<div class="form-group">
											<label>Full Name</label>
											<input class="form-control" placeholder="John Doe" name="" type="text">
										</div>
									</div>
									
									<div class="col-lg-4 col-md-6 col-12">
										<div class="form-group">
											<label>Email</label>
											<input class="form-control" placeholder="example@gmail.com" name="" type="text">
										</div>
									</div>
									
									<div class="col-lg-4 col-md-6 col-12">
										<div class="form-group">
											<label>Contact Number</label>
											<input class="form-control" placeholder="23543 4343 3433" name="" type="text">
										</div>
									</div>
									
									<div class="col-lg-4 col-md-6 col-12">
										<div class="form-group">
											<label>Property Type</label>
											<select class="form-control" placeholder="John Doe" name="" type="text">
												<option></option>
												<option>Residential</option>
												<option>Commercial</option>
											</select>
										</div>
									</div>
									
									<div class="col-lg-4 col-md-6 col-12">
										<div class="form-group">
											<label>No. of Bedrooms</label>
											<input class="form-control" placeholder="Enter Bedrooms" name="" type="text">
										</div>
									</div>
									
									<div class="col-lg-4 col-md-6 col-12">
										<div class="form-group">
											<label>Area</label>
											<input class="form-control" placeholder="Enter Area" name="" type="text">
										</div>
									</div>
									
									<div class="col-12">
										<div class="form-group">
											<label>Building Name</label>
											<input class="form-control" placeholder="Enter Building Name" name="" type="text">
										</div>
									</div>
									
									<div class="col-md-6 col-12">
										<div class="form-group">
											<p class="mb-0 mt-4"><input class="" type="checkbox"> Consent box to tick and submit all the details and agree to Morgan's <a href="" class="link-btn">Privacy Policy.</a>&nbsp;</p>
										</div>
									</div>
									<div class="col-md-6 col-12">
										<div class="form-group">
											<a href="" class="green-btn submit-btn">Submit <img src="{{ asset('img/arrow-right3.svg') }}" class=""></a>
										</div>
									</div>

								</div>
							</form>
						</div>
					</div>
                </div>
            </div>
        </section>
        <section class="welcome-text-section">
            <div class="container">
                <div class="row">
					<div class="col-lg-8 mx-auto">
						<div class="welcome-text text-center">
							<h2>Get In Touch</h2>	
							<p><b>We make it easy to sell your home by connecting you with the best <br>suited agent in your area.</b></p>
							<a href="" class="green-btn mx-auto">Connect With Us</a>
							
							<div class="frame-building-img">
								<img src="img/building-frame.png" class="w-100" alt="">
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

@endsection

@section('scripts')

@endsection
