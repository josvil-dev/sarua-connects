@extends('layouts.app')

@section('title', 'Edit Profile | Sarua Connect')

@section('content')
<div class="card">
    <div style="text-align: center; margin-bottom: 2rem;">
        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); width: 80px; height: 80px; border-radius: 50%; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center;">
            <span style="color: white; font-size: 2rem;">✏️</span>
        </div>
        <h2 style="color: #333; margin-bottom: 0.5rem;">Edit Your Profile</h2>
        <p style="color: #666;">Update your information and keep your profile current</p>
    </div>

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Personal Information Section -->
        <div style="background: #f8f9fa; padding: 1.5rem; ">
            <h4 style="color: #667eea; margin-bottom: 1.5rem;">👤 Personal Information</h4>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="first_name">First Name *</label>
                        <input type="text" id="first_name" name="first_name" class="form-control" 
                               value="{{ old('first_name', Auth::user()->first_name) }}" required
                               style="border-color: {{ $errors->has('first_name') ? '#dc3545' : '#e1e5e9' }};">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="last_name">Last Name *</label>
                        <input type="text" id="last_name" name="last_name" class="form-control" 
                               value="{{ old('last_name', Auth::user()->last_name) }}" required
                               style="border-color: {{ $errors->has('last_name') ? '#dc3545' : '#e1e5e9' }};">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email Address *</label>
                <input type="email" id="email" name="email" class="form-control" 
                       value="{{ old('email', Auth::user()->email) }}" required
                       style="border-color: {{ $errors->has('email') ? '#dc3545' : '#e1e5e9' }};">
            </div>
        </div>

        <!-- Professional Information Section -->
        <div style="background: #f0f8ff; padding: 1.5rem; ">
            <h4 style="color: #28a745; margin-bottom: 1.5rem;">💼 Professional Information</h4>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">Title *</label>
                        <select id="title" name="title" class="form-control" required
                                style="border-color: {{ $errors->has('title') ? '#dc3545' : '#e1e5e9' }};">
                            <option value="">Select Title</option>
                            <option value="Mr." {{ old('title', Auth::user()->title) == 'Mr.' ? 'selected' : '' }}>Mr.</option>
                            <option value="Mrs." {{ old('title', Auth::user()->title) == 'Mrs.' ? 'selected' : '' }}>Mrs.</option>
                            <option value="Ms." {{ old('title', Auth::user()->title) == 'Ms.' ? 'selected' : '' }}>Ms.</option>
                            <option value="Dr." {{ old('title', Auth::user()->title) == 'Dr.' ? 'selected' : '' }}>Dr.</option>
                            <option value="Prof." {{ old('title', Auth::user()->title) == 'Prof.' ? 'selected' : '' }}>Prof.</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="highest_qualification">Highest Qualification *</label>
                        <select id="highest_qualification" name="highest_qualification" class="form-control" required
                                style="border-color: {{ $errors->has('highest_qualification') ? '#dc3545' : '#e1e5e9' }};">
                            <option value="">Select Qualification</option>
                            <option value="High School" {{ old('highest_qualification', Auth::user()->highest_qualification) == 'High School' ? 'selected' : '' }}>High School</option>
                            <option value="Bachelor's Degree" {{ old('highest_qualification', Auth::user()->highest_qualification) == "Bachelor's Degree" ? 'selected' : '' }}>Bachelor's Degree</option>
                            <option value="Master's Degree" {{ old('highest_qualification', Auth::user()->highest_qualification) == "Master's Degree" ? 'selected' : '' }}>Master's Degree</option>
                            <option value="PhD" {{ old('highest_qualification', Auth::user()->highest_qualification) == 'PhD' ? 'selected' : '' }}>PhD</option>
                            <option value="Professional Certificate" {{ old('highest_qualification', Auth::user()->highest_qualification) == 'Professional Certificate' ? 'selected' : '' }}>Professional Certificate</option>
                            <option value="Other" {{ old('highest_qualification', Auth::user()->highest_qualification) == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="institution">Institution *</label>
                <input type="text" id="institution" name="institution" class="form-control" 
                       value="{{ old('institution', Auth::user()->institution) }}" required 
                       placeholder="e.g., University of Rwanda"
                       style="border-color: {{ $errors->has('institution') ? '#dc3545' : '#e1e5e9' }};">
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="job_title">Current Job Title *</label>
                        <input type="text" id="job_title" name="job_title" class="form-control" 
                               value="{{ old('job_title', Auth::user()->job_title) }}" required 
                               placeholder="e.g., Software Developer"
                               style="border-color: {{ $errors->has('job_title') ? '#dc3545' : '#e1e5e9' }};">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="country">Country *</label>
                        <select id="country" name="country" class="form-control" required
                                style="border-color: {{ $errors->has('country') ? '#dc3545' : '#e1e5e9' }};">
                            <option value="">Select Country</option>
                            <option value="Rwanda" {{ old('country', Auth::user()->country) == 'Rwanda' ? 'selected' : '' }}>Rwanda</option>
                            <option value="Kenya" {{ old('country', Auth::user()->country) == 'Kenya' ? 'selected' : '' }}>Kenya</option>
                            <option value="Uganda" {{ old('country', Auth::user()->country) == 'Uganda' ? 'selected' : '' }}>Uganda</option>
                            <option value="Tanzania" {{ old('country', Auth::user()->country) == 'Tanzania' ? 'selected' : '' }}>Tanzania</option>
                            <option value="Ethiopia" {{ old('country', Auth::user()->country) == 'Ethiopia' ? 'selected' : '' }}>Ethiopia</option>
                            <option value="South Africa" {{ old('country', Auth::user()->country) == 'South Africa' ? 'selected' : '' }}>South Africa</option>
                            <option value="Nigeria" {{ old('country', Auth::user()->country) == 'Nigeria' ? 'selected' : '' }}>Nigeria</option>
                            <option value="Ghana" {{ old('country', Auth::user()->country) == 'Ghana' ? 'selected' : '' }}>Ghana</option>
                            <option value="Other" {{ old('country', Auth::user()->country) == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="photo">Profile Photo</label>
                        @if(Auth::user()->photo)
                            <div style="margin-bottom: 1rem;">
                                <img src="{{ Storage::url(Auth::user()->photo) }}" alt="Current Photo" 
                                     style="width: 100px; height: 100px; object-fit: cover; border-radius: 10px; border: 2px solid #e1e5e9;">
                                <p style="font-size: 0.85rem; color: #666; margin-top: 0.5rem;">Current photo - upload a new one to replace</p>
                            </div>
                        @endif
                        <div class="file-input-wrapper">
                            <input type="file" id="photo" name="photo" class="file-input" 
                                   accept="image/jpeg,image/png,image/jpg,image/gif">
                            <label for="photo" class="file-input-label">
                                📸 {{ Auth::user()->photo ? 'Change photo' : 'Upload photo' }}<br>
                                <small style="color: #666;">Max 2MB (JPG, PNG, GIF)</small>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cv">CV/Resume</label>
                        @if(Auth::user()->cv)
                            <div style="margin-bottom: 1rem; padding: 1rem; background: #e7f3ff; border-radius: 8px;">
                                <p style="margin: 0; color: #667eea;">📄 Current CV uploaded</p>
                                <small style="color: #666;">{{ basename(Auth::user()->cv) }}</small>
                                <p style="font-size: 0.85rem; color: #666; margin: 0.5rem 0 0 0;">Upload a new file to replace</p>
                            </div>
                        @endif
                        <div class="file-input-wrapper">
                            <input type="file" id="cv" name="cv" class="file-input" 
                                   accept=".pdf,.doc,.docx">
                            <label for="cv" class="file-input-label">
                                📄 {{ Auth::user()->cv ? 'Change CV' : 'Upload CV' }}<br>
                                <small style="color: #666;">Max 10MB (PDF, DOC, DOCX)</small>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Personal Details Section -->
        <div style="background: #fff8f0; padding: 1.5rem;">
            <h4 style="color: #ffc107; margin-bottom: 1.5rem;">📝 About You</h4>
            
            <div class="form-group">
                <label for="bio">Bio *</label>
                <textarea id="bio" name="bio" class="form-control" rows="5" required
                          placeholder="Tell us about yourself, your background, interests, and what you're passionate about..."
                          style="border-color: {{ $errors->has('bio') ? '#dc3545' : '#e1e5e9' }}; resize: vertical;">{{ old('bio', Auth::user()->bio) }}</textarea>
                <small style="color: #666; font-size: 0.85rem;">Maximum 1000 characters</small>
            </div>

            <div class="form-group">
                <label for="keywords">Keywords *</label>
                <input type="text" id="keywords" name="keywords" class="form-control" 
                       value="{{ old('keywords', Auth::user()->keywords) }}" required
                       placeholder="e.g., software development, machine learning, entrepreneurship, research"
                       style="border-color: {{ $errors->has('keywords') ? '#dc3545' : '#e1e5e9' }};">
                <small style="color: #666; font-size: 0.85rem;">Comma-separated keywords that describe your skills and interests</small>
            </div>

            <div class="form-group">
                <label>Areas of Interest *</label>
                <small style="color: #666; font-size: 0.85rem; display: block; margin-bottom: 0.5rem;">Tick all that apply</small>
                <div class="row">
                    <div class="col-md-6">
                        <div class="checkbox-group">
                            <label class="checkbox-label">
                                <input type="checkbox" name="areas_of_interest[]" value="Research collaboration" 
                                       {{ in_array('Research collaboration', old('areas_of_interest', Auth::user()->areas_of_interest ?? [])) ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                                Research collaboration
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="areas_of_interest[]" value="Academic supervision" 
                                       {{ in_array('Academic supervision', old('areas_of_interest', Auth::user()->areas_of_interest ?? [])) ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                                Academic supervision
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="areas_of_interest[]" value="Grant writing" 
                                       {{ in_array('Grant writing', old('areas_of_interest', Auth::user()->areas_of_interest ?? [])) ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                                Grant writing
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="areas_of_interest[]" value="Teaching" 
                                       {{ in_array('Teaching', old('areas_of_interest', Auth::user()->areas_of_interest ?? [])) ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                                Teaching
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="checkbox-group">
                            <label class="checkbox-label">
                                <input type="checkbox" name="areas_of_interest[]" value="Mentoring" 
                                       {{ in_array('Mentoring', old('areas_of_interest', Auth::user()->areas_of_interest ?? [])) ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                                Mentoring
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="areas_of_interest[]" value="Community engagement" 
                                       {{ in_array('Community engagement', old('areas_of_interest', Auth::user()->areas_of_interest ?? [])) ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                                Community engagement
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="areas_of_interest[]" value="SDG-related work" 
                                       {{ in_array('SDG-related work', old('areas_of_interest', Auth::user()->areas_of_interest ?? [])) ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                                SDG-related work
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>ISCED codes of specialisation *</label>
                <small style="color: #666; font-size: 0.85rem; display: block; margin-bottom: 1rem;">Tick all that apply</small>
                <div class="row">
                    <div class="col-md-6">
                        <div class="checkbox-group">
                            <label class="checkbox-label">
                                <input type="checkbox" name="isced_codes[]" value="00 – Generic programmes and qualifications" 
                                       {{ in_array('00 – Generic programmes and qualifications', old('isced_codes', Auth::user()->isced_codes ?? [])) ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                                00 – Generic programmes and qualifications
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="isced_codes[]" value="01 – Education" 
                                       {{ in_array('01 – Education', old('isced_codes', Auth::user()->isced_codes ?? [])) ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                                01 – Education
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="isced_codes[]" value="02 – Arts and Humanities" 
                                       {{ in_array('02 – Arts and Humanities', old('isced_codes', Auth::user()->isced_codes ?? [])) ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                                02 – Arts and Humanities
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="isced_codes[]" value="03 – Social Sciences, Journalism and Information" 
                                       {{ in_array('03 – Social Sciences, Journalism and Information', old('isced_codes', Auth::user()->isced_codes ?? [])) ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                                03 – Social Sciences, Journalism and Information
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="isced_codes[]" value="04 – Business, Administration and Law" 
                                       {{ in_array('04 – Business, Administration and Law', old('isced_codes', Auth::user()->isced_codes ?? [])) ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                                04 – Business, Administration and Law
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="isced_codes[]" value="05 – Natural Sciences, Mathematics and Statistics" 
                                       {{ in_array('05 – Natural Sciences, Mathematics and Statistics', old('isced_codes', Auth::user()->isced_codes ?? [])) ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                                05 – Natural Sciences, Mathematics and Statistics
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="checkbox-group">
                            <label class="checkbox-label">
                                <input type="checkbox" name="isced_codes[]" value="06 – ICT" 
                                       {{ in_array('06 – ICT', old('isced_codes', Auth::user()->isced_codes ?? [])) ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                                06 – ICT
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="isced_codes[]" value="07 – Engineering, Manufacturing and Construction" 
                                       {{ in_array('07 – Engineering, Manufacturing and Construction', old('isced_codes', Auth::user()->isced_codes ?? [])) ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                                07 – Engineering, Manufacturing and Construction
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="isced_codes[]" value="08 – Agriculture, Forestry, Fisheries and Veterinary" 
                                       {{ in_array('08 – Agriculture, Forestry, Fisheries and Veterinary', old('isced_codes', Auth::user()->isced_codes ?? [])) ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                                08 – Agriculture, Forestry, Fisheries and Veterinary
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="isced_codes[]" value="09 – Health and Welfare" 
                                       {{ in_array('09 – Health and Welfare', old('isced_codes', Auth::user()->isced_codes ?? [])) ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                                09 – Health and Welfare
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="isced_codes[]" value="10 – Services" 
                                       {{ in_array('10 – Services', old('isced_codes', Auth::user()->isced_codes ?? [])) ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                                10 – Services
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <a href="{{ route('dashboard') }}" class="btn btn-secondary" style="margin-right: 1rem;">Cancel</a>
            <button type="submit" class="btn">Update Profile</button>
        </div>
    </form>
</div>

<script>
    // File input display functionality
    document.getElementById('photo').addEventListener('change', function() {
        const label = document.querySelector('label[for="photo"]');
        if (this.files.length > 0) {
            label.innerHTML = `📸 ${this.files[0].name}<br><small style="color: #666;">File selected</small>`;
            label.style.borderColor = '#28a745';
            label.style.backgroundColor = '#d4edda';
        }
    });

    document.getElementById('cv').addEventListener('change', function() {
        const label = document.querySelector('label[for="cv"]');
        if (this.files.length > 0) {
            label.innerHTML = `📄 ${this.files[0].name}<br><small style="color: #666;">File selected</small>`;
            label.style.borderColor = '#28a745';
            label.style.backgroundColor = '#d4edda';
        }
    });

    // Character count for bio
    const bioField = document.getElementById('bio');
    const bioLabel = document.querySelector('label[for="bio"]');
    
    bioField.addEventListener('input', function() {
        const current = this.value.length;
        const max = 1000;
        const remaining = max - current;
        
        // Update label to show character count
        if (current > 900) {
            bioLabel.innerHTML = `Bio * <span style="color: ${remaining < 0 ? '#dc3545' : '#ffc107'}; font-size: 0.85rem;">(${remaining} characters remaining)</span>`;
        } else {
            bioLabel.textContent = 'Bio *';
        }
        
        // Change border color if over limit
        if (remaining < 0) {
            this.style.borderColor = '#dc3545';
        } else {
            this.style.borderColor = '#e1e5e9';
        }
    });

    // Auto-update name field when first/last name changes
    const firstNameField = document.getElementById('first_name');
    const lastNameField = document.getElementById('last_name');
    
    function updateFullName() {
        const firstName = firstNameField.value;
        const lastName = lastNameField.value;
        // This would be used if we had a hidden name field, but we handle it in the controller
    }
    
    firstNameField.addEventListener('input', updateFullName);
    lastNameField.addEventListener('input', updateFullName);
</script>

<style>
    .checkbox-group {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .checkbox-label {
        display: flex;
        align-items: flex-start;
        cursor: pointer;
        padding: 0.5rem;
        border-radius: 5px;
        transition: background-color 0.2s;
        margin-bottom: 0;
        line-height: 1.4;
        font-weight: normal;
    }

    .checkbox-label:hover {
        background-color: #f8f9fa;
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

    .form-group label:not(.checkbox-label) {
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
        display: block;
    }
</style>
</script>
@endsection