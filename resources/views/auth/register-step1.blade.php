@extends('layouts.app')

@section('title', 'Register - Step 1 | Sarua Connect')

@section('content')
<div style="max-width: 1000px; margin: 3rem auto; padding: 2rem; background: #fff; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
    <div class="step-indicator">
        <div class="step active">
            <div class="step-number">1</div>
            <span class="step-title">Personal Info</span>
        </div>
        <div class="step">
            <div class="step-number">2</div>
            <span class="step-title">Professional Info</span>
        </div>
        <div class="step">
            <div class="step-number">3</div>
            <span class="step-title">About You</span>
        </div>
    </div>

    <h2 style="text-align: center; margin-bottom: 2rem; color: #333;">Join SARUA CONNECT</h2>
    <p style="text-align: center; margin-bottom: 2rem; color: #666;">If you are an academic scholar, researcher or postgraduate supervisor based at a higher education institution in a SADC member state, please complete the form below to join the database.</p>
    <form action="{{ route('register.step1') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="first_name">First Name *</label>
                    <input type="text" id="first_name" name="first_name" class="form-control" 
                           value="{{ old('first_name') }}" required
                           style="border-color: {{ $errors->has('first_name') ? '#dc3545' : '#e1e5e9' }};">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="last_name">Last Name *</label>
                    <input type="text" id="last_name" name="last_name" class="form-control" 
                           value="{{ old('last_name') }}" required
                           style="border-color: {{ $errors->has('last_name') ? '#dc3545' : '#e1e5e9' }};">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="email">Email Address *</label>
            <input type="email" id="email" name="email" class="form-control" 
                   value="{{ old('email') }}" required
                   style="border-color: {{ $errors->has('email') ? '#dc3545' : '#e1e5e9' }};">
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password">Password *</label>
                    <div class="password-wrapper">
                        <input type="password" id="password" name="password" class="form-control" 
                               required minlength="8"
                               style="border-color: {{ $errors->has('password') ? '#dc3545' : '#e1e5e9' }};">
                        <button type="button" class="password-toggle" onclick="togglePasswordVisibility(this)" 
                                aria-label="Show password" title="Show password">👁️</button>
                    </div>
                    <small style="color: #666; font-size: 0.85rem;">Minimum 8 characters</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password *</label>
                    <div class="password-wrapper">
                        <input type="password" id="password_confirmation" name="password_confirmation" 
                               class="form-control" required minlength="8"
                               style="border-color: {{ $errors->has('password_confirmation') ? '#dc3545' : '#e1e5e9' }};">
                        <button type="button" class="password-toggle" onclick="togglePasswordVisibility(this)" 
                                aria-label="Show password" title="Show password">👁️</button>
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-top: 2rem; margin-bottom: 2rem; background: #f8f9fa;">
        </div>
        <div class="text-center">
            <button type="submit" class="btn">SIGN UP</button>
        </div>
    </form>

    <div style="text-align: center; margin-top: 2rem;">
        <p style="color: #666;">Already have an account? 
            <a href="{{ route('login') }}" style="color: #667eea; text-decoration: none; font-weight: 600;">Login here</a>
        </p>
    </div>
</div>
@endsection