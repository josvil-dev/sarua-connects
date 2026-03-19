@extends('layouts.app')

@section('title', $user->first_name . ' ' . $user->last_name . ' | Sarua Connect')

@section('content')

<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    .profile-back-link {
        display: inline-block;
        margin-bottom: 1.5rem;
        padding: 0.50rem 1rem;
        background: #fff;
        color: #000;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.82rem;
        letter-spacing: 0.1em;
        border: 2px solid #000;
        transition: background 0.2s, color 0.2s;
    }

    .profile-back-link:hover {
        background: #000;
        color: #fff;
    }

    /* ── Layout ── */
    .profile-wrapper {
        max-width: 1100px;
        display: grid;
        grid-template-columns: 35% 65%;
        gap: 1.75rem;
        align-items: start;
        margin: 2rem auto;
        
    }

    /* ── LEFT SIDEBAR ── */
    .profile-sidebar {
        background: #fff;
        border: 1px solid #ebebeb;
        border-top: 4px solid #d7df23;
        padding: 2rem 1.5rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0;
        position: sticky;
        top: 1.5rem;
    }

    /* Avatar */
    .sidebar-avatar {
        width: 110px;
        height: 110px;
        object-fit: cover;
        border: 4px solid #d7df23;
        display: block;
        margin-bottom: 1.25rem;
    }

    .sidebar-avatar-placeholder {
        width: 110px;
        height: 110px;
        background: #d7df23;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.25rem;
        font-size: 2.75rem;
        font-weight: 700;
        color: #333;
    }

    /* Name block */
    .sidebar-title-badge {
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: #888;
        margin-bottom: 0.3rem;
        text-align: center;
    }

    .sidebar-name {
        font-size: 1.35rem;
        font-weight: 800;
        color: #1a1a2e;
        text-align: center;
        line-height: 1.3;
        margin-bottom: 0.6rem;
    }

    .sidebar-job-title {
        font-size: 0.95rem;
        font-weight: 600;
        color: #d7df23;
        text-align: center;
        margin-bottom: 0.35rem;
    }

    .sidebar-institution {
        font-size: 0.88rem;
        color: #555;
        text-align: center;
        margin-bottom: 1.5rem;
    }

    /* Divider */
    .sidebar-divider {
        width: 100%;
        border: none;
        border-top: 1px solid #f0f0f0;
        margin: 1rem 0;
    }

    /* Action buttons */
    .sidebar-actions {
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 0.6rem;
        margin-bottom: 0.5rem;
    }

    .btn-primary-action {
        display: block;
        width: 100%;
        padding: 0.7rem 1rem;
        background: #d7df23;
        color: #1a1a2e;
        font-weight: 700;
        font-size: 0.88rem;
        letter-spacing: 0.04em;
        text-align: center;
        border: none;
        cursor: pointer;
        text-decoration: none;
        transition: background 0.2s, transform 0.1s;
    }

    .btn-primary-action:hover {
        background: #c8d01a;
        transform: translateY(-1px);
    }

    .btn-secondary-action {
        display: block;
        width: 100%;
        padding: 0.7rem 1rem;
        background: #fff;
        color: #333;
        font-weight: 600;
        font-size: 0.88rem;
        letter-spacing: 0.04em;
        text-align: center;
        border: 2px solid #d7df23;
        cursor: pointer;
        text-decoration: none;
        transition: background 0.2s, transform 0.1s;
    }

    .btn-secondary-action:hover {
        background: #f9fbe0;
        transform: translateY(-1px);
    }

    /* CV download */
    .sidebar-cv-btn {
        display: block;
        width: 100%;
        padding: 0.5rem 1rem;
        background: #1a1a2e;
        color: #fff;
        font-weight: 700;
        font-size: 0.85rem;
        letter-spacing: 0.04em;
        text-align: center;
        text-decoration: none;
        margin-top: 0.25rem;
        transition: background 0.2s, transform 0.1s;
    }

    .sidebar-cv-btn:hover {
        background: #000000;
        transform: translateY(-1px);
    }

    /* Joined badge */
    .sidebar-joined {
        font-size: 0.78rem;
        color: #aaa;
        text-align: center;
        margin-top: 1rem;
    }

    /* ── RIGHT MAIN CONTENT ── */
    .profile-main {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
    }

    /* Info grid at top */
    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .info-card {
        background: #fff;
        border: 1px solid #ebebeb;
        padding: 1.25rem 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .info-card-label {
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: #aaa;
    }

    .info-card-value {
        font-size: 1rem;
        font-weight: 600;
        color: #1a1a2e;
    }

    /* Section cards */
    .section-card {
        background: #fff;
        border: 1px solid #ebebeb;
        padding: 1.75rem;
    }

    .section-card h3 {
        font-size: 0.75rem;
        font-weight: 800;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: #888;
        margin-bottom: 1rem;
        padding-bottom: 0.6rem;
        border-bottom: 2px solid #d7df23;
        display: inline-block;
    }

    .section-card p {
        color: #444;
        line-height: 1.8;
        font-size: 0.97rem;
    }

    /* Keywords */
    .keywords-wrap {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 0.25rem;
    }

    .keyword-tag {
     
        color: #000000;
        padding: 0.35rem 0.85rem;
        font-size: 0.82rem;
        font-weight: 600;
        border: 1px solid #d7df23;
        letter-spacing: 0.02em;
    }

    /* Profile completeness */
    .completeness-bar-bg {
        background: #f0f0f0;
        height: 6px;
        width: 100%;
        margin-top: 0.75rem;
        overflow: hidden;
    }

    .completeness-bar-fill {
        height: 100%;
        transition: width 0.4s ease;
    }

    .completeness-score {
        font-size: 1.8rem;
        font-weight: 800;
        line-height: 1;
    }

    .completeness-label {
        font-size: 0.8rem;
        color: #999;
        margin-top: 0.2rem;
    }

    /* ── RESPONSIVE ── */
    @media (max-width: 860px) {
        .profile-wrapper {
            grid-template-columns: 1fr;
            padding: 0 0;
        }

        .profile-sidebar {
            position: static;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }
    }
</style>



<div class="profile-wrapper">

    <!-- ═══════════════ LEFT SIDEBAR ═══════════════ -->
    <aside class="profile-sidebar">
<a href="{{ route('search') }}{{ request()->getQueryString() ? '?' . request()->getQueryString() : '' }}" class="profile-back-link">Back to Search</a>
        @if($user->photo)
            <img src="{{ Storage::url($user->photo) }}"
                 alt="{{ $user->first_name }}'s Photo"
                 class="sidebar-avatar">
        @else
            <div class="sidebar-avatar-placeholder">
                {{ substr($user->first_name ?? $user->name, 0, 1) }}
            </div>
        @endif

        @if($user->title)
            
        @endif

        <h1 class="sidebar-name">{{ $user->title }} {{ $user->first_name }} {{ $user->last_name }}</h1>

        @if($user->job_title)
      <h4 >{{ $user->job_title }}</h4>
        @endif

        @if($user->institution)
            <h3 style="color: #000000;">{{ $user->institution }}</h3>
        @endif

        <hr class="sidebar-divider">

        <div class="sidebar-actions">
            <!-- Connect Button - Only show if not viewing own profile -->
            @if(Auth::id() != $user->id)
                <div id="connect-section">
                    <button class="btn-primary-action" id="connect-btn" onclick="sendConnectionRequest({{ $user->id }})">
                        🤝 Connect
                    </button>
                    <div id="pending-message" style="display: none; text-align: center; padding: 0.7rem; background: #fff3cd; color: #856404; font-size: 0.85rem; border: 1px solid #ffeaa7;">
                        ⏳ Connection request pending
                    </div>
                    <div id="connected-message" style="display: none; text-align: center; padding: 0.7rem; background: #d4edda; color: #155724; font-size: 0.85rem; border: 1px solid #c3e6cb;">
                        ✓ Connected
                    </div>
                </div>

              <div style="text-align: center; padding: 0.7rem;">
    <a  href="mailto:{{ $user->email }}" 
       class="sidebar-cv-btn">
        Email me
    </a>
</div>
            @else
                <!-- Own profile message -->
                <div style="text-align: center; padding: 0.7rem; background: #f8f9fa; color: #6c757d; font-size: 0.85rem; border: 1px solid #46494d;">
                    This is your profile
                </div>
            @endif
        </div>

        <!-- CV Download - Always visible when CV exists -->
        @if($user->cv)
            @if(Auth::id() == $user->id)
                <a href="{{ Storage::url($user->cv) }}" download class="sidebar-cv-btn">
                    Download CV
                </a>
            @else
                <a href="{{ Storage::url($user->cv) }}" download class="sidebar-cv-btn" id="cv-download-btn">
                    Download CV
                </a>
            @endif
        @endif

        <hr class="sidebar-divider">


    </aside>

    <!-- ═══════════════ RIGHT MAIN ═══════════════ -->
    <main class="profile-main">

        <!-- Education + Location info cards -->
        <div class="info-grid">
            @if($user->highest_qualification)
                <div class="info-card">
                    <span class="info-card-label">🎓 Education</span>
                    <span class="info-card-value">{{ $user->highest_qualification }}</span>
                </div>
            @endif

            @if($user->country)
                <div class="info-card">
                    <span class="info-card-label">🌍 Location</span>
                    <span class="info-card-value">{{ $user->country }}</span>
                </div>
            @endif
        </div>

        <!-- Bio -->
        @if($user->bio)
            <div class="section-card">
                <h3 style="color: #000000;">About</h3>
                <p>{{ $user->bio }}</p>
            </div>
        @endif

        <!-- Areas of Interest -->
        @if($user->areas_of_interest && count($user->areas_of_interest) > 0)
            <div class="section-card">
                <h3 style="color: #000000;">Areas of Interest</h3>
                <div class="keywords-wrap">
                    @foreach($user->areas_of_interest as $interest)
                        <span class="keyword-tag" style="background: #e7f3ff; color: #667eea; border-color: #667eea;">{{ trim($interest) }}</span>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- ISCED Specialisation Codes -->
        @if($user->isced_codes && count($user->isced_codes) > 0)
            <div class="section-card">
                <h3>Specialisation Codes (ISCED)</h3>
                <div class="keywords-wrap">
                    @foreach($user->isced_codes as $code)
                        <span class="keyword-tag" style="background: #f0f8ff; color: #28a745; border-color: #28a745;">{{ trim($code) }}</span>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Keywords / Skills -->
        @if($user->keywords)
            <div class="section-card">
                <h3 style="color: #000000;"> Keywords</h3>
                <div class="keywords-wrap">
                    @foreach(explode(',', $user->keywords) as $keyword)
                        <span class="keyword-tag">{{ trim($keyword) }}</span>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Profile completeness -->
        @php
            $fieldsCompleted = collect([
                $user->first_name, $user->last_name, $user->email,
                $user->job_title, $user->institution, $user->country,
                $user->bio, $user->keywords, $user->areas_of_interest, $user->photo
            ])->filter()->count();
            $completeness = round(($fieldsCompleted / 10) * 100);
            $barColor = $completeness >= 80 ? '#28a745' : ($completeness >= 60 ? '#f0b429' : '#dc3545');
        @endphp

    </main>

</div>

<script>
    let currentConnectionStatus = null;

    // Load connection status when page loads
    document.addEventListener('DOMContentLoaded', function() {
        // Only load connection status if not viewing own profile
        @if(Auth::id() != $user->id)
            loadConnectionStatus();
        @endif
    });

    // Load and display connection status
    async function loadConnectionStatus() {
        try {
            const response = await fetch(`/connect/status/{{ $user->id }}`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            });

            if (response.ok) {
                currentConnectionStatus = await response.json();
                updateConnectionUI(currentConnectionStatus);
            }
        } catch (error) {
            console.error('Error loading connection status:', error);
        }
    }

    // Update UI based on connection status
    function updateConnectionUI(status) {
        const connectBtn = document.getElementById('connect-btn');
        const pendingMessage = document.getElementById('pending-message');
        const connectedMessage = document.getElementById('connected-message');

        // Hide connection status elements initially
        connectBtn.style.display = 'none';
        pendingMessage.style.display = 'none';
        connectedMessage.style.display = 'none';

        // Email and CV buttons are always visible now (no need to show/hide)

        if (status.connected) {
            // Users are connected - show connected status
            connectedMessage.style.display = 'block';
        } else if (status.pending) {
            // Connection request is pending
            pendingMessage.style.display = 'block';
            if (status.sent_by_current_user) {
                pendingMessage.innerHTML = '⏳ Connection request sent';
            } else {
                pendingMessage.innerHTML = '⏳ Connection request received';
            }
        } else {
            // No connection - show connect button
            connectBtn.style.display = 'block';
        }
    }

    // Send connection request
    async function sendConnectionRequest(userId) {
        const connectBtn = document.getElementById('connect-btn');
        const originalText = connectBtn.innerHTML;
        
        // Disable button and show loading state
        connectBtn.disabled = true;
        connectBtn.innerHTML = '⏳ &nbsp;Sending...';

        try {
            const response = await fetch(`/connect/request/${userId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();

            if (response.ok && data.success) {
                showNotification(data.message, 'success');
                // Reload connection status to update UI
                loadConnectionStatus();
            } else {
                showNotification(data.error || 'Failed to send connection request', 'error');
                // Restore button state
                connectBtn.disabled = false;
                connectBtn.innerHTML = originalText;
            }
        } catch (error) {
            console.error('Error sending connection request:', error);
            showNotification('Network error. Please try again.', 'error');
            // Restore button state
            connectBtn.disabled = false;
            connectBtn.innerHTML = originalText;
        }
    }

    // Contact user via email
    function contactUser(email, userName) {
        window.open('mailto:' + email, '_self');
    }

    // Show notification messages
    function showNotification(message, type) {
        // Create notification element
        const notification = document.createElement('div');
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            border-radius: 5px;
            color: white;
            font-weight: 600;
            font-size: 14px;
            z-index: 1000;
            animation: slideIn 0.3s ease;
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

        // Remove notification after 4 seconds
        setTimeout(() => {
            notification.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 4000);
    }

    // Add animation styles
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes slideOut {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }
    `;
    document.head.appendChild(style);
</script>

@endsection