@extends('layouts.app')

@php
  $page_name = $data['detail']->page_name ?? $data['page_title'] ?? 'Blog Detail Page';
    if(isset($post->meta_title) && !empty($post->meta_title)){
        $page_name = $post->meta_title;
    }
@endphp


@section('title', $page_name)
@section('meta')
  @if(isset($data['detail']->meta_tags) && !empty($data['detail']->meta_tags))
    {!! $data['detail']->meta_tags !!}
  @endif
  @if(isset($post->meta_title) && !empty($post->meta_title))
    <meta property="og:title" content="{{$page_name}}" />
  @endif
  @if(isset($post->meta_description) && !empty($post->meta_description))
    <meta name="description" content="{{ $post->meta_description }}" />
    <meta property="og:description" content="{{ $post->meta_description }}" />
  @endif
@endsection
@section('content')
    <!-- breadcrumb -->
    <section class="breadcrumb-sec">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-container">
                        <ul>
                            <li><a href="{{ asset('/') }}" class="">Home</a></li>
                            <li><span>The Market</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="space blog-detail-page">
            <div class="container">
                <div class="row">
                    
                @php
                    if(!(isset($post->tags) && !empty($post->tags) && count($post->tags)) && !(isset($relatedPost) && !empty($relatedPost) && count($relatedPost))){
                        $class = "col-lg-12";                    
                    }else{
                        $class = "col-lg-8";
                    }
                @endphp

                    <div class="{{ $class ?? 'col-lg-8' }}">
						<div class="content-wrapper">
							<div class="share-blog">
								<a href="" class="green-btn d-none"><img src="{{ asset('img/share.svg') }}" alt="">Share</a>

                                <div class="dropdown share dropdown social_share">
                                    <a href="javascript:void(0);" class="green-btn"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="{{ asset('img/share.svg') }}" alt="">Share
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#" onclick="copyCurrentUrl(event)">
                                                <i class="fa-solid fa-copy"></i>
                                                Current Page URL
                                            </a>
                                            <!-- Facebook Share Button -->
                                            <a class="dropdown-item" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank">
                                                <i class="fa-brands fa-facebook"></i>
                                                Share on Facebook
                                            </a>

                                            <!-- Twitter Share Button -->
                                            <a class="dropdown-item" href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text=Check%20this%20out!" target="_blank">
                                                <i class="fa-brands fa-square-twitter"></i>
                                                Share on Twitter
                                            </a>

                                            <!-- LinkedIn Share Button -->
                                            <a class="dropdown-item" href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}" target="_blank">
                                                <i class="fa-brands fa-linkedin"></i>
                                                Share on LinkedIn
                                            </a>

                                            <!-- WhatsApp Share Button -->
                                            <a class="dropdown-item" href="https://wa.me/?text={{ urlencode(url()->current()) }}" target="_blank">
                                                <i class="fa-brands fa-square-whatsapp"></i>
                                                Share on WhatsApp
                                            </a>

                                    </div>
                                </div>


							</div>
							<div class="seperator"></div>
                            @php 
                                $imageLinks = $post->images;
                                $imageArray = explode(',', $imageLinks);
                                $firstImage = isset($imageArray[0]) ? $imageArray[0] : null;
                            @endphp
                            @if($firstImage)
                            <img alt="Image not found" onerror="this.parentNode.removeChild(this);" src="{{ asset('post/'.$firstImage) }}" class="w-100">
                            @endif
							<h2>{{ $post->name }}</h2>
                            {!! descriptionWithImages($post->description) !!}
  							
                            @include('blog_faq')

							
							
							
						</div>
                    </div>
					<div class="col-lg-4">
						<div class="blog-detail-right">
						<div class="blog-thubnails">
							
                            @if(isset($relatedPost) && !empty($relatedPost) && count($relatedPost))
                            <div class="sub-head">
								<h3>Related Posts</h3>
							</div>
                            @foreach($relatedPost as $item)
                                @php 
                                    $imageLinks = $item->images;

                                    $imageArray = explode(',', $imageLinks);

                                    $firstImage = isset($imageArray[0]) ? $imageArray[0] : null;
                                @endphp
                                <div class="blog-thumbnail-box">
                                    <figure>
                                        <a href="{{ $item->slug ? route('blog', ['slug' => $item->slug]) : '#' }}"><img src="{{ asset('post/'.$firstImage) }}" alt=""></a>
                                    </figure>
                                    <figcaption>
                                        <span>{{ $item->created_at->format('d M Y') }}</span>
                                        <a href="{{ $item->slug ? route('blog', ['slug' => $item->slug]) : '#' }}"><h4>{{ $item->name }}</h4></a>
                                    </figcaption>
                                </div>
                            @endforeach
                            @endif

						</div>
                        @if(isset($post->tags) && !empty($post->tags) && count($post->tags))
						<div class="related-tags">
							<div class="sub-head">
								<h3>Related Tags</h3>
							</div>
							<ul>
                                @foreach($post->tags as $tag)
                                    <li><a href="">{{ $tag->name }}</a></li>
                                @endforeach
							</ul>
						</div>
                        @endif
						</div>
						
						
                    </div>
                </div>
            </div>

    
    </section>


    <style>       
    .blog-detail-page .content-wrapper img {
        width: 100%;
        border-radius: 1rem;
        height: auto;
    }
    .dropdown.share.dropdown.social_share .dropdown-menu {
        padding: 15px 0;
    }
    </style>
    @endsection
    @section('scripts')
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const accordion = document.getElementById("accordionExample");
        const faqHeading = document.querySelector(".blog-faqs h4");

        if (accordion && faqHeading) {
            if (accordion.children.length === 0) {
                faqHeading.style.display = "none";
            }
        }
    });

    function copyCurrentUrl(event) {
        event.preventDefault(); // Prevent the default action
        const currentUrl = window.location.href; // Get the current page URL
        navigator.clipboard.writeText(currentUrl) // Copy URL to clipboard
            .then(() => alert('URL copied to clipboard!')) // Success message
            .catch(err => alert('Failed to copy URL: ' + err)); // Error handling
    }
    </script>
    @endsection