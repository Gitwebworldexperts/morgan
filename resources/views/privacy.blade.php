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
                        <li><a href="" class="">Privacy Policy</a></li>
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

<section class="content-section space">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="content-wrapper">
							@if (isset($privacy_policy) && !empty($privacy_policy)  && $privacy_policy)
								{!! $privacy_policy->page_content !!}
							@endif
						</div>
					</div>
				</div>
			</div>
		</section>

@endsection