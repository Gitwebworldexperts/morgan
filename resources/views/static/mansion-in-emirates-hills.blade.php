@extends('layouts.app')
@section('title', 'Mansion in emirates hills')
@section('content')
<section class="banner inr-banner mb-4" style="background-image: url({{ asset('/img/inr-banner.png') }});">
    <div class="container">
        <div class="slider-info">
            <div class="BannerBox">
                <div class="banner-heading text-center">
                    <h1>@yield('title')</h1>
                </div>
            </div>
        </div>
    </div>
</section>
    <div class="container mb-4">
        <div class="row">
            <div class="col-12">
                    
            </div>
        </div>
    </div>
@endsection