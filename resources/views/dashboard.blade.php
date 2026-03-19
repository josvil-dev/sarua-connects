@extends('layouts.app')

@section('title', 'Dashboard | Sarua Connect')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --accent:    #d7df23;
        --dark:      #1a1a2e;
        --gray-800:  #2e2e2e;
        --gray-500:  #555555;
        --gray-400:  #888888;
        --gray-300:  #aaaaaa;
        --border:    #ebebeb;
        --gray-100:  #f4f4f4;
        --white:     #ffffff;
        --sidebar-w: 260px;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
     
        background: #f7f7f7;
        color: var(--dark);
        min-height: 100vh;
     
    }

    /* ── SHELL ── */
    .db-shell {
          max-width: 1200px;
        margin: 2rem auto;
        padding: 0 2rem;
        display: flex;
        align-items: flex-start; 
    }

    /* ── SIDEBAR ──
       Sits below whatever top navbar your layout already has.
       position: sticky keeps it in flow (not full-screen-height fixed)
       but glues it to the viewport as you scroll.
    */
    .db-sidebar {
        width: var(--sidebar-w);
        flex-shrink: 0;
        background: var(--white);
        border-right: 1px solid var(--border);
        position: sticky;
        top: 0;                 /* sticks just below navbar if navbar is above */
        height: 100vh;
        overflow: hidden;       /* not scrollable */
        display: flex;
        flex-direction: column;
       z-index: 10; 
    }

    .db-sidebar-brand {
        padding: 1.75rem 1.5rem 1.5rem;
        border-bottom: 1px solid var(--border);
        flex-shrink: 0;
    }

    .db-sidebar-brand-name {
        font-size: 1.125rem;;
        font-weight: 800;
        color: var(--dark);
        letter-spacing: 0.06em;
        text-transform: uppercase;
    }

    .db-sidebar-brand-name span { color: var(--accent); }

    .db-sidebar-profile {
        padding: 1.5rem;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        gap: 0.875rem;
        flex-shrink: 0;
    }

    .db-sidebar-avatar {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border: 2px solid var(--accent);
        flex-shrink: 0;
    }

    .db-sidebar-avatar-placeholder {
        width: 50px;
        height: 50px;
        background: var(--accent);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.125rem;;
        font-weight: 800;
        color: var(--dark);
        flex-shrink: 0;
    }

    .db-sidebar-profile-name {
        font-size: 1.125rem;;
        font-weight: 700;
        color: var(--dark);
        line-height: 1.3;
    }

    .db-sidebar-profile-role {
        font-size: 1.125rem;;
        color: var(--gray-400);
        margin-top: 0.1rem;
    }

    .db-sidebar-nav {
        padding: 1.25rem 0;
        flex: 1;
        overflow: hidden;
    }

    .db-nav-label {
        font-size: 1.125rem;;
        font-weight: 800;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: var(--gray-300);
        padding: 0.75rem 1.5rem 0.4rem;
    }

    .db-sidebar-nav a {
        display: block;
        padding: 0.65rem 1.5rem;
        color: var(--gray-500);
        text-decoration: none;
        font-size: 1.125rem;;
        font-weight: 500;
        border-left: 2px solid transparent;
        transition: color 0.15s, border-color 0.15s, background 0.15s;
    }

    .db-sidebar-nav a:hover {
        color: var(--dark);
        background: var(--gray-100);
    }

    .db-sidebar-nav a.active {
        color: var(--dark);
        font-weight: 700;
        border-left-color: var(--accent);
        background: rgba(215, 223, 35, 0.07);
    }

    /* ── MAIN ── */
    .db-main {
        flex: 1;
        min-width: 0;
        display: flex;
        flex-direction: column;
    }

    /* ── TOPBAR — not sticky, scrolls with page ── */
    .db-topbar {
        background: var(--white);
        border-bottom: 1px solid var(--border);
        padding: 1.1rem 2.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1.5rem;
    }

    .db-topbar-greeting {
        font-size: 1.25rem;;
        font-weight: 700;
        color: var(--dark);
        white-space: nowrap;
    }

    .db-topbar-greeting span {
        font-weight: 400;
        color: var(--gray-400);
    }

    .db-search-form {
        display: flex;
        flex: 1;
        max-width: 440px;
    }

    .db-search-form input {
        flex: 1;
        padding: 0.65rem 1rem;
        border: 1px solid var(--border);
        border-right: none;
        font-family: var(--font);
        font-size: 1rem;
        color: var(--dark);
        background: var(--gray-100);
        outline: none;
        transition: border-color 0.15s;
    }

    .db-search-form input:focus {
        border-color: var(--accent);
        background: var(--white);
    }

    .db-search-form button {
        padding: 0.65rem 1.35rem;
        background: var(--accent);
        border: 1px solid var(--accent);
        font-family: var(--font);
        font-size: 1rem;
        font-weight: 800;
        color: var(--dark);
        cursor: pointer;
        transition: background 0.15s;
        white-space: nowrap;
    }

    .db-search-form button:hover { background: #c8d500; border-color: #c8d500; }

    /* ── CONTENT — constrained width with padding ── */
    .db-content {
        flex: 1;
        padding: 2.5rem;
        max-width: 1200px;
        width: 100%;
        margin: 0 auto;
    }

    /* ── SECTION LABEL ── */
    .db-section-label {
        font-size: 1rem;
        font-weight: 800;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--gray-400);
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--accent);
        display: inline-block;
    }

    .db-section-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 1rem;
    }

    .db-section-header a {
        font-size: 1rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--gray-400);
        text-decoration: none;
        transition: color 0.15s;
    }

    .db-section-header a:hover { color: var(--dark); }

    /* ── BADGE ── */
    .db-badge {
        display: inline-block;
        background: var(--accent);
        color: var(--dark);
        font-size: 1rem;
        font-weight: 800;
        padding: 0.1rem 0.5rem;
        letter-spacing: 0.04em;
        vertical-align: middle;
        margin-left: 0.4rem;
    }

    /* ── CONNECTION REQUEST CARDS ── */
    .db-requests-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        border: 1px solid var(--border);
        background: var(--border);
        gap: 1px;
        margin-bottom: 2.5rem;
    }

    .db-request-card {
        background: var(--white);
        padding: 1.5rem;
        display: flex;
        align-items: flex-start;
        gap: 1rem;
    }

    .db-request-avatar {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border: 2px solid var(--accent);
        flex-shrink: 0;
    }

    .db-request-avatar-ph {
        width: 50px;
        height: 50px;
        background: var(--gray-100);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.15rem;
        font-weight: 800;
        color: var(--dark);
        flex-shrink: 0;
        border: 2px solid var(--border);
    }

    .db-request-info { flex: 1; min-width: 0; }

    .db-request-name {
        font-size: 1rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 0.2rem;
    }

    .db-request-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--gray-500);
        margin-bottom: 0.1rem;
    }

    .db-request-institution {
        font-size: 1rem;
        color: var(--gray-400);
        margin-bottom: 0.4rem;
    }

    .db-request-time {
        font-size: 1rem;
        color: var(--gray-300);
    }

    .db-request-actions {
        display: flex;
        flex-direction: column;
        gap: 0.45rem;
        flex-shrink: 0;
        align-items: stretch;
        min-width: 92px;
    }

    .btn-accept {
        padding: 0.55rem 1rem;
        background: var(--accent);
        color: var(--dark);
        border: none;
        font-family: var(--font);
        font-size: 0.85rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.07em;
        cursor: pointer;
        transition: background 0.15s;
        text-align: center;
    }

    .btn-accept:hover { background: #c8d500; }

    .btn-decline {
        padding: 0.55rem 1rem;
        background: var(--dark);
        color: var(--white);
        border: none;
        font-family: var(--font);
        font-size: 0.85rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.07em;
        cursor: pointer;
        transition: background 0.15s;
        text-align: center;
    }

    .btn-decline:hover { background: var(--gray-800); }

    .btn-view-sm {
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--gray-400);
        text-decoration: none;
        text-align: center;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        transition: color 0.15s;
    }

    .btn-view-sm:hover { color: var(--dark); }

    /* ── TABS ── */
    .db-tabs-wrapper {
        background: var(--white);
        border: 1px solid var(--border);
    }

    .db-tabs-header {
        display: flex;
        border-bottom: 1px solid var(--border);
    }

    .db-tab-btn {
        padding: 1rem 1.75rem;
        background: none;
        border: none;
        border-bottom: 2px solid transparent;
        margin-bottom: -1px;
        font-family: var(--font);
        font-size: 0.82rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--gray-400);
        cursor: pointer;
        transition: color 0.15s, border-color 0.15s;
        white-space: nowrap;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .db-tab-btn:hover { color: var(--dark); }

    .db-tab-btn.active {
        color: var(--dark);
        border-bottom-color: var(--accent);
    }

    .db-tab-panel { display: none; }
    .db-tab-panel.active { display: block; }

    /* ── PEOPLE LIST ── */
    .db-people-list {
        display: grid;
        grid-template-columns:grid-template-columns: 1fr;
        gap: 1px;
        background: var(--border);
    }

    .db-person-card {
        background: var(--white);
        padding: 1.35rem 1.5rem;
        display: flex-row;
        align-items: center;
        gap: 1rem;
        transition: background 0.15s;
    }

    .db-person-card:hover { background: #fafafa; }

    .db-person-avatar {
        width: 46px;
        height: 46px;
        object-fit: cover;
        border: 2px solid var(--border);
        flex-shrink: 0;
    }

    .db-person-avatar-ph {
        width: 46px;
        height: 46px;
        background: var(--gray-100);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.05rem;
        font-weight: 800;
        color: var(--dark);
        flex-shrink: 0;
    }

    .db-person-info { flex: 2; min-width: 0; }

    .db-person-name {
        font-size: 1rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 0.15rem;
    }

    .db-person-subtitle {
        font-size: 0.85rem;
        color: var(--gray-500);
        margin-bottom: 0.05rem;
    }

    .db-person-inst {
        font-size: 0.8rem;
        color: var(--gray-400);
    }

    .db-request-actions {
        display: ;
        gap: 0.5rem;
        align-items: center;
        flex-shrink: 0;
    }

    .btn-outline-sm {
        padding: 0.45rem 0.9rem;
        background: var(--white);
        border: 1px solid var(--border);
        font-family: var(--font);
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.06em;
        color: var(--gray-500);
        text-decoration: none;
        cursor: pointer;
        transition: border-color 0.15s, color 0.15s;
        white-space: nowrap;
    }

    .btn-outline-sm:hover { border-color: var(--dark); color: var(--dark); }

    .btn-accent-sm {
        padding: 0.45rem 1rem;
        background: var(--accent);
        border: 1px solid var(--accent);
        font-family: var(--font);
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.06em;
        color: var(--dark);
        cursor: pointer;
        transition: background 0.15s;
        white-space: nowrap;
    }

    .btn-accent-sm:hover { background: #c8d500; border-color: #c8d500; }

    /* ── ACTIVITY ── */
    .db-activity-list {
        display: flex;
        flex-direction: column;
        gap: 1px;
        background: var(--border);
    }

    .db-activity-item {
        background: var(--white);
        padding: 1.35rem 1.5rem;
        display: flex;
        gap: 1rem;
        align-items: flex-start;
    }

    .db-activity-dot {
        width: 8px;
        height: 8px;
        flex-shrink: 0;
        margin-top: 0.5rem;
        background: var(--accent);
    }

    .db-activity-dot.read { background: var(--border); }

    .db-activity-title {
        font-size: 0.97rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 0.2rem;
    }

    .db-activity-msg {
        font-size: 0.88rem;
        color: var(--gray-500);
        margin-bottom: 0.35rem;
        line-height: 1.6;
    }

    .db-activity-time {
        font-size: 0.78rem;
        color: var(--gray-300);
    }

    /* ── EMPTY STATES ── */
    .db-empty {
        padding: 3.5rem 2rem;
        text-align: center;
        color: var(--gray-400);
    }

    .db-empty p {
        font-size: 0.95rem;
        margin-bottom: 1.5rem;
        color: var(--gray-500);
    }

    .btn-primary-full {
        display: inline-block;
        padding: 0.75rem 1.75rem;
        background: var(--dark);
        color: var(--white);
        text-decoration: none;
        font-family: var(--font);
        font-size: 1rem;
        font-weight: 800;
        border: none;
        cursor: pointer;
        transition: background 0.15s;
    }

    .btn-primary-full:hover { background: var(--gray-800); }

    /* ── RESPONSIVE ── */
    @media (max-width: 900px) {
        .db-shell {
         padding: 2rem 0;
}
        .db-sidebar { display: none; }
        .db-topbar { padding: 1rem 1.25rem; flex-wrap: wrap; }
        .db-content { padding: 1.5rem 1.25rem; }
        .db-requests-grid { grid-template-columns: 1fr; }
        .db-people-list { grid-template-columns: 1fr; }
    }
</style>

<div class="db-shell">

    {{-- ── SIDEBAR ── --}}
    <aside class="db-sidebar">


        <div class="db-sidebar-profile">
            @if(Auth::user()->photo)
                <img src="{{ Storage::url(Auth::user()->photo) }}" class="db-sidebar-avatar" alt="{{ Auth::user()->first_name }}">
            @else
                <div class="db-sidebar-avatar-placeholder">
                    {{ strtoupper(substr(Auth::user()->first_name ?? Auth::user()->name, 0, 1)) }}
                </div>
            @endif
            <div>
                <div class="db-sidebar-profile-name">{{ Auth::user()->first_name ?? Auth::user()->name }} {{ Auth::user()->last_name ?? '' }}</div>
                <div class="db-sidebar-profile-role">{{ Auth::user()->job_title ?? 'Academic' }}</div>
            </div>
        </div>

        <nav class="db-sidebar-nav">
            <div class="db-nav-label">Menu</div>
            <a href="{{ route('dashboard') }}" class="active">Dashboard</a>
            <a href="{{ route('my-profile', Auth::user()) }}">My profile</a>
            <a href="{{ route('profile.edit') }}">Edit profile</a>

            <div class="db-nav-label">Network</div>
            <a href="{{ route('search') }}">Search academics</a>
        </nav>

    </aside>

    {{-- ── MAIN ── --}}
    <div class="db-main">

        {{-- Top bar — not sticky, scrolls normally --}}
        <div class="db-topbar">
            @php
                $hour = date('H');
                $greeting = $hour < 12 ? 'Good morning' : ($hour < 17 ? 'Good afternoon' : 'Good evening');
            @endphp
            <div class="db-topbar-greeting" id="db-greeting">
                {{ $greeting }}, <span>{{ Auth::user()->first_name ?? Auth::user()->name }}</span>
            </div>

            <form class="db-search-form" action="{{ route('search') }}" method="GET">
                <input type="text" name="search" placeholder="Search academics, institutions..." value="{{ request('search') }}">
                <button type="submit">Search</button>
            </form>
        </div>

        {{-- Page content --}}
        <div class="db-content">

            {{-- Connection requests — always visible if any --}}
            @if($connectionRequests->count() > 0)
            <div style="margin-bottom: 2.5rem;">
                <div class="db-section-header">
                    <div class="db-section-label">
                        Connection requests
                        <span class="db-badge">{{ $connectionRequests->count() }}</span>
                    </div>
                    @if($connectionRequests->count() > 6)
                        <a href="{{ route('search') }}">View all</a>
                    @endif
                </div>

                <div class="db-requests-grid">
                    @foreach($connectionRequests as $req)
                    <div class="db-request-card">
                        @if($req->requester->photo)
                            <img src="{{ Storage::url($req->requester->photo) }}" class="db-request-avatar" alt="{{ $req->requester->first_name }}">
                        @else
                            <div class="db-request-avatar-ph">{{ strtoupper(substr($req->requester->first_name, 0, 1)) }}</div>
                        @endif

                        <div class="db-request-info">
                            <div class="db-request-name">{{ $req->requester->first_name }} {{ $req->requester->last_name }}</div>
                            <div class="db-request-title">{{ $req->requester->job_title ?? 'Academic' }}</div>
                            <div class="db-request-institution">{{ $req->requester->institution }}</div>
                            <div class="db-request-time">{{ $req->created_at->diffForHumans() }}</div>
                        </div>

                        <div class="db-request-actions">
                            <button class="btn-accept" onclick="acceptConnection({{ $req->id }})">Accept</button>
                            <button class="btn-decline" onclick="declineConnection({{ $req->id }})">Decline</button>
                            <a href="{{ route('profile.show', $req->requester) }}" class="btn-view-sm">View profile</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Network tabs --}}
            <div class="db-section-header">
                <div class="db-section-label">Your network</div>
            </div>

            <div class="db-tabs-wrapper">
                <div class="db-tabs-header">

                    {{-- FIX: @if moved outside button tag, badge rendered via PHP ternary --}}
                    <button class="db-tab-btn active" onclick="switchTab('connections', this)">
                        My connections
                        @php $connCount = $connections->count(); @endphp
                        @if($connCount > 0)
                            <span class="db-badge">{{ $connCount }}</span>
                        @endif
                    </button>

                    <button class="db-tab-btn" onclick="switchTab('suggestions', this)">
                        People you may know
                    </button>

                    <button class="db-tab-btn" onclick="switchTab('activity', this)">
                        Activity
                    </button>

                </div>

                {{-- My connections --}}
                <div id="tab-connections" class="db-tab-panel active">
                    @if($connections->count() > 0)
                        <div class="db-people-list">
                            @foreach($connections as $conn)
                            <div class="db-request-card">
                                @if($conn->photo)
                                    <img src="{{ Storage::url($conn->photo) }}" class="db-person-avatar" alt="{{ $conn->first_name }}">
                                @else
                                    <div class="db-person-avatar-ph">{{ strtoupper(substr($conn->first_name, 0, 1)) }}</div>
                                @endif
                                <div class="db-person-info">
                                    <div class="db-person-name">{{ $conn->first_name }} {{ $conn->last_name }}</div>
                                    <div class="db-request-title">{{ $conn->job_title ?? 'Academic' }}</div>
                                    <div class="db-person-inst">{{ $conn->institution }}</div>
                                </div>
                                <div class="db-request-actions">
                                    <a href="{{ route('profile.show', $conn) }}" class="btn-outline-sm">View Profile</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="db-empty">
                            <p>No connections yet. Start building your network.</p>
                            <a href="{{ route('search') }}" class="btn-primary-full">Find academics</a>
                        </div>
                    @endif
                </div>

                {{-- People you may know --}}
                <div id="tab-suggestions" class="db-tab-panel">
                    @if($suggestions->count() > 0)
                        <div class="db-people-list">
                            @foreach($suggestions as $sug)
                            <div class="db-request-card">
                                @if($sug->photo)
                                    <img src="{{ Storage::url($sug->photo) }}" class="db-person-avatar" alt="{{ $sug->first_name }}">
                                @else
                                    <div class="db-person-avatar-ph">{{ strtoupper(substr($sug->first_name, 0, 1)) }}</div>
                                @endif
                                <div class="db-person-info">
                                    <div class="db-person-name">{{ $sug->first_name }} {{ $sug->last_name }}</div>
                                    <div class="db-request-title">{{ $sug->job_title ?? 'Academic' }}</div>
                                    <div class="db-person-inst">{{ $sug->institution }}</div>
                                </div>
                                <div class="db-request-actions">
                                    <a href="{{ route('profile.show', $sug) }}" class="btn-outline-sm">View Profile</a>
                                    <button class="btn-accent-sm" onclick="sendConnectionRequest({{ $sug->id }})">Connect</button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="db-empty">
                            <p>No suggestions right now. Check back later.</p>
                        </div>
                    @endif
                </div>

                {{-- Activity --}}
                <div id="tab-activity" class="db-tab-panel">
                    @if($recentNotifications->count() > 0 || $recentConnections->count() > 0)
                        <div class="db-activity-list">
                            @foreach($recentNotifications->take(8) as $notif)
                            <div class="db-activity-item">
                                <div class="db-activity-dot {{ $notif->read_at ? 'read' : '' }}"></div>
                                <div>
                                    <div class="db-activity-title">{{ $notif->title }}</div>
                                    <div class="db-activity-msg">{{ $notif->message }}</div>
                                    <div class="db-activity-time">{{ $notif->created_at->diffForHumans() }}</div>
                                </div>
                            </div>
                            @endforeach

                            @if($recentConnections->count() > 0)
                            <div class="db-activity-item">
                                <div class="db-activity-dot read"></div>
                                <div>
                                    <div class="db-activity-title">Your network is growing</div>
                                    <div class="db-activity-msg">
                                        You have {{ $connections->count() }} connection{{ $connections->count() !== 1 ? 's' : '' }} in your network.
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    @else
                        <div class="db-empty">
                            <p>No recent activity. Start connecting to see updates here.</p>
                            <a href="{{ route('search') }}" class="btn-primary-full">Search academics</a>
                        </div>
                    @endif
                </div>

            </div>{{-- /tabs --}}

        </div>{{-- /content --}}
    </div>{{-- /main --}}
