@extends('layouts.app')

@section('title', 'Admin Panel — Sarua Connect')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

    .admin-wrap {
        font-family: 'Inter', sans-serif;
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1.5rem;
    }

    /* ── Page header ── */
    .admin-page-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 2rem;
        padding-bottom: 1.25rem;
        border-bottom: 2px solid #f0f0f0;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .admin-page-header h1 {
        font-size: 1.7rem;
        font-weight: 800;
        color: #111;
        letter-spacing: -0.03em;
        margin: 0;
    }

    .admin-badge {
        display: inline-block;
        background: #d7df23;
        color: #111;
        font-size: 0.65rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        padding: 0.2rem 0.55rem;
        border-radius: 3px;
        vertical-align: middle;
        margin-left: 0.5rem;
    }

    .admin-sub {
        font-size: 0.82rem;
        color: #888;
        margin-top: 0.35rem;
    }

    /* ── Stat grid ── */
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(170px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: #fff;
        border: 1.5px solid #eee;
        border-radius: 4px;
        padding: 1.25rem 1rem;
        text-align: center;
    }

    .stat-card.highlight { border-color: #d7df23; background: #faffd0; }
    .stat-card.danger    { border-color: #f87171; background: #fff5f5; }
    .stat-card.warn      { border-color: #fb923c; background: #fff8f3; }

    .stat-num {
        font-size: 2rem;
        font-weight: 800;
        color: #111;
        line-height: 1;
        letter-spacing: -0.04em;
    }

    .stat-label {
        font-size: 0.68rem;
        color: #777;
        text-transform: uppercase;
        letter-spacing: 0.07em;
        font-weight: 600;
        margin-top: 0.4rem;
    }

    /* ── Section title ── */
    .section-title {
        font-size: 0.78rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #444;
        margin-bottom: 0.85rem;
        padding-bottom: 0.5rem;
        border-bottom: 1.5px solid #f0f0f0;
    }

    /* ── Filter bar ── */
    .filter-bar {
        display: flex;
        gap: 0.6rem;
        flex-wrap: wrap;
        margin-bottom: 1.25rem;
        background: #fafafa;
        border: 1.5px solid #eee;
        padding: 0.85rem 1rem;
        border-radius: 4px;
    }

    .filter-bar input,
    .filter-bar select {
        flex: 1;
        min-width: 160px;
        height: 38px;
        border: 1.5px solid #e0e0e0;
        padding: 0 0.85rem;
        font-family: 'Inter', sans-serif;
        font-size: 0.83rem;
        color: #333;
        border-radius: 4px;
        outline: none;
        background: #fff;
    }

    .filter-bar input:focus,
    .filter-bar select:focus { border-color: #d7df23; }

    .filter-bar button {
        height: 38px;
        padding: 0 1.25rem;
        background: #d7df23;
        border: none;
        font-family: 'Inter', sans-serif;
        font-weight: 700;
        font-size: 0.8rem;
        cursor: pointer;
        border-radius: 4px;
        color: #111;
        white-space: nowrap;
    }

    .filter-bar button:hover { background: #c8d000; }

    .filter-bar a.clear-link {
        height: 38px;
        display: flex;
        align-items: center;
        padding: 0 0.9rem;
        font-size: 0.8rem;
        color: #888;
        text-decoration: none;
        border: 1.5px solid #e0e0e0;
        border-radius: 4px;
        white-space: nowrap;
        background: #fff;
    }

    .filter-bar a.clear-link:hover { color: #555; border-color: #ccc; }

    /* ── Table ── */
    .admin-table-wrap {
        background: #fff;
        border: 1.5px solid #eee;
        border-radius: 4px;
        overflow-x: auto;
    }

    table.admin-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.83rem;
    }

    .admin-table th {
        background: #f8f8f8;
        border-bottom: 1.5px solid #eee;
        padding: 0.65rem 0.9rem;
        text-align: left;
        font-size: 0.68rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.07em;
        color: #555;
        white-space: nowrap;
    }

    .admin-table td {
        padding: 0.7rem 0.9rem;
        border-bottom: 1px solid #f5f5f5;
        vertical-align: middle;
        color: #222;
    }

    .admin-table tr:last-child td { border-bottom: none; }
    .admin-table tr:hover td { background: #fafafa; }

    /* ── Status badges ── */
    .badge {
        display: inline-block;
        padding: 0.18rem 0.55rem;
        border-radius: 20px;
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        white-space: nowrap;
    }

    .badge-active      { background: #dcfce7; color: #166534; }
    .badge-deactivated { background: #f3f3f3; color: #666; }
    .badge-banned      { background: #fee2e2; color: #991b1b; }
    .badge-incomplete  { background: #fef9c3; color: #854d0e; }

    /* ── Action buttons ── */
    .action-group {
        display: flex;
        gap: 0.35rem;
        flex-wrap: wrap;
    }

    .btn-act {
        display: inline-block;
        padding: 0.3rem 0.75rem;
        font-family: 'Inter', sans-serif;
        font-size: 0.72rem;
        font-weight: 700;
        border: none;
        cursor: pointer;
        border-radius: 3px;
        transition: opacity 0.15s;
        text-decoration: none;
        white-space: nowrap;
    }

    .btn-act:hover { opacity: 0.85; }

    .btn-deactivate { background: #f3f3f3; color: #333; }
    .btn-reactivate { background: #dcfce7; color: #166534; }
    .btn-ban        { background: #fee2e2; color: #991b1b; }
    .btn-unban      { background: #dbeafe; color: #1e40af; }
    .btn-delete     { background: #111;    color: #fff; }
    .btn-view       { background: #f5f6d0; color: #6b7200; }

    /* ── Ban modal ── */
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.45);
        z-index: 9000;
        align-items: center;
        justify-content: center;
    }

    .modal-overlay.open { display: flex; }

    .modal-box {
        background: #fff;
        width: 100%;
        max-width: 440px;
        border-radius: 6px;
        padding: 1.75rem;
        box-shadow: 0 20px 50px rgba(0,0,0,0.2);
    }

    .modal-box h3 {
        font-size: 1.05rem;
        font-weight: 800;
        color: #111;
        margin: 0 0 0.5rem 0;
    }

    .modal-box p  { font-size: 0.85rem; color: #555; margin: 0 0 1rem 0; }

    .modal-box textarea {
        width: 100%;
        border: 1.5px solid #ddd;
        border-radius: 4px;
        padding: 0.65rem 0.85rem;
        font-family: 'Inter', sans-serif;
        font-size: 0.83rem;
        resize: vertical;
        outline: none;
        min-height: 80px;
        margin-bottom: 1rem;
    }

    .modal-box textarea:focus { border-color: #d7df23; }

    .modal-actions { display: flex; gap: 0.75rem; justify-content: flex-end; }

    .btn-modal-cancel  { padding: 0.5rem 1.1rem; background: #f3f3f3; border: none; border-radius: 3px; font-family: 'Inter', sans-serif; font-size: 0.82rem; font-weight: 600; cursor: pointer; }
    .btn-modal-confirm { padding: 0.5rem 1.1rem; background: #ef4444; color: #fff; border: none; border-radius: 3px; font-family: 'Inter', sans-serif; font-size: 0.82rem; font-weight: 700; cursor: pointer; }

    /* ── Pagination ── */
    .pag-wrap { padding: 1rem 0 0; }
    .pag-wrap .pagination { display: flex; gap: 0.3rem; list-style: none; padding: 0; margin: 0; flex-wrap: wrap; }
    .pag-wrap .pagination a,
    .pag-wrap .pagination span { display: block; padding: 0.35rem 0.75rem; border: 1.5px solid #e8e8e8; font-size: 0.78rem; font-weight: 600; border-radius: 3px; color: #444; text-decoration: none; }
    .pag-wrap .pagination a:hover { background: #d7df23; border-color: #d7df23; color: #111; }
    .pag-wrap .pagination .active span { background: #d7df23; border-color: #d7df23; color: #111; }
    .pag-wrap .pagination .disabled span { color: #ddd; border-color: #f0f0f0; }

    /* ── Empty ── */
    .table-empty { padding: 3rem; text-align: center; color: #999; font-size: 0.88rem; }

    /* ── Mobile ── */
    @media (max-width: 640px) {
        .admin-wrap { padding: 0 0.75rem; }
        .stat-grid  { grid-template-columns: repeat(2, 1fr); }
    }
</style>

<div class="admin-wrap">

    {{-- Page header --}}
    <div class="admin-page-header">
        <div>
            <h1>Admin Panel <span class="admin-badge">ADMIN</span></h1>
            <p class="admin-sub">Logged in as {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} &bull; {{ now()->format('d M Y, H:i') }}</p>
        </div>
        <a href="{{ route('dashboard') }}" style="font-size:0.82rem;color:#888;text-decoration:none;">← Back to Dashboard</a>
    </div>

    {{-- Flash messages --}}
    @if(session('success'))
        <div style="background:#dcfce7;color:#166534;border:1.5px solid #bbf7d0;padding:0.75rem 1rem;border-radius:4px;margin-bottom:1.25rem;font-size:0.84rem;font-weight:600;">
            ✓ {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div style="background:#fee2e2;color:#991b1b;border:1.5px solid #fecaca;padding:0.75rem 1rem;border-radius:4px;margin-bottom:1.25rem;font-size:0.84rem;font-weight:600;">
            ✕ {{ session('error') }}
        </div>
    @endif

    {{-- Stats --}}
    <p class="section-title">Platform Overview</p>
    <div class="stat-grid">
        <div class="stat-card highlight">
            <div class="stat-num">{{ $totalUsers }}</div>
            <div class="stat-label">Total Users</div>
        </div>
        <div class="stat-card">
            <div class="stat-num">{{ $activeUsers }}</div>
            <div class="stat-label">Active</div>
        </div>
        <div class="stat-card warn">
            <div class="stat-num">{{ $deactivatedUsers }}</div>
            <div class="stat-label">Deactivated</div>
        </div>
        <div class="stat-card danger">
            <div class="stat-num">{{ $bannedUsers }}</div>
            <div class="stat-label">Banned</div>
        </div>
        <div class="stat-card">
            <div class="stat-num">{{ $totalConnections }}</div>
            <div class="stat-label">Connections</div>
        </div>
        <div class="stat-card">
            <div class="stat-num">{{ $completeProfiles }}</div>
            <div class="stat-label">Full Profiles</div>
        </div>
        <div class="stat-card">
            <div class="stat-num">{{ $newToday }}</div>
            <div class="stat-label">Joined Today</div>
        </div>
        <div class="stat-card">
            <div class="stat-num">{{ $newThisWeek }}</div>
            <div class="stat-label">This Week</div>
        </div>
        <div class="stat-card">
            <div class="stat-num">{{ $newThisMonth }}</div>
            <div class="stat-label">This Month</div>
        </div>
    </div>

    {{-- User management --}}
    <p class="section-title">User Management &mdash; {{ $users->total() }} result{{ $users->total() !== 1 ? 's' : '' }}</p>

    {{-- Filter bar --}}
    <form method="GET" action="{{ route('admin.index') }}">
        <div class="filter-bar">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search by name, email, institution…">
            <select name="status">
                <option value="">All Statuses</option>
                <option value="active"      {{ request('status') == 'active'      ? 'selected' : '' }}>Active</option>
                <option value="deactivated" {{ request('status') == 'deactivated' ? 'selected' : '' }}>Deactivated</option>
                <option value="banned"      {{ request('status') == 'banned'      ? 'selected' : '' }}>Banned</option>
            </select>
            <select name="country">
                <option value="">All Countries</option>
                @foreach($countries as $c)
                    <option value="{{ $c }}" {{ request('country') == $c ? 'selected' : '' }}>{{ $c }}</option>
                @endforeach
            </select>
            <button type="submit">Filter</button>
            <a href="{{ route('admin.index') }}" class="clear-link">✕ Clear</a>
        </div>
    </form>

    {{-- Table --}}
    <div class="admin-table-wrap">
        @if($users->count())
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Email</th>
                    <th>Institution</th>
                    <th>Country</th>
                    <th>Status</th>
                    <th>Joined</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                <tr>
                    <td style="color:#bbb;font-size:0.75rem;">{{ $u->id }}</td>
                    <td>
                        <strong>{{ $u->title }} {{ $u->first_name }} {{ $u->last_name }}</strong>
                        @if($u->job_title)<br><span style="font-size:0.74rem;color:#888;">{{ $u->job_title }}</span>@endif
                    </td>
                    <td style="font-size:0.78rem;color:#555;">{{ $u->email }}</td>
                    <td style="font-size:0.78rem;">{{ $u->institution ?? '—' }}</td>
                    <td style="font-size:0.78rem;">{{ $u->country ?? '—' }}</td>
                    <td>
                        @if($u->is_banned)
                            <span class="badge badge-banned">Banned</span>
                        @elseif(! $u->is_active)
                            <span class="badge badge-deactivated">Deactivated</span>
                        @elseif($u->registration_step < 2)
                            <span class="badge badge-incomplete">Incomplete</span>
                        @else
                            <span class="badge badge-active">Active</span>
                        @endif
                    </td>
                    <td style="font-size:0.74rem;color:#888;white-space:nowrap;">{{ $u->created_at->format('d M Y') }}</td>
                    <td>
                        <div class="action-group">
                            {{-- View profile --}}
                            <a href="{{ route('profile.show', $u->id) }}" class="btn-act btn-view" target="_blank">View</a>

                            {{-- Deactivate / Reactivate --}}
                            @if(! $u->is_banned)
                                <form method="POST" action="{{ route('admin.users.toggle-active', $u->id) }}" style="display:inline;">
                                    @csrf
                                    @if($u->is_active)
                                        <button class="btn-act btn-deactivate" type="submit"
                                            onclick="return confirm('Deactivate {{ addslashes($u->first_name) }} {{ addslashes($u->last_name) }}?')">Deactivate</button>
                                    @else
                                        <button class="btn-act btn-reactivate" type="submit">Reactivate</button>
                                    @endif
                                </form>
                            @endif

                            {{-- Ban / Unban --}}
                            @if($u->is_banned)
                                <form method="POST" action="{{ route('admin.users.unban', $u->id) }}" style="display:inline;">
                                    @csrf
                                    <button class="btn-act btn-unban" type="submit"
                                        onclick="return confirm('Unban {{ addslashes($u->first_name) }} {{ addslashes($u->last_name) }}?')">Unban</button>
                                </form>
                            @else
                                <button class="btn-act btn-ban"
                                    onclick="openBanModal({{ $u->id }}, '{{ addslashes($u->first_name) }} {{ addslashes($u->last_name) }}')">Ban</button>
                            @endif

                            {{-- Delete --}}
                            <form method="POST" action="{{ route('admin.users.destroy', $u->id) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn-act btn-delete" type="submit"
                                    onclick="return confirm('Permanently delete {{ addslashes($u->first_name) }} {{ addslashes($u->last_name) }}? This cannot be undone.')">Delete</button>
                            </form>
                        </div>
                        @if($u->is_banned && $u->ban_reason)
                            <p style="font-size:0.69rem;color:#991b1b;margin-top:0.35rem;">Reason: {{ $u->ban_reason }}</p>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <div class="table-empty">No users match your filters.</div>
        @endif
    </div>

    @if($users->hasPages())
        <div class="pag-wrap">
            {{ $users->links() }}
        </div>
    @endif

</div>

{{-- ── Ban modal ── --}}
<div class="modal-overlay" id="banModal">
    <div class="modal-box">
        <h3>Ban User</h3>
        <p id="banModalName" style="font-weight:700;color:#111;margin-bottom:0.35rem;"></p>
        <p>Optionally provide a reason (visible to admins only):</p>
        <form id="banForm" method="POST">
            @csrf
            <textarea name="ban_reason" placeholder="Reason for ban (optional)…"></textarea>
            <div class="modal-actions">
                <button type="button" class="btn-modal-cancel" onclick="closeBanModal()">Cancel</button>
                <button type="submit" class="btn-modal-confirm">Confirm Ban</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openBanModal(userId, userName) {
        document.getElementById('banModalName').textContent = userName;
        document.getElementById('banForm').action = '/admin/users/' + userId + '/ban';
        document.getElementById('banModal').classList.add('open');
    }

    function closeBanModal() {
        document.getElementById('banModal').classList.remove('open');
    }

    // Close on backdrop click
    document.getElementById('banModal').addEventListener('click', function (e) {
        if (e.target === this) closeBanModal();
    });
</script>
@endsection
