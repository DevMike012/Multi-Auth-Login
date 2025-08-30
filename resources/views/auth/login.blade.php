@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @php
                $role = request()->query('role', old('login_as', 'user'));
                $isAdmin = $role === 'admin';
                @endphp

                <div class="card-header">{{ $isAdmin ? __('Administrator Login') : __('User Login') }}</div>

                <div class="card-body">
                    {{-- Session Alerts --}}
                    @if(session('error'))
                    <div class="alert alert-danger mb-4">
                        {{ session('error') }}
                    </div>
                    @endif

                    @if(session('success'))
                    <div class="alert alert-success mb-4">
                        {{ session('success') }}
                    </div>
                    @endif

                    {{-- Informational alert about selected role --}}
                    @if($isAdmin)
                    <div class="alert alert-warning">You are signing in to the Admin area. Use your admin credentials.</div>
                    @endif

                    {{-- Login Form --}}
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- Log in as (role) --}}
                        {{-- Persist role selection in a hidden field so backend knows which guard/redirect to use --}}
                        <input type="hidden" name="login_as" value="{{ $role }}">

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ $isAdmin ? __('Admin Email') : __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Remember Me (only for users) --}}
                        @unless($isAdmin)
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                        </div>
                        @endunless

                        {{-- Submit Button --}}
                        <div class="mb-0">
                            <button type="submit" class="btn btn-primary w-100">
                                {{ __('Login') }}
                            </button>
                        </div>

                        {{-- Forgot Password Link --}}
                        <div class="mt-3 text-center">
                            @if (Route::has('password.request'))
                            <a class="text-decoration-none" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                            @endif
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection