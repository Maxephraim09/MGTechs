@extends('layouts.guest')

@section('title', 'Welcome Back')
@section('subtitle', 'Sign in to your account to continue')

@section('content')
    <!-- Session Status -->
    @if (session('status'))
        <div class="auth-session-status">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="auth-form">
        @csrf

        <!-- Email -->
        <div class="form-group">
            <label for="email"><i class="fas fa-envelope"></i> Email Address</label>
            <input 
                id="email" 
                type="email" 
                name="email" 
                value="{{ old('email') }}" 
                required 
                autofocus 
                autocomplete="username"
                placeholder="you@example.com"
            />
            @error('email')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password"><i class="fas fa-lock"></i> Password</label>
            <div class="input-wrapper">
                <input 
                    id="password" 
                    type="password" 
                    name="password" 
                    required 
                    autocomplete="current-password"
                    placeholder="Enter your password"
                />
                <button type="button" class="password-toggle" onclick="togglePassword()">
                    <i class="fas fa-eye" id="passwordToggleIcon"></i>
                </button>
            </div>
            @error('password')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember & Forgot -->
        <div class="auth-options">
            <label class="remember-me">
                <input type="checkbox" name="remember" />
                <span>Remember me</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="forgot-link">
                    Forgot password?
                </a>
            @endif
        </div>

        <!-- Submit -->
        <button type="submit" class="btn-auth">
            <i class="fas fa-sign-in-alt"></i> Sign In
        </button>
    </form>

    <!-- Divider -->
    <div class="auth-divider">
        <span>Or continue with</span>
    </div>

    <!-- Social Login -->
    <div class="social-buttons">
        <button class="social-btn google"><i class="fab fa-google"></i></button>
        <button class="social-btn facebook"><i class="fab fa-facebook"></i></button>
        <button class="social-btn github"><i class="fab fa-github"></i></button>
    </div>

    <!-- Auth Footer -->
    <div class="auth-footer">
        <p>
            Don't have an account? 
            <a href="{{ route('register') }}">Create Account</a>
        </p>
        <a href="{{ route('home') }}" class="back-home">
            <i class="fas fa-arrow-left"></i> Back to Home
        </a>
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const icon = document.getElementById('passwordToggleIcon');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
@endsection