@extends('layouts.app')
<section class="breadcrumb-sec">
          <div class="container">
              <div class="row">
                  <div class="col-12">
                      <div class="bread-container">
                            <ul>
                                <li><a href="{{ route('home') }}" class="">Home</a></li>
                                <li><span class="">Reset Password</span></li>
                            </ul>
                      </div>
                  </div>
              </div>
          </div>
      </section>
@section('content')
<section class="login-page space">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-lg-6">
                <div class="login-img">
                    <img src="{{ assets('img/login-image.png') }}" alt="morgan" class="w-100" />
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login-from">
                    <h2 class="mb-2">{{ __('Reset Password') }}</h2>
                    <p class="mb-4">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.</p>
                    
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
    
                    
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email">{{ __('Email Address') }}</label>

                           
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </div>

                       <div class="form-group">
                                <button type="submit" class="green-btn submit-btn">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                    </form>
                   
                </div>
            </div>
        </div>
    </div>
</section>
 
@endsection
