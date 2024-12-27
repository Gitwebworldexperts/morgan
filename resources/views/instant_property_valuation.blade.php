@extends('layouts.app')
@section('title', $foundProperty['page_title'] ?? '')
@section('meta')

@endsection
@section('content')

<section class="breadcrumb-sec">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="bread-container">
                            <ul>
                                <li><a href="" class="">Home</a></li>
                                <li><a href="" class="">Property Valuation</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="valuation-steps-sec bg-brown space">
            <div class="container">
                <div class="row">
					<div class="col-lg-8 mx-auto">
						<div class="col-12">
							<div class="valuation-head text-center">
								<h3>Get your instant property valuation</h3>
								<p>Get an approximate valuation in a matter of minutes.</p>
							</div>
						</div>
						
						<div class="col-12">
							<div class="steps-main">
								<div class="progress-container">
									<div class="progress" id="progress" style="width: 33.3333%;"></div>
									<div class="circle active"></div>
									<div class="circle active"></div>
									<div class="circle"></div>
									<div class="circle"></div>
								</div>
							</div>
						</div>
						
						
						<div class="col-12">
							<div class="steps-form step-1-form">
								<div class="step-form-head">
									<h3>Find your property</h3>
									<p>In 4 easy steps, you can get an instant property valuation powered by Property Monitor. We will also send you a six page detailed report via email, including recent property sales, live listings and Dubai market trends.</p>
								</div>
								<form action="">
									<div class="form-group">
										<label>Search by Community/Tower name</label>
										<select class="form-control" name="">
											<option>Silicon Avenue, Dubai Silicon Oasis</option>
											<option>Silicon Avenue, Dubai Silicon Oasis</option>
										</select>
									</div>
									<div class="form-group">
										<label>Search by Community/Tower name</label>
										<select class="form-control" name="">
											<option>Silicon Avenue, Dubai Silicon Oasis</option>
											<option>Silicon Avenue, Dubai Silicon Oasis</option>
										</select>
									</div>
									<div class="form-group mb-0">
										<a href="" class="green-btn">Next Step <img src="img/arrow-right3.svg" class=""></a>
									</div>
								</form>
							</div>
						</div>
						
						
					</div>
                </div>
            </div>
		<br>
        </section>


@endsection

@section('scripts')

@endsection
