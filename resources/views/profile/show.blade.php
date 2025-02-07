@extends('layouts.app')      
@section('content')

<section class="banner inr-banner" style="background-image: url(img/inr-banner.png);">
      <div class="container">
        <div class="slider-info">
          <div class="BannerBox">
            <div class="banner-heading text-center">
              <h1>Profile</h1>
            </div>
          </div>
        </div>
    </div></section>
<section class="breadcrumb-sec">
          <div class="container">
              <div class="row">
                  <div class="col-12">
                      <div class="bread-container">
                            <ul>
                                <li><a href="{{ route('home') }}" class="">Home</a></li>
                                <li><span class="">My Profile</span></li>
                            </ul>
                      </div>
                  </div>
              </div>
          </div>
      </section>
<section class="space">
<div class="container"> 
<div class="row">
    <div class="col-md-3">
        <div class="ProfileSidebar">
            <h3>My Account</h3>
            <ul>
                <li><a href="{{ route('profile.show') }}">Profile</a></li>
                <li><a href="{{ route('wishlist.index') }}">My Favourites</a></li>
                <li><a href="{{ route('my.inquiries') }}">My Enquiries</a></li>
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
            </ul>
            </div>
        </div>
         <div class="col-md-9">
             <div class="my-account-Card">
    @php
        $fullName = auth()->user()->name;
        $nameParts = explode(' ', $fullName, 2); // Splitting into first and last name
        $firstName = $nameParts[0];
        $lastName = $nameParts[1] ?? ''; // Use empty string if last name is not present
    @endphp
    <div class="Profile">
    <div class="row">
        <div class="col-md-8 col-8">
            <div class="profile-details-heading">
                <h3>Profile Details</h3>
                </div>
            </div>
            <div class="col-md-4 col-4 text-right">
    <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
    </div>
    </div>
    </div>
     <table class="table table-striped">
     
    <tbody>
      <tr>
        <td>Name</td>
        <td>{{ $profile->first_name ?? $firstName }} {{ $profile->last_name ?? "" }}</td>
         
      </tr>
      <tr>
        <td>Phone</td>
        <td>{{ $profile->phone ?? "" }}</td>
        
      </tr>
      <tr>
        <td>Address</td>
        <td>{!! strip_tags($profile->address ?? "") !!}</td>
        
      </tr>
      <tr>
        <td>Avatar</td>
        <td> @if (isset($profile->avatar) && $profile->avatar)
        <img src="{{ asset( $profile->avatar) }}" alt="Avatar" width="150">
    @else
        <p>No avatar uploaded</p>
    @endif</td>
        
      </tr>
    </tbody>
  </table>
    
    </div>
    </div>
</div>
</div>
</section>
<style>
  .my-account-Card .table tr td:first-child {
    width: 15%;
  }
</style>
@endsection
