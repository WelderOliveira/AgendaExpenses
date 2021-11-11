@extends('layouts.app')

@section('content')
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card bg-dark text-white" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">{{ __('Register') }}</h2>

                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="form-outline mb-4">
                                    <input id="name" type="text"
                                           class="form-control form-control-lg @error('name') is-invalid @enderror"
                                           name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label class="form-label" for="form3Example1cg">{{ __('Name') }}</label>
                                </div>

                                <div class="form-outline mb-4">
                                    <input id="email" type="email"
                                           class="form-control form-control-lg @error('email') is-invalid @enderror"
                                           name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label class="form-label" for="form3Example3cg">{{ __('E-Mail Address') }}</label>
                                </div>

                                <div class="form-outline mb-4">
                                    <input id="password" type="password"
                                           class="form-control form-control-lg @error('password') is-invalid @enderror"
                                           name="password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label class="form-label" for="form3Example4cg">{{ __('Password') }}</label>
                                </div>

                                <div class="form-outline mb-4">
                                    <input id="password-confirm" type="password" class="form-control form-control-lg"
                                           name="password_confirmation" required autocomplete="new-password">
                                    <label class="form-label"
                                           for="form3Example4cdg">{{ __('Confirm Password') }}</label>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit"
                                            class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">                                    {{ __('Register') }}
                                    </button>
                                </div>

                                <p class="text-center text-muted mt-5 mb-0">Já é Cadastrado? <a class="nav-link"
                                                                                                href="{{ route('login') }}">{{ __('Login') }}</a>
                                </p>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
