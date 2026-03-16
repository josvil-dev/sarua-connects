@extends('layouts.app')

@section('title', 'Login | Sarua Connect')

@section('content')
<div  style="max-width: 500px; margin: 3rem auto;">
    <div style="text-align: center; margin-bottom: 2rem;">
        <h1 style="color: #666; font-size: 1.25rem;">Login</h1>
    </div>

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" class="form-control" 
                   value="{{ old('email') }}" required autofocus
                   placeholder="Enter your email address"
                   style="border-color: {{ $errors->has('email') ? '#dc3545' : '#e1e5e9' }};">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <div class="password-wrapper">
                <input type="password" id="password" name="password" class="form-control" 
                       required placeholder="Enter your password"
                       style="border-color: {{ $errors->has('password') ? '#dc3545' : '#e1e5e9' }};">
                <button type="button" class="password-toggle" onclick="togglePasswordVisibility(this)" 
                        aria-label="Show password" title="Show password">👁️</button>
            </div>
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <label style="display: flex; align-items: center; font-weight: normal; cursor: pointer;">
                <input type="checkbox" name="remember" style="margin-right: 0.5rem;">
                <span style="color: #666;">Remember me</span>
            </label>
            <a href="#" style="color: #667eea; text-decoration: none; font-size: 0.9rem;">Forgot Password?</a>
        </div>

        <button type="submit" class="btn" style="width: 100%; margin-bottom: 2rem;">
            Sign In
        </button>

        <div style="text-align: center; padding-top: 2rem; border-top: 1px solid #e9ecef;">
            <p style="color: #666; margin-bottom: 0;">
                Don't have an account? 
                <a href="{{ route('register') }}" style="color: #667eea; text-decoration: none; font-weight: 600;">Create Account</a>
            </p>
        </div>
    </form>
</div>


</div>
@endsection