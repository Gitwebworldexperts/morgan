@extends('layouts.app')
<section class="banner inr-banner" style="background-image: url(img/inr-banner.png);">
      <div class="container">
        <div class="slider-info">
          <div class="BannerBox">
            <div class="banner-heading text-center">
              <h1>Edit Profile</h1>
            </div>
          </div>
        </div>
    </div></section>
@section('content')
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
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a></li>
            </ul>
            </div>
        </div>
         <div class="col-md-9">
             <div class="my-account-Card contact-RightSide">

    @php
        $fullName = auth()->user()->name;
        $nameParts = explode(' ', $fullName, 2); // Splitting into first and last name
        $firstName = $nameParts[0];
        $lastName = $nameParts[1] ?? ''; // Use empty string if last name is not present
    @endphp
 
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        <div class="row">
        @csrf
        <div class="col-lg-6">
		<div class="form-group">
			<label for="first_name" class="form-label">First Name</label>
							               
            <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name', $profile->first_name ?? $firstName) }}" required>
         </div>
	</div>
         <div class="col-lg-6">
		<div class="form-group">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name', $profile->last_name ?? $lastName) }}" required>
        </div>
        </div>
         <div class="col-lg-6">
		<div class="form-group">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $profile->phone ?? '') }}">
        </div>
        </div>
         <div class="col-lg-6">
		<div class="form-group">
            <label for="avatar" class="form-label">Avatar</label>
            <input type="file" name="avatar" id="avatar" class="form-control">
        </div>
        </div>
        <div class="col-lg-12">
		<div class="form-group">
            <label for="address" class="form-label">Address</label>
            <textarea name="address" id="address" class="form-control">{{ old('address', $profile->address ?? '') }}</textarea>
        </div>
        </div>
        <div class="col-lg-12">
		<div class="form-group">
        <button type="submit" class="green-btn contact-submit">Update Profile</button>
         </div>
        </div>
        </div>
    </form>
 

</div>
    </div>
</div>
</div>
</section>
@endsection
