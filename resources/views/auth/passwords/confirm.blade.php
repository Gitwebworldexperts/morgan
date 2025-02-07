@extends('layouts.app')
<section class="breadcrumb-sec">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-container">
                    <ul>
                    <li><a href="{{ route('home') }}" class="">Home</a></li>
                        <li><span href="" class="">Reset Password</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@section('content')
<section class="login-page space">
            <div class="container">
                <div class="row no-gutters ">
                    <div class="col-lg-6">
                        <div class="login-img">
                            <img src="img/login-image.png" alt="morgan" class="w-100">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="login-from">
                            <h2 class="mb-2">Reset Password</h2>
                            <p class="mb-4">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.</p>
                            
                            
                            
                       
                            <form method="POST" action="https://myprojectdemonstration.net/development/morgan/web/login">
                            <input type="hidden" name="_token" value="2OVmQwNT5xQIEcNuM2v2RDmTyTz1Xl4fOoesbfNS" autocomplete="off">                                <input type="hidden" name="type" value="basic">
                                <div class="form-group"> 
                                    <label>Username</label> 
                                    <input class="form-control " name="email" value="" placeholder="example@gmail.com" autocomplete="email" autofocus="" type="email"> 
                                                                    </div>
                                
                                <div class="form-group"> 
                                    <label>Password </label> 
                                    <input class="form-control  " type="password" placeholder="*****************" name="password" required="" autocomplete="current-password"> 
                                                                    </div>
                                
                                <div class="form-group">
                                    <div class="forgot-remember">
                                        <div class="remember-pas">
                                            <label><input type="checkbox" name="remember" id="remember"> Remember Me </label>
                                        </div>
                                        <div class="forgot-pas">
                                                                                    <a class="" href="https://myprojectdemonstration.net/development/morgan/web/password/reset">
                                                Forgot Your Password?
                                            </a>
                                                                                </div>
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <button type="submit" class="green-btn submit-btn">
                                    Login <img src="img/arrow-right3.svg" class="" alt="morgan">
                                    </button>
                                </div>
                                
                                <div class="already-member text-center">
                                    <p>Don’t have an account? <a href="https://myprojectdemonstration.net/development/morgan/web/register" class="link-btn">SignUp</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Confirm Password') }}</div>

                <div class="card-body">
                    {{ __('Please confirm your password before continuing.') }}

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirm Password') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
