@extends('layouts.guest')

@section('title', 'Create Account')
@section('subtitle', 'Join MGTECHS and start your journey')

@section('content')
    <form method="POST" action="{{ route('register') }}" class="auth-form">
        @csrf

        <!-- Name -->
        <div class="form-group">
            <label for="name"><i class="fas fa-user"></i> Full Name</label>
            <input 
                id="name" 
                type="text" 
                name="name" 
                value="{{ old('name') }}" 
                required 
                autofocus 
                autocomplete="name"
                placeholder="John Doe"
            />
            @error('name')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email"><i class="fas fa-envelope"></i> Email Address</label>
            <input 
                id="email" 
                type="email" 
                name="email" 
                value="{{ old('email') }}" 
                required 
                autocomplete="username"
                placeholder="you@example.com"
            />
            @error('email')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Phone -->
        <div class="form-group">
            <label for="phone"><i class="fas fa-phone"></i> Phone Number</label>
            <input 
                id="phone" 
                type="tel" 
                name="phone" 
                value="{{ old('phone') }}" 
                placeholder="08012345678"
            />
            @error('phone')
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
                    autocomplete="new-password"
                    placeholder="Minimum 8 characters"
                />
                <button type="button" class="password-toggle" onclick="togglePassword('password', 'passwordToggleIcon')">
                    <i class="fas fa-eye" id="passwordToggleIcon"></i>
                </button>
            </div>
            @error('password')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <label for="password_confirmation"><i class="fas fa-check-circle"></i> Confirm Password</label>
            <div class="input-wrapper">
                <input 
                    id="password_confirmation" 
                    type="password" 
                    name="password_confirmation" 
                    required 
                    autocomplete="new-password"
                    placeholder="Confirm your password"
                />
                <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation', 'confirmToggleIcon')">
                    <i class="fas fa-eye" id="confirmToggleIcon"></i>
                </button>
            </div>
        </div>

        <!-- Role -->
        <div class="form-group">
            <label for="role"><i class="fas fa-user-tag"></i> I am a</label>
            <select id="role" name="role">
                <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
                <option value="client" {{ old('role') == 'client' ? 'selected' : '' }}>Client</option>
            </select>
            @error('role')
                <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Terms -->
        <div class="terms-check">
            <input type="checkbox" id="terms" name="terms" required />
            <label for="terms">
                I agree to the 
                <a href="#">Terms of Service</a> 
                and 
                <a href="#">Privacy Policy</a>
            </label>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn-auth">
            <i class="fas fa-user-plus"></i> Create Account
        </button>
    </form>

    <!-- Auth Footer -->
    <div class="auth-footer">
        <p>
            Already have an account? 
            <a href="{{ route('login') }}">Sign In</a>
        </p>
        <a href="{{ route('home') }}" class="back-home">
            <i class="fas fa-arrow-left"></i> Back to Home
        </a>
    </div>

    <script>
        function togglePassword(fieldId, iconId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(iconId);
            
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
@endsection