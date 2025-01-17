@extends('layouts.app')
@php
    $page_name = $data['detail']->page_name ?? $data['page_title'] ?? 'My Enquiries';
@endphp

@php
 $wish = getWhishList()
@endphp

  @section('title', $page_name)
  @section('meta')
    @if(isset($data['detail']->meta_tags) && !empty($data['detail']->meta_tags))
        {!! $data['detail']->meta_tags !!}
    @endif
  @endsection
  @section('content')

      <section class="banner inr-banner" style="background-image: url('{{ asset('img/inr-banner.png') }}');">
          <div class="container">
              <div class="slider-info">
                  <div class="BannerBox">
                      <div class="banner-heading text-center">
                         <h1>My Enquiries</h1>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!-- breadcrumb -->
      <section class="breadcrumb-sec">
          <div class="container">
              <div class="row">
                  <div class="col-12">
                      <div class="bread-container">
                            <ul>
                                <li><a href="{{ route('home') }}" class="">Home</a></li>
                                <li><span class="">My Enquiries</span></li>
                            </ul>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <section class="space position-relative">
          <div class="container">
              <div class="">
                  <div class="row">
                      <div class="col-12">
                          <div class="listing-top-area-container">
                              <div class="item-counter">
                                  <p>Results: <span> {{ $inquiries ? count($inquiries) : "" }} Inquiries</span></p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-12">
                    @if(isset($inquiries) && count($inquiries))
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Contact Number</th>
                                <th scope="col">Message</th>
                                <th scope="col">Property</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inquiries as $key => $item)
                                    <tr>
                                        <th scope="row">{{ $key+1 }}</th>
                                        <td>{{ $item->full_name }}</td>
                                        <td>{{ $item->contact_number }}</td>
                                        <td>{{ $item->message }}</td>
                                        <td><a href="{{ $item->page_name }}">Click Here</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p><b>Currently, there is no inquiry associated with your email ID</b></p>
                    @endif

                </div>
              </div>
            </div>
      </section>
      @endsection
