@extends('layouts.app')
@section('title', "Thank You  – Morgan’s International Realty")
@section('content')
    <!-- breadcrumb -->
    <section class="breadcrumb-sec">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-container">
                        <ul>
                            <li><a href="{{ asset('/') }}" class="">Home</a></li>
                            <li><a href="javascript:void(0)" class="">Thank You</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="error-page space" style="">
            <div class="container">
                <div class="error-main">
					<div class="row no-gutters">
							<div class="col-lg-6 col-md-12 mx-auto">
								<div class="errot-content-box text-center">
										<!-- <h1></h1> -->
										<img src="{{ asset('img/checked.png') }}" alt="thanks">
										<h3 style="font-size:50px;">Thank you</h3>
										<p><b>For contact with us. We will get back to you soon.</b></p>
										@if(isset($download_url) && $download_url)
                                            <a href="{{ asset($download_url) }}" download class="green-btn mx-auto">Download</a>
                                            <script>
                                                window.onload = function () {
                                                    // Define the download URL
                                                    const downloadUrl = "{{ asset($download_url) }}";

                                                    // Create a temporary anchor element
                                                    const a = document.createElement("a");
                                                    a.href = downloadUrl; // Set the URL
                                                    a.download = ""; // Set the `download` attribute to prompt a download
                                                    document.body.appendChild(a); // Append the anchor to the document

                                                    a.click(); // Trigger the click event
                                                    document.body.removeChild(a); // Clean up by removing the anchor element
                                                };
                                            </script>
                                            @else
                                            <a href="{{ asset('/') }}" class="green-btn mx-auto">Back to home</a>

                                        @endif
								</div>
							</div>
						</div>
					</div>			
                </div>
            
        </section>

        <style>
            .error-page .error-main .errot-content-box > img {
    max-width: 40px;
    margin: 0 auto;
    margin-bottom: 40px;
}
        </style>

    @endsection
