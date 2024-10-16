@extends('layouts.app')

@section('content')
<section class="breadcrumb-sec">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-container">
                    <ul>
                        <li><a href="" class="">Home</a></li>
                        <li><a href="" class="">Register</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="login-page space">
    <div class="container">
        <div class="row no-gutters ">
            <div class="col-lg-6">
                <div class="login-img">
                    <img src="img/register.png" alt="" class="w-100">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login-from">
                    <h2 class="mb-2">{{ __('Register') }}</h2>
                    <p class="mb-4">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.</p>

                    
                     <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <input type="hidden" name="type" value="basic">
                        <div class="form-group"> 
                            <label>Name</label> 
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required placeholder="John Doe" autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group"> 
                            <label>Email </label> 
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="example@gmail.com" autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group"> 
                            <label>Password </label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="*****************">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror 
                        </div>
                        
                        <div class="form-group"> 
                            <label>Confirm Password </label> 
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="*****************" required autocomplete="new-password">
                        </div>
                        
                        <div class="form-group"> 
                             <button type="submit" class="green-btn submit-btn">
                                    {{ __('Register') }}
                                    <img src="img/arrow-right3.svg" class="">
                                </button> 
                        </div>
                        
                        <div class="already-member text-center">
                            <p>Already a user? <a href="{{ route('login') }}" class="link-btn">Login</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<a id="back2Top" class="top-scroll" title="Back to top" href="#" style="display: none;"><img src="img/arrow-right.svg" class=""></a>

@endsection
