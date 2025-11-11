@extends('layouts.app')
@section('content')
    <div class="container py-4 py-md-5">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white text-center py-3 border-0">
                        <h4 class="mb-0">{{ __('Login') }}</h4>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold">
                                    {{ __('Email Address') }}
                                </label>
                                <input id="email" type="email" 
                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" 
                                    required autocomplete="email" autofocus
                                    placeholder="Email">

                                @error('email')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label fw-semibold">
                                    {{ __('Password') }}
                                </label>
                                <input id="password" type="password"
                                    class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                    name="password" required autocomplete="current-password"
                                    placeholder="Password">

                                @error('password')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" 
                                        name="remember" id="remember" 
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>

                            <div class="d-grid gap-2 mb-3">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    {{ __('Login') }}
                                </button>
                            </div>

                            @if (Route::has('password.request'))
                                <div class="text-center">
                                    <a class="text-decoration-none" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection