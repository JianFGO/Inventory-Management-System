@extends('layouts.auth')

{{-- Browser tab title --}}
@section('title', 'Login')

@section('content')
    <main class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-5 offset-lg-5 col-xl-4 offset-xl-4">
                    <div class="branding text-center mb-4">
                        <h1 style="font-weight: bold; font-size: 26px; color: #333;">Candy Atlas</h1>
                    </div>

                    <div class="card card-primary">
                        <div class="card-header">
                            <h2>Login</h2>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <label for="email" class="col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <label for="password" class="col-form-label text-md-end">{{ __('Password') }}</label>

                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label style="font-weight: normal" class="form-check-label" for="remember">
                                        {{ __('Remember me') }}
                                    </label>
                                </div>

                                <div class="form-group">
                                    <button type="submit" style="font-size: 16px" class="btn btn-primary btn-lg btn-block">
                                        Login
                                    </button>
                                </div>
                            </form>

                            <div class="text-center mt-3">
                                <a style="color: darkblue" href="{{ route('password.request') }}">Forgot Your Password?</a>
                            </div>

                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        No account yet? Reach out to an admin to create one.
                    </div>
                    <div class="simple-footer">
                        Copyright &copy; Stisla 2018
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
