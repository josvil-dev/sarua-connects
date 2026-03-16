@extends('layouts.app')

@section('title', 'Register - Step 3 | Sarua Connect')

@section('content')
<div style="max-width: 1000px; margin: 3rem auto; padding: 2rem; background: #fff; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
    <div class="step-indicator">
        <div class="step completed">
            <div class="step-number">✓</div>
            <span class="step-title">Personal Info</span>
        </div>
        <div class="step completed">
            <div class="step-number">✓</div>
            <span class="step-title">Professional Info</span>
        </div>
        <div class="step active">
            <div class="step-number">3</div>
            <span class="step-title">Consent</span>
        </div>
    </div>

    <form action="{{ route('register.step3') }}" method="POST">
        @csrf
        <div class="form-group">
            <label class="checkbox-label" style="font-weight: normal;">
                <input type="checkbox" name="consent" value="1" 
                       {{ old('consent') ? 'checked' : '' }} required>
                <span class="checkmark"></span>
                I agree to have my information stored and used by SARUA for the purposes of this regional database. *
            </label>
        </div>

        <div style="margin-top: 2rem; margin-bottom: 2rem; background: #f8f9fa; padding: 1rem; border-radius: 8px;">
            <p style="margin: 0; color: #333;"><strong>Your data and privacy</strong></p>
            <p style="margin: 0.5rem 0 0 0; color: #666; font-size: 0.95rem;">All personal data submitted is handled in accordance with SARUA's data governance and privacy policies. You control how your information is shared, and only selected details will be visible in the public directory.</p>
        </div>

        <div class="text-center">
            <a href="{{ route('register.step2') }}" class="btn btn-secondary" style="margin-right: 1rem;">Back</a>
            <button type="submit" class="btn">Complete Registration</button>
        </div>
    </form>
</div>

<style>
    .checkbox-label {
        display: flex;
        align-items: flex-start;
        cursor: pointer;
        padding: 1rem;
        border-radius: 8px;
        transition: background-color 0.2s;
        margin-bottom: 0;
        line-height: 1.4;
        font-weight: normal;
        background: #f8f9fa;
        border: 1px solid #e1e5e9;
        font-size: 0.95rem;
        color: #333;
    }

    .checkbox-label:hover {
        background: #e9ecef;
        border-color: #667eea;
    }

    .checkbox-label input[type="checkbox"] {
        margin: 0 0.75rem 0 0;
        transform: scale(1.2);
        accent-color: #667eea;
    }

    .checkbox-label .checkmark {
        margin-left: 0.5rem;
        flex-grow: 1;
    }
</style>
@endsection