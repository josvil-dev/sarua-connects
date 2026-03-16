@extends('layouts.app')

@section('title', 'Register - Step 2 | Sarua Connect')

@section('content')
<div style="max-width: 1000px; margin: 3rem auto; padding: 2rem; background: #fff; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
    <div class="step-indicator">
        <div class="step completed">
            <div class="step-number">✓</div>
            <span class="step-title">Personal Info</span>
        </div>
        <div class="step active">
            <div class="step-number">2</div>
            <span class="step-title">Professional Info</span>
        </div>
        <div class="step">
            <div class="step-number">3</div>
            <span class="step-title">Consent</span>
        </div>
    </div>


    <form action="{{ route('register.step2') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="title">Title *</label>
                    <select id="title" name="title" class="form-control" required
                            style="border-color: {{ $errors->has('title') ? '#dc3545' : '#e1e5e9' }};">
                        <option value="">Select Title</option>
                        <option value="Mr." {{ old('title') == 'Mr.' ? 'selected' : '' }}>Mr.</option>
                        <option value="Ms." {{ old('title') == 'Ms.' ? 'selected' : '' }}>Ms.</option>
                        <option value="Dr." {{ old('title') == 'Dr.' ? 'selected' : '' }}>Dr.</option>
                        <option value="Prof." {{ old('title') == 'Prof.' ? 'selected' : '' }}>Prof.</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="highest_qualification">Highest Qualification *</label>
                    <select id="highest_qualification" name="highest_qualification" class="form-control" required
                            style="border-color: {{ $errors->has('highest_qualification') ? '#dc3545' : '#e1e5e9' }};">
                        <option value="">Select Qualification</option>
                        <option value="Doctorate (PhD or equivalent doctoral degree)" {{ old('highest_qualification') == 'Doctorate (PhD or equivalent doctoral degree)' ? 'selected' : '' }}>Doctorate (PhD or equivalent doctoral degree)</option>
                        <option value="Master's degree" {{ old('highest_qualification') == "Master's degree" ? 'selected' : '' }}>Master's degree</option>
                        <option value="Postgraduate diploma/postgraduate certificate" {{ old('highest_qualification') == 'Postgraduate diploma/postgraduate certificate' ? 'selected' : '' }}>Postgraduate diploma/postgraduate certificate</option>
                        <option value="Bachelor's degree with honours" {{ old('highest_qualification') == "Bachelor's degree with honours" ? 'selected' : '' }}>Bachelor's degree with honours</option>
                        <option value="Bachelor's degree" {{ old('highest_qualification') == "Bachelor's degree" ? 'selected' : '' }}>Bachelor's degree</option>
                        <option value="Advanced diploma/higher diploma" {{ old('highest_qualification') == 'Advanced diploma/higher diploma' ? 'selected' : '' }}>Advanced diploma/higher diploma</option>
                        <option value="Diploma" {{ old('highest_qualification') == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                        <option value="Certificate" {{ old('highest_qualification') == 'Certificate' ? 'selected' : '' }}>Certificate</option>
                        <option value="Other" {{ old('highest_qualification') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="institution">Institution *</label>
            <input type="text" id="institution" name="institution" class="form-control" 
                   value="{{ old('institution') }}" required placeholder="e.g., University of Lusaka"
                   style="border-color: {{ $errors->has('institution') ? '#dc3545' : '#e1e5e9' }};">
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="job_title">Current Job Title *</label>
                    <input type="text" id="job_title" name="job_title" class="form-control" 
                           value="{{ old('job_title') }}" required placeholder="e.g., Lacturer"
                           style="border-color: {{ $errors->has('job_title') ? '#dc3545' : '#e1e5e9' }};">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="country">Country *</label>
                    <select id="country" name="country" class="form-control" required
                        style="border-color: {{ $errors->has('country') ? '#dc3545' : '#e1e5e9' }};">
                        <option value="">Select Country</option>

                        {{-- SADC Countries (Priority) --}}
                        <optgroup label="SADC Countries">
                            <option value="Angola" {{ old('country') == 'Angola' ? 'selected' : '' }}>Angola</option>
                            <option value="Botswana" {{ old('country') == 'Botswana' ? 'selected' : '' }}>Botswana</option>
                            <option value="Comoros" {{ old('country') == 'Comoros' ? 'selected' : '' }}>Comoros</option>
                            <option value="Democratic Republic of the Congo" {{ old('country') == 'Democratic Republic of the Congo' ? 'selected' : '' }}>Democratic Republic of the Congo</option>
                            <option value="Eswatini" {{ old('country') == 'Eswatini' ? 'selected' : '' }}>Eswatini</option>
                            <option value="Lesotho" {{ old('country') == 'Lesotho' ? 'selected' : '' }}>Lesotho</option>
                            <option value="Madagascar" {{ old('country') == 'Madagascar' ? 'selected' : '' }}>Madagascar</option>
                            <option value="Malawi" {{ old('country') == 'Malawi' ? 'selected' : '' }}>Malawi</option>
                            <option value="Mauritius" {{ old('country') == 'Mauritius' ? 'selected' : '' }}>Mauritius</option>
                            <option value="Mozambique" {{ old('country') == 'Mozambique' ? 'selected' : '' }}>Mozambique</option>
                            <option value="Namibia" {{ old('country') == 'Namibia' ? 'selected' : '' }}>Namibia</option>
                            <option value="Seychelles" {{ old('country') == 'Seychelles' ? 'selected' : '' }}>Seychelles</option>
                            <option value="South Africa" {{ old('country') == 'South Africa' ? 'selected' : '' }}>South Africa</option>
                            <option value="Tanzania" {{ old('country') == 'Tanzania' ? 'selected' : '' }}>Tanzania</option>
                            <option value="Zambia" {{ old('country') == 'Zambia' ? 'selected' : '' }}>Zambia</option>
                            <option value="Zimbabwe" {{ old('country') == 'Zimbabwe' ? 'selected' : '' }}>Zimbabwe</option>
                        </optgroup>

                        {{-- All Other Countries --}}
                        <optgroup label="All Countries">
                            <option value="Afghanistan" {{ old('country') == 'Afghanistan' ? 'selected' : '' }}>Afghanistan</option>
                            <option value="Albania" {{ old('country') == 'Albania' ? 'selected' : '' }}>Albania</option>
                            <option value="Algeria" {{ old('country') == 'Algeria' ? 'selected' : '' }}>Algeria</option>
                            <option value="Argentina" {{ old('country') == 'Argentina' ? 'selected' : '' }}>Argentina</option>
                            <option value="Armenia" {{ old('country') == 'Armenia' ? 'selected' : '' }}>Armenia</option>
                            <option value="Australia" {{ old('country') == 'Australia' ? 'selected' : '' }}>Australia</option>
                            <option value="Austria" {{ old('country') == 'Austria' ? 'selected' : '' }}>Austria</option>
                            <option value="Azerbaijan" {{ old('country') == 'Azerbaijan' ? 'selected' : '' }}>Azerbaijan</option>
                            <option value="Bahrain" {{ old('country') == 'Bahrain' ? 'selected' : '' }}>Bahrain</option>
                            <option value="Bangladesh" {{ old('country') == 'Bangladesh' ? 'selected' : '' }}>Bangladesh</option>
                            <option value="Belarus" {{ old('country') == 'Belarus' ? 'selected' : '' }}>Belarus</option>
                            <option value="Belgium" {{ old('country') == 'Belgium' ? 'selected' : '' }}>Belgium</option>
                            <option value="Benin" {{ old('country') == 'Benin' ? 'selected' : '' }}>Benin</option>
                            <option value="Bolivia" {{ old('country') == 'Bolivia' ? 'selected' : '' }}>Bolivia</option>
                            <option value="Bosnia and Herzegovina" {{ old('country') == 'Bosnia and Herzegovina' ? 'selected' : '' }}>Bosnia and Herzegovina</option>
                            <option value="Brazil" {{ old('country') == 'Brazil' ? 'selected' : '' }}>Brazil</option>
                            <option value="Bulgaria" {{ old('country') == 'Bulgaria' ? 'selected' : '' }}>Bulgaria</option>
                            <option value="Burkina Faso" {{ old('country') == 'Burkina Faso' ? 'selected' : '' }}>Burkina Faso</option>
                            <option value="Burundi" {{ old('country') == 'Burundi' ? 'selected' : '' }}>Burundi</option>
                            <option value="Cambodia" {{ old('country') == 'Cambodia' ? 'selected' : '' }}>Cambodia</option>
                            <option value="Cameroon" {{ old('country') == 'Cameroon' ? 'selected' : '' }}>Cameroon</option>
                            <option value="Canada" {{ old('country') == 'Canada' ? 'selected' : '' }}>Canada</option>
                            <option value="Cape Verde" {{ old('country') == 'Cape Verde' ? 'selected' : '' }}>Cape Verde</option>
                            <option value="Central African Republic" {{ old('country') == 'Central African Republic' ? 'selected' : '' }}>Central African Republic</option>
                            <option value="Chad" {{ old('country') == 'Chad' ? 'selected' : '' }}>Chad</option>
                            <option value="Chile" {{ old('country') == 'Chile' ? 'selected' : '' }}>Chile</option>
                            <option value="China" {{ old('country') == 'China' ? 'selected' : '' }}>China</option>
                            <option value="Colombia" {{ old('country') == 'Colombia' ? 'selected' : '' }}>Colombia</option>
                            <option value="Congo" {{ old('country') == 'Congo' ? 'selected' : '' }}>Congo</option>
                            <option value="Costa Rica" {{ old('country') == 'Costa Rica' ? 'selected' : '' }}>Costa Rica</option>
                            <option value="Croatia" {{ old('country') == 'Croatia' ? 'selected' : '' }}>Croatia</option>
                            <option value="Cuba" {{ old('country') == 'Cuba' ? 'selected' : '' }}>Cuba</option>
                            <option value="Cyprus" {{ old('country') == 'Cyprus' ? 'selected' : '' }}>Cyprus</option>
                            <option value="Czech Republic" {{ old('country') == 'Czech Republic' ? 'selected' : '' }}>Czech Republic</option>
                            <option value="Denmark" {{ old('country') == 'Denmark' ? 'selected' : '' }}>Denmark</option>
                            <option value="Djibouti" {{ old('country') == 'Djibouti' ? 'selected' : '' }}>Djibouti</option>
                            <option value="Dominican Republic" {{ old('country') == 'Dominican Republic' ? 'selected' : '' }}>Dominican Republic</option>
                            <option value="Ecuador" {{ old('country') == 'Ecuador' ? 'selected' : '' }}>Ecuador</option>
                            <option value="Egypt" {{ old('country') == 'Egypt' ? 'selected' : '' }}>Egypt</option>
                            <option value="El Salvador" {{ old('country') == 'El Salvador' ? 'selected' : '' }}>El Salvador</option>
                            <option value="Equatorial Guinea" {{ old('country') == 'Equatorial Guinea' ? 'selected' : '' }}>Equatorial Guinea</option>
                            <option value="Eritrea" {{ old('country') == 'Eritrea' ? 'selected' : '' }}>Eritrea</option>
                            <option value="Estonia" {{ old('country') == 'Estonia' ? 'selected' : '' }}>Estonia</option>
                            <option value="Ethiopia" {{ old('country') == 'Ethiopia' ? 'selected' : '' }}>Ethiopia</option>
                            <option value="Finland" {{ old('country') == 'Finland' ? 'selected' : '' }}>Finland</option>
                            <option value="France" {{ old('country') == 'France' ? 'selected' : '' }}>France</option>
                            <option value="Gabon" {{ old('country') == 'Gabon' ? 'selected' : '' }}>Gabon</option>
                            <option value="Gambia" {{ old('country') == 'Gambia' ? 'selected' : '' }}>Gambia</option>
                            <option value="Georgia" {{ old('country') == 'Georgia' ? 'selected' : '' }}>Georgia</option>
                            <option value="Germany" {{ old('country') == 'Germany' ? 'selected' : '' }}>Germany</option>
                            <option value="Ghana" {{ old('country') == 'Ghana' ? 'selected' : '' }}>Ghana</option>
                            <option value="Greece" {{ old('country') == 'Greece' ? 'selected' : '' }}>Greece</option>
                            <option value="Guatemala" {{ old('country') == 'Guatemala' ? 'selected' : '' }}>Guatemala</option>
                            <option value="Guinea" {{ old('country') == 'Guinea' ? 'selected' : '' }}>Guinea</option>
                            <option value="Guinea-Bissau" {{ old('country') == 'Guinea-Bissau' ? 'selected' : '' }}>Guinea-Bissau</option>
                            <option value="Haiti" {{ old('country') == 'Haiti' ? 'selected' : '' }}>Haiti</option>
                            <option value="Honduras" {{ old('country') == 'Honduras' ? 'selected' : '' }}>Honduras</option>
                            <option value="Hungary" {{ old('country') == 'Hungary' ? 'selected' : '' }}>Hungary</option>
                            <option value="Iceland" {{ old('country') == 'Iceland' ? 'selected' : '' }}>Iceland</option>
                            <option value="India" {{ old('country') == 'India' ? 'selected' : '' }}>India</option>
                            <option value="Indonesia" {{ old('country') == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                            <option value="Iran" {{ old('country') == 'Iran' ? 'selected' : '' }}>Iran</option>
                            <option value="Iraq" {{ old('country') == 'Iraq' ? 'selected' : '' }}>Iraq</option>
                            <option value="Ireland" {{ old('country') == 'Ireland' ? 'selected' : '' }}>Ireland</option>
                            <option value="Israel" {{ old('country') == 'Israel' ? 'selected' : '' }}>Israel</option>
                            <option value="Italy" {{ old('country') == 'Italy' ? 'selected' : '' }}>Italy</option>
                            <option value="Jamaica" {{ old('country') == 'Jamaica' ? 'selected' : '' }}>Jamaica</option>
                            <option value="Japan" {{ old('country') == 'Japan' ? 'selected' : '' }}>Japan</option>
                            <option value="Jordan" {{ old('country') == 'Jordan' ? 'selected' : '' }}>Jordan</option>
                            <option value="Kazakhstan" {{ old('country') == 'Kazakhstan' ? 'selected' : '' }}>Kazakhstan</option>
                            <option value="Kenya" {{ old('country') == 'Kenya' ? 'selected' : '' }}>Kenya</option>
                            <option value="Kuwait" {{ old('country') == 'Kuwait' ? 'selected' : '' }}>Kuwait</option>
                            <option value="Kyrgyzstan" {{ old('country') == 'Kyrgyzstan' ? 'selected' : '' }}>Kyrgyzstan</option>
                            <option value="Latvia" {{ old('country') == 'Latvia' ? 'selected' : '' }}>Latvia</option>
                            <option value="Lebanon" {{ old('country') == 'Lebanon' ? 'selected' : '' }}>Lebanon</option>
                            <option value="Liberia" {{ old('country') == 'Liberia' ? 'selected' : '' }}>Liberia</option>
                            <option value="Libya" {{ old('country') == 'Libya' ? 'selected' : '' }}>Libya</option>
                            <option value="Lithuania" {{ old('country') == 'Lithuania' ? 'selected' : '' }}>Lithuania</option>
                            <option value="Luxembourg" {{ old('country') == 'Luxembourg' ? 'selected' : '' }}>Luxembourg</option>
                            <option value="Malaysia" {{ old('country') == 'Malaysia' ? 'selected' : '' }}>Malaysia</option>
                            <option value="Mali" {{ old('country') == 'Mali' ? 'selected' : '' }}>Mali</option>
                            <option value="Malta" {{ old('country') == 'Malta' ? 'selected' : '' }}>Malta</option>
                            <option value="Mauritania" {{ old('country') == 'Mauritania' ? 'selected' : '' }}>Mauritania</option>
                            <option value="Mexico" {{ old('country') == 'Mexico' ? 'selected' : '' }}>Mexico</option>
                            <option value="Moldova" {{ old('country') == 'Moldova' ? 'selected' : '' }}>Moldova</option>
                            <option value="Mongolia" {{ old('country') == 'Mongolia' ? 'selected' : '' }}>Mongolia</option>
                            <option value="Montenegro" {{ old('country') == 'Montenegro' ? 'selected' : '' }}>Montenegro</option>
                            <option value="Morocco" {{ old('country') == 'Morocco' ? 'selected' : '' }}>Morocco</option>
                            <option value="Myanmar" {{ old('country') == 'Myanmar' ? 'selected' : '' }}>Myanmar</option>
                            <option value="Nepal" {{ old('country') == 'Nepal' ? 'selected' : '' }}>Nepal</option>
                            <option value="Netherlands" {{ old('country') == 'Netherlands' ? 'selected' : '' }}>Netherlands</option>
                            <option value="New Zealand" {{ old('country') == 'New Zealand' ? 'selected' : '' }}>New Zealand</option>
                            <option value="Nicaragua" {{ old('country') == 'Nicaragua' ? 'selected' : '' }}>Nicaragua</option>
                            <option value="Niger" {{ old('country') == 'Niger' ? 'selected' : '' }}>Niger</option>
                            <option value="Nigeria" {{ old('country') == 'Nigeria' ? 'selected' : '' }}>Nigeria</option>
                            <option value="North Korea" {{ old('country') == 'North Korea' ? 'selected' : '' }}>North Korea</option>
                            <option value="North Macedonia" {{ old('country') == 'North Macedonia' ? 'selected' : '' }}>North Macedonia</option>
                            <option value="Norway" {{ old('country') == 'Norway' ? 'selected' : '' }}>Norway</option>
                            <option value="Oman" {{ old('country') == 'Oman' ? 'selected' : '' }}>Oman</option>
                            <option value="Pakistan" {{ old('country') == 'Pakistan' ? 'selected' : '' }}>Pakistan</option>
                            <option value="Panama" {{ old('country') == 'Panama' ? 'selected' : '' }}>Panama</option>
                            <option value="Paraguay" {{ old('country') == 'Paraguay' ? 'selected' : '' }}>Paraguay</option>
                            <option value="Peru" {{ old('country') == 'Peru' ? 'selected' : '' }}>Peru</option>
                            <option value="Philippines" {{ old('country') == 'Philippines' ? 'selected' : '' }}>Philippines</option>
                            <option value="Poland" {{ old('country') == 'Poland' ? 'selected' : '' }}>Poland</option>
                            <option value="Portugal" {{ old('country') == 'Portugal' ? 'selected' : '' }}>Portugal</option>
                            <option value="Qatar" {{ old('country') == 'Qatar' ? 'selected' : '' }}>Qatar</option>
                            <option value="Romania" {{ old('country') == 'Romania' ? 'selected' : '' }}>Romania</option>
                            <option value="Russia" {{ old('country') == 'Russia' ? 'selected' : '' }}>Russia</option>
                            <option value="Rwanda" {{ old('country') == 'Rwanda' ? 'selected' : '' }}>Rwanda</option>
                            <option value="Saudi Arabia" {{ old('country') == 'Saudi Arabia' ? 'selected' : '' }}>Saudi Arabia</option>
                            <option value="Senegal" {{ old('country') == 'Senegal' ? 'selected' : '' }}>Senegal</option>
                            <option value="Serbia" {{ old('country') == 'Serbia' ? 'selected' : '' }}>Serbia</option>
                            <option value="Sierra Leone" {{ old('country') == 'Sierra Leone' ? 'selected' : '' }}>Sierra Leone</option>
                            <option value="Singapore" {{ old('country') == 'Singapore' ? 'selected' : '' }}>Singapore</option>
                            <option value="Slovakia" {{ old('country') == 'Slovakia' ? 'selected' : '' }}>Slovakia</option>
                            <option value="Slovenia" {{ old('country') == 'Slovenia' ? 'selected' : '' }}>Slovenia</option>
                            <option value="Somalia" {{ old('country') == 'Somalia' ? 'selected' : '' }}>Somalia</option>
                            <option value="South Korea" {{ old('country') == 'South Korea' ? 'selected' : '' }}>South Korea</option>
                            <option value="South Sudan" {{ old('country') == 'South Sudan' ? 'selected' : '' }}>South Sudan</option>
                            <option value="Spain" {{ old('country') == 'Spain' ? 'selected' : '' }}>Spain</option>
                            <option value="Sri Lanka" {{ old('country') == 'Sri Lanka' ? 'selected' : '' }}>Sri Lanka</option>
                            <option value="Sudan" {{ old('country') == 'Sudan' ? 'selected' : '' }}>Sudan</option>
                            <option value="Sweden" {{ old('country') == 'Sweden' ? 'selected' : '' }}>Sweden</option>
                            <option value="Switzerland" {{ old('country') == 'Switzerland' ? 'selected' : '' }}>Switzerland</option>
                            <option value="Syria" {{ old('country') == 'Syria' ? 'selected' : '' }}>Syria</option>
                            <option value="Taiwan" {{ old('country') == 'Taiwan' ? 'selected' : '' }}>Taiwan</option>
                            <option value="Tajikistan" {{ old('country') == 'Tajikistan' ? 'selected' : '' }}>Tajikistan</option>
                            <option value="Thailand" {{ old('country') == 'Thailand' ? 'selected' : '' }}>Thailand</option>
                            <option value="Togo" {{ old('country') == 'Togo' ? 'selected' : '' }}>Togo</option>
                            <option value="Trinidad and Tobago" {{ old('country') == 'Trinidad and Tobago' ? 'selected' : '' }}>Trinidad and Tobago</option>
                            <option value="Tunisia" {{ old('country') == 'Tunisia' ? 'selected' : '' }}>Tunisia</option>
                            <option value="Turkey" {{ old('country') == 'Turkey' ? 'selected' : '' }}>Turkey</option>
                            <option value="Turkmenistan" {{ old('country') == 'Turkmenistan' ? 'selected' : '' }}>Turkmenistan</option>
                            <option value="Uganda" {{ old('country') == 'Uganda' ? 'selected' : '' }}>Uganda</option>
                            <option value="Ukraine" {{ old('country') == 'Ukraine' ? 'selected' : '' }}>Ukraine</option>
                            <option value="United Arab Emirates" {{ old('country') == 'United Arab Emirates' ? 'selected' : '' }}>United Arab Emirates</option>
                            <option value="United Kingdom" {{ old('country') == 'United Kingdom' ? 'selected' : '' }}>United Kingdom</option>
                            <option value="United States" {{ old('country') == 'United States' ? 'selected' : '' }}>United States</option>
                            <option value="Uruguay" {{ old('country') == 'Uruguay' ? 'selected' : '' }}>Uruguay</option>
                            <option value="Uzbekistan" {{ old('country') == 'Uzbekistan' ? 'selected' : '' }}>Uzbekistan</option>
                            <option value="Venezuela" {{ old('country') == 'Venezuela' ? 'selected' : '' }}>Venezuela</option>
                            <option value="Vietnam" {{ old('country') == 'Vietnam' ? 'selected' : '' }}>Vietnam</option>
                            <option value="Yemen" {{ old('country') == 'Yemen' ? 'selected' : '' }}>Yemen</option>
                        </optgroup>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="bio">Bio *</label>
            <textarea id="bio" name="bio" class="form-control" rows="5" required
                      placeholder="Provide a brief summary of your professional background, including your discipline, research interest and areas of expertise"
                      style="border-color: {{ $errors->has('bio') ? '#dc3545' : '#e1e5e9' }}; resize: vertical;">{{ old('bio') }}</textarea>
            <small style="color: #666; font-size: 0.85rem;">Maximum 1000 characters</small>
        </div>

        <div class="form-group">
            <label for="keywords">Keywords *</label>
            <input type="text" id="keywords" name="keywords" class="form-control" 
                   value="{{ old('keywords') }}" required
                   placeholder="e.g SDG, leadership, digital transformation, quality assurance"
                   style="border-color: {{ $errors->has('keywords') ? '#dc3545' : '#e1e5e9' }};">
            <small style="color: #666; font-size: 0.85rem;">Comma-separated keywords that describe your skills and interests</small>
        </div>

        <div class="form-group">
            <label>Areas of Interest *</label>
            <small style="color: #666; font-size: 0.85rem; display: block; margin-bottom: 1rem;">Tick all that apply</small>
            <div class="row">
                <div class="col-md-6">
                    <div class="checkbox-group">
                        <label class="checkbox-label">
                            <input type="checkbox" name="areas_of_interest[]" value="Research collaboration" 
                                   {{ in_array('Research collaboration', old('areas_of_interest', [])) ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                            Research collaboration
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="areas_of_interest[]" value="Academic supervision" 
                                   {{ in_array('Academic supervision', old('areas_of_interest', [])) ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                            Academic supervision
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="areas_of_interest[]" value="Grant writing" 
                                   {{ in_array('Grant writing', old('areas_of_interest', [])) ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                            Grant writing
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="areas_of_interest[]" value="Teaching" 
                                   {{ in_array('Teaching', old('areas_of_interest', [])) ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                            Teaching
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="checkbox-group">
                        <label class="checkbox-label">
                            <input type="checkbox" name="areas_of_interest[]" value="Mentoring" 
                                   {{ in_array('Mentoring', old('areas_of_interest', [])) ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                            Mentoring
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="areas_of_interest[]" value="Community engagement" 
                                   {{ in_array('Community engagement', old('areas_of_interest', [])) ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                            Community engagement
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="areas_of_interest[]" value="SDG-related work" 
                                   {{ in_array('SDG-related work', old('areas_of_interest', [])) ? 'checked' : '' }}>
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
                                   {{ in_array('00 – Generic programmes and qualifications', old('isced_codes', [])) ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                            00 – Generic programmes and qualifications
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="isced_codes[]" value="01 – Education" 
                                   {{ in_array('01 – Education', old('isced_codes', [])) ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                            01 – Education
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="isced_codes[]" value="02 – Arts and Humanities" 
                                   {{ in_array('02 – Arts and Humanities', old('isced_codes', [])) ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                            02 – Arts and Humanities
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="isced_codes[]" value="03 – Social Sciences, Journalism and Information" 
                                   {{ in_array('03 – Social Sciences, Journalism and Information', old('isced_codes', [])) ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                            03 – Social Sciences, Journalism and Information
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="isced_codes[]" value="04 – Business, Administration and Law" 
                                   {{ in_array('04 – Business, Administration and Law', old('isced_codes', [])) ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                            04 – Business, Administration and Law
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="isced_codes[]" value="05 – Natural Sciences, Mathematics and Statistics" 
                                   {{ in_array('05 – Natural Sciences, Mathematics and Statistics', old('isced_codes', [])) ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                            05 – Natural Sciences, Mathematics and Statistics
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="checkbox-group">
                        <label class="checkbox-label">
                            <input type="checkbox" name="isced_codes[]" value="06 – ICT" 
                                   {{ in_array('06 – ICT', old('isced_codes', [])) ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                            06 – ICT
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="isced_codes[]" value="07 – Engineering, Manufacturing and Construction" 
                                   {{ in_array('07 – Engineering, Manufacturing and Construction', old('isced_codes', [])) ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                            07 – Engineering, Manufacturing and Construction
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="isced_codes[]" value="08 – Agriculture, Forestry, Fisheries and Veterinary" 
                                   {{ in_array('08 – Agriculture, Forestry, Fisheries and Veterinary', old('isced_codes', [])) ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                            08 – Agriculture, Forestry, Fisheries and Veterinary
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="isced_codes[]" value="09 – Health and Welfare" 
                                   {{ in_array('09 – Health and Welfare', old('isced_codes', [])) ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                            09 – Health and Welfare
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="isced_codes[]" value="10 – Services" 
                                   {{ in_array('10 – Services', old('isced_codes', [])) ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                            10 – Services
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="photo">Profile Photo</label>
                    <div class="file-input-wrapper">
                        <input type="file" id="photo" name="photo" class="file-input" 
                               accept="image/jpeg,image/png,image/jpg,image/gif">
                        <label for="photo" class="file-input-label">
                             Upload Photo<br>
                            <small style="color: #666;">Max 2MB (JPG, PNG, GIF)</small>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="cv">CV *</label>
                    <div class="file-input-wrapper">
                        <input type="file" id="cv" name="cv" class="file-input" 
                               accept=".pdf,.doc,.docx">
                        <label for="cv" class="file-input-label">
                             Upload CV<br>
                            <small style="color: #666;">Max 10MB (PDF, DOC, DOCX)</small>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-top: 2rem; margin-bottom: 2rem; background: #f8f9fa;">
        </div>
        <div class="text-center">
            <a href="{{ route('register') }}" class="btn btn-secondary" style="margin-right: 1rem;">Back</a>
            <button type="submit" class="btn">Continue to Step 3</button>
        </div>
    </form>
</div>

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

    .file-input-wrapper {
        position: relative;
        display: inline-block;
        width: 100%;
    }

    .file-input {
        position: absolute;
        opacity: 0;
        width: 0.1px;
        height: 0.1px;
        z-index: -1;
    }

    .file-input-label {
        display: block;
        padding: 1rem;
        border: 2px dashed #e1e5e9;
        border-radius: 8px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background-color: #f8f9fa;
        color: #333;
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    .file-input-label:hover {
        border-color: #667eea;
        background-color: #f0f4ff;
    }
</style>

<script>
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

    // File input display functionality
    document.getElementById('photo').addEventListener('change', function() {
        const label = document.querySelector('label[for="photo"]');
        if (this.files.length > 0) {
            label.innerHTML = `${this.files[0].name}<br><small style="color: #666;">File selected</small>`;
            label.style.borderColor = '#28a745';
            label.style.backgroundColor = '#d4edda';
        }
    });

    document.getElementById('cv').addEventListener('change', function() {
        const label = document.querySelector('label[for="cv"]');
        if (this.files.length > 0) {
            label.innerHTML = `${this.files[0].name}<br><small style="color: #666;">File selected</small>`;
            label.style.borderColor = '#28a745';
            label.style.backgroundColor = '#d4edda';
        }
    });

    // File input display functionality
    document.getElementById('photo').addEventListener('change', function() {
        const label = document.querySelector('label[for="photo"]');
        if (this.files.length > 0) {
            label.innerHTML = `${this.files[0].name}<br><small style="color: #666;">File selected</small>`;
            label.style.borderColor = '#28a745';
            label.style.backgroundColor = '#d4edda';
        }
    });

    document.getElementById('cv').addEventListener('change', function() {
        const label = document.querySelector('label[for="cv"]');
        if (this.files.length > 0) {
            label.innerHTML = `${this.files[0].name}<br><small style="color: #666;">File selected</small>`;
            label.style.borderColor = '#28a745';
            label.style.backgroundColor = '#d4edda';
        }
    });
</script>
@endsection