</div>{{-- /shell --}}

<script>
function switchTab(name, el) {
    document.querySelectorAll('.db-tab-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.db-tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('tab-' + name).classList.add('active');
    el.classList.add('active');
}

async function sendConnectionRequest(userId) {
    try {
        const r = await fetch(`/connect/request/${userId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        });
        if (r.ok) location.reload();
        else { const e = await r.json(); alert(e.error || 'Failed to send request'); }
    } catch { alert('An error occurred. Please try again.'); }
}

async function acceptConnection(id) {
    try {
        const r = await fetch(`/connect/accept/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        });
        if (r.ok) location.reload();
        else { const e = await r.json(); alert(e.error || 'Failed to accept'); }
    } catch { alert('An error occurred. Please try again.'); }
}

async function declineConnection(id) {
    if (!confirm('Decline this connection request?')) return;
    try {
        const r = await fetch(`/connect/decline/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        });
        if (r.ok) location.reload();
        else { const e = await r.json(); alert(e.error || 'Failed to decline'); }
    } catch { alert('An error occurred. Please try again.'); }
}

function updateGreeting() {
    const h = new Date().getHours();
    const g = h < 12 ? 'Good morning' : h < 17 ? 'Good afternoon' : 'Good evening';
    const el = document.getElementById('db-greeting');
    if (el) el.innerHTML = `${g}, <span>{{ Auth::user()->first_name ?? Auth::user()->name }}</span>`;
}
updateGreeting();
setInterval(updateGreeting, 60000);
</script>

@endsection