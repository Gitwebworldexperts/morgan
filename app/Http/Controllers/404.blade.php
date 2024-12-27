@extends('layouts.app')
@section('title', "404 Page Not Found")
@section('content')
    <!-- breadcrumb -->
    <section class="breadcrumb-sec">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-container">
                        <ul>
                            <li><a href="{{ asset('/') }}" class="">Home</a></li>
                            <li><a href="javascript:void(0)" class="">404</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="error-page space" style="background-image: url({{asset('img/error-bg.png')}});">
            <div class="container">
                <div class="error-main">
					<div class="row no-gutters">
							<div class="col-lg-6 col-md-12 ml-auto">
								<div class="errot-content-box">
										<h1>404</h1>
										<h3>Page not found</h3>
										<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.</p>
										<a href="{{ asset('/') }}" class="green-btn">Back to home</a>
								</div>
							</div>
						</div>
					</div>			
                </div>
            
        </section>

    @endsection
