@extends('layouts.app')

@section('content')
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <div class="mb-md-5 mt-md-4 pb-5">

                            <h2 class="fw-bold mb-2 text-uppercase">{{ __('Login') }}</h2>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-outline form-white mb-4">
                                    <input id="email" type="email"
                                           class="form-control form-control-lg @error('email') is-invalid @enderror"
                                           name="email" value="{{ old('email') }}" required autocomplete="email"
                                           autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label class="form-label" for="typeEmailX">{{ __('E-Mail Address') }}</label>
                                </div>

                                <div class="form-outline form-white mb-4">
                                    <input id="password" type="password"
                                           class="form-control form-control-lg @error('password') is-invalid @enderror"
                                           name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label class="form-label" for="typePasswordX">{{ __('Password') }}</label>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                   id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>


                                <button class="btn btn-outline-light btn-lg px-5"
                                        type="submit">{{ __('Login') }}</button>


                        </div>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif

                        <div>
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
