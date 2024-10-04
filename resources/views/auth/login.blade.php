@extends('layouts.app')

@section('content')

<section class="breadcrumb-sec">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-container">
                    <ul>
                        <li><a href="" class="">Home</a></li>
                        <li><a href="" class="">Login</a></li>
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
                            <img src="img/login-image.png" alt="" class="w-100">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="login-from">
                            <h2 class="mb-2">{{ __('Login') }}</h2>
                            <p class="mb-4">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.</p>
                            
                            <div class="login-google-btn">
                                <a href="{{ route('google.redirect') }}" class="border-btn"><img src="img/google.svg" width="24" class="" alt=""> Login with google</a>
                            </div>
                            
                            <div class="or-separator">
                                <span>or login with email</span>
                            </div>
                            
                            <form method="POST" action="{{ route('login') }}">
                            @csrf

                                <div class="form-group"> 
                                    <label>Username</label> 
                                    <input class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="example@gmail.com" autocomplete="email" autofocus type="email"> 
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="form-group"> 
                                    <label>Password </label> 
                                    <input class="form-control  @error('password') is-invalid @enderror" type="password" placeholder="*****************" name="password" required autocomplete="current-password" > 
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <div class="forgot-remember">
                                        <div class="remember-pas">
                                            <label><input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }} </label>
                                        </div>
                                        <div class="forgot-pas">
                                        @if (Route::has('password.request'))
                                            <a class="" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <button type="submit" class="green-btn submit-btn">
                                    {{ __('Login') }} <img src="img/arrow-right3.svg" class="">
                                    </button>
                                </div>
                                
                                <div class="already-member text-center">
                                    <p>Don’t have an account? <a href="{{ route('register') }}" class="link-btn">SignUp</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <a id="back2Top" class="top-scroll" title="Back to top" href="#" style=""><img src="img/arrow-right.svg" class=""></a>

@endsection
