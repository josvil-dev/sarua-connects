@extends('layouts.app')

@section('title', 'My Profile | Sarua Connect')

@section('content')

<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    .my-profile-wrapper {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 2rem;
    }

    .profile-header {
        display: flex;
        justify-content: between;
        align-items: center;
        margin-bottom: 2rem;
        background: #fff;
        padding: 2rem;
        border-radius: 0;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .profile-header h1 {
        color: #1a1a2e;
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
    }



    .settings-btn:hover {
        background: #c8d01a;
        transform: translateY(-1px);
    }

    .profile-content {
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: 2rem;
        align-items: start;
    }

    /* Left sidebar with avatar and basic info */
    .profile-sidebar {
        background: #fff;
        
        padding: 2rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        text-align: center;
        position: sticky;
        top: 2rem;
    }

    .profile-avatar {
        width: 120px;
        height: 120px;
    
        object-fit: cover;
        border: 4px solid #d7df23;
        margin-bottom: 1rem;
    }

    .profile-avatar-placeholder {
        width: 120px;
        height: 120px;
     
        background: #d7df23;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 3rem;
        font-weight: 700;
        color: #1a1a2e;
    }

    .profile-name {
        font-size: 1.4rem;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 0.5rem;
    }

    .profile-job-title {
        color: #d7df23;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .profile-institution {
        color: #666;
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    .edit-profile-btn {
        background: #000000;
        color: #fff;
        padding: 0.6rem 0.90rem;
        border: none;
      margin-top: 1rem;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        transition: all 0.2s;
        width: 100%;
    }

    .edit-profile-btn:hover {
        background: #000000;
    }

    /* Main content area */
    .profile-main {
        background: #fff;
     
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    .tabs-container {
        border-bottom: 1px solid #e1e5e9;
        background: #f8f9fa;
    }

    .tabs-nav {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .tab-item {
        flex: 1;
    }

    .tab-link {
        display: block;
        padding: 1rem 1.5rem;
        color: #666;
        text-decoration: none;
        font-weight: 600;
        border-bottom: 3px solid transparent;
        transition: all 0.2s;
        text-align: center;
    }

    .tab-link:hover,
    .tab-link.active {
        color: #1a1a2e;
        background: #fff;
        border-bottom-color: #d7df23;
    }

    .tab-content {
        padding: 2rem;
    }

    .tab-pane {
        display: none;
    }

    .tab-pane.active {
        display: block;
    }

    /* Info sections */
    .info-section {
        margin-bottom: 2rem;
    }

    .info-section h3 {
        color: #1a1a2e;
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #d7df23;
        display: inline-block;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .info-card {
        background: #f8f9fa;
        padding: 1.5rem;
        border-left: 4px solid #d7df23;
    }

    .info-card-label {
        font-size: 0.8rem;
        font-weight: 700;
        color: #666;
        text-transform: uppercase;
        margin-bottom: 0.5rem;
    }

    .info-card-value {
        font-size: 1rem;
        font-weight: 600;
        color: #1a1a2e;
    }

    .bio-text {
        color: #444;
        line-height: 1.7;
        font-size: 1rem;
    }

    .keywords-wrap {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .keyword-tag {
        background: #e7f3ff;
        color: #667eea;
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        border: 1px solid #667eea;
    }

    /* Settings tab specific styles */
    .settings-section {
        margin-bottom: 2rem;
        padding: 1.5rem;
        border: 1px solid #e1e5e9;
       
    }

    .settings-section h4 {
        color: #1a1a2e;
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .settings-section p {
        color: #666;
        margin-bottom: 1rem;
        line-height: 1.5;
    }

    .danger-zone {
        background: #fff5f5;
        border: 0 solid #fed7d7;
    }

    .danger-zone h4 {
        color: #e53e3e;
    }

    .btn-danger {
        background: #e53e3e;
        color: #fff;
        padding: 0.7rem 1.2rem;
        border: none;
       
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        margin-right: 1rem;
    }

    .btn-danger:hover {
        background: #c53030;
    }

    .btn-warning {
        background: #ed8936;
        color: #fff;
        padding: 0.7rem 1.2rem;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-warning:hover {
        background: #dd6b20;
    }

    /* Modal styles */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .modal {
        background: #fff;
        padding: 2rem;
        border-radius: 0px;
        max-width: 500px;
        width: 90%;
        box-shadow: 0 4px 20px rgba(0,0,0,0.2);
    }

    .modal h3 {
        color: #e53e3e;
        margin-bottom: 1rem;
    }

    .modal p {
        color: #666;
        margin-bottom: 1.5rem;
        line-height: 1.5;
    }

    .modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
    }

    .btn-secondary {
        background: #e1e5e9;
        color: #333;
        padding: 0.7rem 1.2rem;
        border: none;
        border-radius: 0px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-secondary:hover {
        background: #d1d5db;
    }

    @media (max-width: 768px) {
        .profile-content {
            grid-template-columns: 1fr;
        }
        
        .profile-sidebar {
            position: static;
        }
        
        .my-profile-wrapper {
            padding: 0 1rem;
        }
    }
</style>

<div class="my-profile-wrapper">
    <div class="profile-header">
        <div>
            <h1>My Profile</h1>
            <p style="color: #666;">Manage your personal information and account settings</p>
        </div>
    </div>

    <div class="profile-content">
        <!-- Left Sidebar -->
        <div class="profile-sidebar">
            @if(Auth::user()->photo)
                <img src="{{ Storage::url(Auth::user()->photo) }}" 
                     alt="My Photo" class="profile-avatar">
            @else
                <div class="profile-avatar-placeholder">
                    {{ substr(Auth::user()->first_name ?? Auth::user()->name, 0, 1) }}
                </div>
            @endif
            
            <h2 class="profile-name">
                {{ Auth::user()->title }} {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
            </h2>
            
            @if(Auth::user()->job_title)
                <p class="profile-job-title">{{ Auth::user()->job_title }}</p>
            @endif
            
            @if(Auth::user()->institution)
                <p class="profile-institution">{{ Auth::user()->institution }}</p>
            @endif

            <a href="{{ route('profile.edit') }}" class="edit-profile-btn">
                 Edit Profile
            </a>
              <a href="{{ route('search') }}" class="edit-profile-btn">
                 Search
            </a>
        </div>

        <!-- Main Content -->
        <div class="profile-main">
            <div class="tabs-container">
                <ul class="tabs-nav">
                    <li class="tab-item">
                        <a href="#overview" class="tab-link active" onclick="showTab('overview')">Overview</a>
                    </li>
                    <li class="tab-item">
                        <a href="#details" class="tab-link" onclick="showTab('details')">Details</a>
                    </li>
                    <li class="tab-item">
                        <a href="#settings" class="tab-link" onclick="showTab('settings')">Settings</a>
                    </li>
                </ul>
            </div>

            <div class="tab-content">
                <!-- Overview Tab -->
                <div id="overview-tab" class="tab-pane active">
                    <div class="info-grid">
                        @if(Auth::user()->highest_qualification)
                            <div class="info-card">
                                <div class="info-card-label">Education</div>
                                <div class="info-card-value">{{ Auth::user()->highest_qualification }}</div>
                            </div>
                        @endif

                        @if(Auth::user()->country)
                            <div class="info-card">
                                <div class="info-card-label">Location</div>
                                <div class="info-card-value">{{ Auth::user()->country }}</div>
                            </div>
                        @endif

                        
                    </div>

                    @if(Auth::user()->bio)
                        <div class="info-section">
                            <h3>About Me</h3>
                            <p class="bio-text">{{ Auth::user()->bio }}</p>
                        </div>
                    @endif

                    @if(Auth::user()->keywords)
                        <div class="info-section">
                            <h3>Keywords</h3>
                            <div class="keywords-wrap">
                                @foreach(explode(',', Auth::user()->keywords) as $keyword)
                                    <span class="keyword-tag">{{ trim($keyword) }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Details Tab -->
                <div id="details-tab" class="tab-pane">
                    @if(Auth::user()->areas_of_interest && count(Auth::user()->areas_of_interest) > 0)
                        <div class="info-section">
                            <h3>Areas of Interest</h3>
                            <div class="keywords-wrap">
                                @foreach(Auth::user()->areas_of_interest as $interest)
                                    <span class="keyword-tag" style="background: #e7f3ff; color: #667eea;">{{ trim($interest) }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if(Auth::user()->isced_codes && count(Auth::user()->isced_codes) > 0)
                        <div class="info-section">
                            <h3>Specialisation Codes (ISCED)</h3>
                            <div class="keywords-wrap">
                                @foreach(Auth::user()->isced_codes as $code)
                                    <span class="keyword-tag" style="background: #f0f8ff; color: #28a745;">{{ trim($code) }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if(Auth::user()->cv)
                        <div class="info-section">
                            <h3>CV/Resume</h3>
                            <p>
                                <a href="{{ Storage::url(Auth::user()->cv) }}" target="_blank" 
                                   style="color: #667eea; text-decoration: none; font-weight: 600;">
                                    📥 Download my CV/Resume
                                </a>
                            </p>
                        </div>
                    @endif
                </div>

                <!-- Settings Tab -->
                <div id="settings-tab" class="tab-pane">
                    <div class="settings-section">
                        <h4>Profile Visibility</h4>
                        <p>Your profile is currently visible to other SARUA Connect members. You can control who sees your information through your privacy settings.</p>
                        <button class="edit-profile-btn" onclick="location.href='{{ route('profile.edit') }}'">
                            Manage Privacy Settings
                        </button>
                    </div>

                    <div class="settings-section">
                        <h4>Download My Data</h4>
                        <p>You can request a copy of all your data stored on SARUA Connect.</p>
                        <button class="edit-profile-btn" onclick="downloadMyData()">
                            Request Data Download
                        </button>
                    </div>

                    <div class="settings-section danger-zone">
                        <h4>⚠️ Danger Zone</h4>
                        <p><strong>Deactivate Account:</strong> Temporarily hide your profile from other users. You can reactivate anytime by logging in.</p>
                        <button class="btn-warning" onclick="showDeactivateModal()">
                            Deactivate My Account
                        </button>
                        
                        <p style="margin-top: 1.5rem;"><strong>Delete Account:</strong> Permanently delete your account and all associated data. This action cannot be undone.</p>
                        <button class="btn-danger" onclick="showDeleteModal()">
                            Delete My Account
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Deactivate Account Modal -->
<div id="deactivate-modal" class="modal-overlay">
    <div class="modal">
        <h3>⚠️ Deactivate Account</h3>
        <p>Are you sure you want to deactivate your account? Your profile will be hidden from other users, but your data will remain safe. You can reactivate anytime by logging back in.</p>
        <div class="modal-actions">
            <button class="btn-secondary" onclick="hideModals()">Cancel</button>
            <button class="btn-warning" onclick="deactivateAccount()">Deactivate Account</button>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div id="delete-modal" class="modal-overlay">
    <div class="modal">
        <h3>🗑️ Delete Account</h3>
        <p><strong>Warning:</strong> This will permanently delete your account and all associated data including your profile, connections, and uploaded files. This action cannot be undone.</p>
        <p>Type <strong>DELETE</strong> to confirm:</p>
        <input type="text" id="delete-confirmation" style="width: 100%; padding: 0.7rem; margin-bottom: 1rem; border: 1px solid #e1e5e9;" placeholder="Type DELETE to confirm">
        <div class="modal-actions">
            <button class="btn-secondary" onclick="hideModals()">Cancel</button>
            <button class="btn-danger" id="delete-confirm-btn" onclick="deleteAccount()" disabled>Delete Account</button>
        </div>
    </div>
</div>

<script>
    // Tab switching functionality
    function showTab(tabName) {
        // Hide all tab panes
        document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active'));
        // Remove active class from all tab links
        document.querySelectorAll('.tab-link').forEach(link => link.classList.remove('active'));
        
        // Show selected tab pane
        document.getElementById(tabName + '-tab').classList.add('active');
        // Add active class to clicked tab link
        event.target.classList.add('active');
    }

    // Modal functionality
    function showDeactivateModal() {
        document.getElementById('deactivate-modal').style.display = 'flex';
    }

    function showDeleteModal() {
        document.getElementById('delete-modal').style.display = 'flex';
    }

    function hideModals() {
        document.getElementById('deactivate-modal').style.display = 'none';
        document.getElementById('delete-modal').style.display = 'none';
        document.getElementById('delete-confirmation').value = '';
        document.getElementById('delete-confirm-btn').disabled = true;
    }

    // Enable delete button only when confirmation text is correct
    document.getElementById('delete-confirmation').addEventListener('input', function() {
        const deleteBtn = document.getElementById('delete-confirm-btn');
        deleteBtn.disabled = this.value !== 'DELETE';
    });

    // Deactivate account
    async function deactivateAccount() {
        try {
            const response = await fetch('{{ route("profile.deactivate") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();

            if (response.ok && data.success) {
                showNotification('Account deactivated successfully. Redirecting...', 'success');
                setTimeout(() => {
                    window.location.href = '{{ route("home") }}';
                }, 2000);
            } else {
                showNotification(data.error || 'Failed to deactivate account', 'error');
            }
        } catch (error) {
            console.error('Error deactivating account:', error);
            showNotification('Network error. Please try again.', 'error');
        }
    }

    // Delete account
    async function deleteAccount() {
        try {
            const response = await fetch('{{ route("profile.delete") }}', {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();

            if (response.ok && data.success) {
                showNotification('Account deleted successfully. Goodbye.', 'success');
                setTimeout(() => {
                    window.location.href = '{{ route("home") }}';
                }, 2000);
            } else {
                showNotification(data.error || 'Failed to delete account', 'error');
            }
        } catch (error) {
            console.error('Error deleting account:', error);
            showNotification('Network error. Please try again.', 'error');
        }
    }

    // Download user data
    function downloadMyData() {
        window.location.href = '{{ route("profile.download-data") }}';
    }

    // Notification system
    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            color: white;
            font-weight: 600;
            font-size: 14px;
            z-index: 1001;
            max-width: 400px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        `;

        if (type === 'success') {
            notification.style.background = '#28a745';
            notification.innerHTML = '✓ ' + message;
        } else {
            notification.style.background = '#dc3545';
            notification.innerHTML = '✗ ' + message;
        }

        document.body.appendChild(notification);

        setTimeout(() => {
            document.body.removeChild(notification);
        }, 4000);
    }

    // Close modals when clicking outside
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('modal-overlay')) {
            hideModals();
        }
    });
</script>

@endsection