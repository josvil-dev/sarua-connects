@extends('layouts.app')

@section('title', 'Find Professionals | Sarua Connect')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

    * { box-sizing: border-box; }

    .search-page {
        font-family: 'Inter', sans-serif;
        min-height: 100vh;
        background: #fff;
        max-width: 1150px;
        margin: 2rem auto;
      
    }

    /* ── TOP HERO SEARCH BAR ── */
    .search-hero {
        background: #fff;
        padding: 2rem 0 1.75rem;
        position: sticky;
        top: 0;
        z-index: 100;
       
    }

    .search-hero-inner {
        width: 90%;
        margin: 0 auto;
    }

    .search-hero-heading {
        font-size: 1.35rem;
        font-weight: 800;
        color: #111;
        margin: 0 0 1rem 0;
        letter-spacing: -0.03em;
    }

    .search-hero-heading span { color: #b8c200; }

    .top-search-row {
        display: flex;
        gap: 0.6rem;
        align-items: center;
    }

    .top-search-input {
        flex: 1;
        height: 48px;
        background: #fff;
        border: 1.5px solid #e0e0e0;
        color: #111;
        font-family: 'Inter', sans-serif;
        font-size: 0.93rem;
        padding: 0 1.1rem;
        outline: none;
        border-radius: 4px;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .top-search-input::placeholder { color: #aaa; }
    .top-search-input:focus { border-color: #d7df23; box-shadow: 0 0 0 3px rgba(215,223,35,0.15); }

    .search-submit-btn {
        height: 48px;
        padding: 0 1.75rem;
        background: #d7df23;
        color: #111;
        border: none;
        font-family: 'Inter', sans-serif;
        font-weight: 700;
        font-size: 0.88rem;
        cursor: pointer;
        
        transition: background 0.2s, transform 0.1s;
        white-space: nowrap;
    }

    .search-submit-btn:hover { background: #c8d000; transform: translateY(-1px); }

    .clear-btn {
        height: 48px;
        padding: 0 1.1rem;
        background: #fff;
        color: #888;
        border: solid #e0e0e0;
        font-family: 'Inter', sans-serif;
        font-size: 0.83rem;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.35rem;
        border-radius: 4px;
        transition: all 0.2s;
        white-space: nowrap;
    }

    .clear-btn:hover { border-color: #d7df23; color: #666; }

    /* ── MAIN LAYOUT ── */
    .main-layout {
        display: flex;
        gap: 0;
        width:90%;
        margin: 0 auto;
        height: calc(100vh - 136px);
    }

    /* ── PROFILE CARDS PANEL (65%) ── */
    .cards-panel {
        flex: 0 0 70%;
        overflow-y: auto;
        padding: 1.5rem 1.5rem 2rem 0;
        scrollbar-width: thin;
        scrollbar-color: #d7df23 #f0f0f0;
    }

    .cards-panel::-webkit-scrollbar { width: 5px; }
    .cards-panel::-webkit-scrollbar-track { background: #f5f5f5; }
    .cards-panel::-webkit-scrollbar-thumb { background: #d7df23; border-radius: 10px; }

    .results-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.1rem;
        padding-bottom: 0.75rem;
        border-bottom: 1.5px solid #f0f0f0;
    }

    .results-count { font-size: 0.95rem; font-weight: 700; color: #111; }
    .results-range { font-size: 0.78rem; color: #999; font-weight: 400; }

    /* ── PROFILE CARD ── */
    .profile-card {
        background: #fff;
        border: 1.5px solid #556328;
        border-left: 4px solid #556328;
        padding: 1.1rem 1.25rem;
        margin-bottom: 0.85rem;
        display: flex;
        gap: 1.1rem;
        align-items: flex-start;
        transition: box-shadow 0.2s ease, transform 0.2s ease;
        border-radius: 2px;
    }

    .profile-card:hover {
        box-shadow: 0 4px 20px rgba(0,0,0,0.07);
        transform: translateY(-2px);
    }

    .profile-avatar {
        width: 58px;
        height: 58px;
        flex-shrink: 0;
        object-fit: cover;
        border: 2.5px solid #d7df23;
        border-radius: 2px;
    }

    .profile-avatar-placeholder {
        width: 58px;
        height: 58px;
        flex-shrink: 0;
        background: #f5f6d0;
        border: 2.5px solid #d7df23;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 2px;
    }

    .profile-avatar-placeholder span {
        font-size: 1.4rem;
        font-weight: 800;
        color: #8a9200;
    }

    .profile-body { flex: 1; min-width: 0; }

    .profile-name {
        font-size: 0.97rem;
        font-weight: 700;
        color: #111;
        margin: 0 0 0.15rem 0;
        letter-spacing: -0.01em;
    }

    .profile-title {
        font-size: 0.85rem;
        color: #000000;
        font-weight: 500;
        margin: 0 0 0.5rem 0;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }

    .profile-meta { display: flex; gap: 1rem; flex-wrap: wrap; margin-bottom: 0.55rem; }
    .profile-meta span { font-size: 1rem; color: #000000; display: flex; align-items: center; gap: 0.25rem; }

    .profile-bio {
        font-size: 0.81rem;
        color: #666;
        line-height: 1.55;
        margin-bottom: 0.7rem;
        padding: 0.5rem 0.75rem;
        background: #fafafa;
        border-left: 2px solid #556328;
        border-radius: 0 2px 2px 0;
    }

    .profile-keywords { display: flex; flex-wrap: wrap; gap: 0.3rem; margin-bottom: 0.7rem; }

    .keyword-tag {
        background: #f5f6d0;
        color: #6b7200;
        padding: 0.18rem 0.55rem;
        font-size: 0.69rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        border-radius: 2px;
    }

    .keyword-more { color: #bbb; font-size: 0.72rem; align-self: center; }

    .view-profile-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        background: #111;
        color: #ffffff;
        padding: 0.4rem 1rem;
        font-family: 'Inter', sans-serif;
        font-size: 0.75rem;
        font-weight: 600;
        text-decoration: none;
     
        transition: all 0.2s;
    }

    .view-profile-btn:hover { background: #d7df23; color: #111; }

    /* ── FILTER SIDEBAR (35%) ── */
    .filter-sidebar {
        flex: 0 0 30%;
        background: #fff;
        border-left: 1.5px solid #f0f0f0;
        overflow-y: auto;
        padding: 1.5rem 0 2rem 1.5rem;
        scrollbar-width: thin;
        scrollbar-color: #d7df23 #f5f5f5;
    }

    .filter-sidebar::-webkit-scrollbar { width: 4px; }
    .filter-sidebar::-webkit-scrollbar-track { background: #f5f5f5; }
    .filter-sidebar::-webkit-scrollbar-thumb { background: #d7df23; border-radius: 10px; }

    .filter-sidebar-title {
        font-size: 1rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #000000;
        margin: 0 0 1rem 0;
        padding-bottom: 0.75rem;
        border-bottom: 1.5px solid #f0f0f0;
    }

    /* ── ACCORDION ── */
    .accordion-item { border-bottom: 1px solid #f0f0f0; }

    .accordion-trigger {
        width: 100%;
        background: none;
        border: none;
        padding: 0.9rem 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        font-family: 'Inter', sans-serif;
        font-size: 0.84rem;
        font-weight: 600;
        color: #222;
        text-align: left;
        transition: color 0.2s;
    }

    .accordion-trigger:hover { color: #555; }

    .chevron {
        width: 20px;
        height: 20px;
        background: #f5f5f5;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: transform 0.25s ease, background 0.2s;
        font-style: normal;
        font-size: 0.6rem;
        color: #666;
    }

    .accordion-trigger.open .chevron { transform: rotate(180deg); background: #d7df23; color: #111; }

    .accordion-body { max-height: 0; overflow: hidden; transition: max-height 0.3s ease; }
    .accordion-body.open { max-height: 400px; padding-bottom: 1rem; }

    .filter-input {
        width: 100%;
        border: 1.5px solid #e8e8e8;
        background: #fafafa;
        padding: 0.55rem 0.85rem;
        font-family: 'Inter', sans-serif;
        font-size: 0.85rem;
        color: #333;
        outline: none;
        border-radius: 4px;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .filter-input:focus { border-color: #d7df23; background: #fff; box-shadow: 0 0 0 3px rgba(215,223,35,0.12); }

    .filter-select {
        width: 100%;
        border: 1.5px solid #e8e8e8;
        background: #fafafa;
        padding: 0.55rem 2rem 0.55rem 0.85rem;
        font-family: 'Inter', sans-serif;
        font-size: 0.85rem;
        color: #333;
        outline: none;
        border-radius: 4px;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%23aaa' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 0.85rem center;
        cursor: pointer;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .filter-select:focus { border-color: #d7df23; background-color: #fff; box-shadow: 0 0 0 3px rgba(215,223,35,0.12); }

    .filter-select-multi {
        min-height: 180px;
        background-image: none;
        padding-right: 0.85rem;
    }

    .filter-search-hint {
        display: block;
        margin-top: 0.4rem;
        font-size: 0.72rem;
        color: #7a7a7a;
    }

    .filter-badge {
        background: #d7df23;
        color: #111;
        font-size: 0.62rem;
        font-weight: 700;
        padding: 0.1rem 0.4rem;
        border-radius: 20px;
        margin-left: 0.4rem;
    }

    .apply-btn {
        margin-top: 0.55rem;
        width: 100%;
        padding: 0.5rem;
        background: #d7df23;
        border: none;
        font-family: 'Inter', sans-serif;
        font-weight: 700;
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        cursor: pointer;
        border-radius: 3px;
        color: #111;
        transition: background 0.2s;
    }

    .apply-btn:hover { background: #c8d000; }

  

    .stat-box {
        background: #fff;
        border: 1.5px solid #efefef;
        padding: 1rem 0.75rem;
        text-align: center;
        border-radius: 4px;
    }

    .stat-number {
        font-size: 1.7rem;
        font-weight: 800;
        color: #111;
        display: block;
        letter-spacing: -0.03em;
        line-height: 1;
        margin-bottom: 0.3rem;
    }

    .stat-label { font-size: 0.7rem; color: #aaa; text-transform: uppercase; letter-spacing: 0.07em; font-weight: 500; }
    .stat-dot { display: inline-block; width: 6px; height: 6px; background: #d7df23; border-radius: 50%; margin-right: 0.3rem; vertical-align: middle; }

    /* ── EMPTY STATE ── */
    .empty-state { text-align: center; padding: 4rem 2rem; }
    .empty-icon { font-size: 3rem; display: block; margin-bottom: 1rem; opacity: 0.3; }
    .empty-state h3 { font-size: 1.1rem; font-weight: 700; color: #333; margin-bottom: 0.6rem; }
    .empty-state p { color: #999; font-size: 0.87rem; margin-bottom: 1.5rem; }

    /* ── PAGINATION ── */
    .pagination-wrap { padding: 1.25rem 0 0.5rem; }
    .pagination { display: flex; justify-content: flex-start; list-style: none; padding: 0; margin: 0; gap: 0.3rem; flex-wrap: wrap; }
    .pagination a, .pagination span { display: block; padding: 0.4rem 0.8rem; color: #444; text-decoration: none; border: 1.5px solid #e8e8e8; font-size: 0.8rem; font-weight: 600; border-radius: 3px; transition: all 0.2s; }
    .pagination a:hover { background: #d7df23; border-color: #d7df23; color: #111; }
    .pagination .active span { background: #d7df23; border-color: #d7df23; color: #111; }
    .pagination .disabled span { color: #ddd; border-color: #f0f0f0; }

    /* ── RESPONSIVE ── */
    @media (max-width: 1024px) {
        .search-hero-inner { width: 100%; padding: 0 1.25rem; }
        .main-layout { width: 100%; flex-direction: column; height: auto; padding: 0 1.25rem; }
        .cards-panel { flex: none; padding: 1.25rem 0 1rem 0; overflow-y: visible; }
        .filter-sidebar { flex: none; border-left: none; border-top: 1.5px solid #f0f0f0; padding: 1.25rem 0 1.5rem 0; overflow-y: visible; }
    }

    @media (max-width: 640px) {
        .search-hero-inner { padding: 0 1rem; }
        .main-layout { padding: 0 1rem; }
        .top-search-row { flex-wrap: wrap; }
        .search-submit-btn, .clear-btn { flex: 1; justify-content: center; }
    }
</style>

<div class="search-page">

    <!-- ═══ STICKY SEARCH HERO ═══ -->
    <div class="search-hero">
        <div class="search-hero-inner">
            <p class="search-hero-heading">About this database</p>
            <p>This directory features academic scholars, researchers and postgraduate supervisors from higher education institutions in SADC member states. Use the global search or the filters below.</p>
         
            <form method="GET" action="{{ route('search') }}">
                <div class="top-search-row">
                    <input type="text" name="search" class="top-search-input"
                           value="{{ request('search') }}"
                           placeholder="Search by name, job title, institution, or keywords…">
                    @foreach((array) request()->input('country', []) as $selectedCountry)
                        @if($selectedCountry)
                            <input type="hidden" name="country[]" value="{{ $selectedCountry }}">
                        @endif
                    @endforeach
                    @foreach((array) request()->input('institution', []) as $selectedInstitution)
                        @if($selectedInstitution)
                            <input type="hidden" name="institution[]" value="{{ $selectedInstitution }}">
                        @endif
                    @endforeach
                    <input type="hidden" name="job_title" value="{{ request('job_title') }}">
                    <input type="hidden" name="keywords" value="{{ request('keywords') }}">
                    <input type="hidden" name="areas_of_interest" value="{{ request('areas_of_interest') }}">
                    <button type="submit" class="search-submit-btn">Search</button>
                    <a href="{{ route('search') }}" class="clear-btn">✕ Clear</a>
                </div>
            </form>
        </div>
    </div>

    <!-- ═══ MAIN LAYOUT ═══ -->
    <div class="main-layout">

    


        <!-- ── RIGHT: FILTER SIDEBAR (35%) ── -->
        <div class="filter-sidebar">

            <p class="filter-sidebar-title">Filters</p>

            <form method="GET" action="{{ route('search') }}" id="filterForm">
                <input type="hidden" name="search" value="{{ request('search') }}">

                <!-- COUNTRY -->
                <div class="accordion-item">
                    <button type="button" class="accordion-trigger {{ count((array) request()->input('country', [])) ? 'open' : '' }}" data-target="acc-country">
                        <span>Country @if(count((array) request()->input('country', [])))<span class="filter-badge">{{ count((array) request()->input('country', [])) }}</span>@endif</span>
                        <i class="chevron">▾</i>
                    </button>
                    <div class="accordion-body {{ count((array) request()->input('country', [])) ? 'open' : '' }}" id="acc-country">
                        <input type="text" class="filter-input" placeholder="Search countries..." data-option-search="country-filter">
                        <select name="country[]" id="country-filter" class="filter-select filter-select-multi" multiple>
                            @foreach($countries as $country)
                                <option value="{{ $country }}" {{ in_array($country, (array) request()->input('country', []), true) ? 'selected' : '' }}>{{ $country }}</option>
                            @endforeach
                        </select>
                        <span class="filter-search-hint">Type to filter options, then hold Ctrl/Cmd to pick multiple.</span>
                        <button type="submit" class="apply-btn">Apply</button>
                    </div>
                </div>

                <!-- INSTITUTION -->
                <div class="accordion-item">
                    <button type="button" class="accordion-trigger {{ count((array) request()->input('institution', [])) ? 'open' : '' }}" data-target="acc-institution">
                        <span>Institution @if(count((array) request()->input('institution', [])))<span class="filter-badge">{{ count((array) request()->input('institution', [])) }}</span>@endif</span>
                        <i class="chevron">▾</i>
                    </button>
                    <div class="accordion-body {{ count((array) request()->input('institution', [])) ? 'open' : '' }}" id="acc-institution">
                        <input type="text" class="filter-input" placeholder="Search institutions..." data-option-search="institution-filter">
                        <select name="institution[]" id="institution-filter" class="filter-select filter-select-multi" multiple>
                            @foreach($institutions as $institution)
                                <option value="{{ $institution }}" {{ in_array($institution, (array) request()->input('institution', []), true) ? 'selected' : '' }}>{{ $institution }}</option>
                            @endforeach
                        </select>
                        <span class="filter-search-hint">Type to filter options, then hold Ctrl/Cmd to pick multiple.</span>
                        <button type="submit" class="apply-btn">Apply</button>
                    </div>
                </div>

                <!-- JOB TITLE -->
                <div class="accordion-item">
                    <button type="button" class="accordion-trigger {{ request('job_title') ? 'open' : '' }}" data-target="acc-jobtitle">
                        <span>Job Title @if(request('job_title'))<span class="filter-badge">1</span>@endif</span>
                        <i class="chevron">▾</i>
                    </button>
                    <div class="accordion-body {{ request('job_title') ? 'open' : '' }}" id="acc-jobtitle">
                        <select name="job_title" class="filter-select" onchange="document.getElementById('filterForm').submit()">
                            <option value="">All Job Titles</option>
                            @foreach($jobTitles->take(50) as $jobTitle)
                                <option value="{{ $jobTitle }}" {{ request('job_title') == $jobTitle ? 'selected' : '' }}>{{ $jobTitle }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- KEYWORDS -->
                <div class="accordion-item">
                    <button type="button" class="accordion-trigger {{ request('keywords') ? 'open' : '' }}" data-target="acc-keywords">
                        <span>Keywords @if(request('keywords'))<span class="filter-badge">✓</span>@endif</span>
                        <i class="chevron">▾</i>
                    </button>
                    <div class="accordion-body {{ request('keywords') ? 'open' : '' }}" id="acc-keywords">
                        <input type="text" name="keywords" class="filter-input"
                               value="{{ request('keywords') }}" placeholder="e.g., machine learning, fintech">
                        <button type="submit" class="apply-btn">Apply</button>
                    </div>
                </div>

                <!-- AREAS OF INTEREST -->
                <div class="accordion-item">
                    <button type="button" class="accordion-trigger {{ request('areas_of_interest') ? 'open' : '' }}" data-target="acc-interests">
                        <span>Areas of Interest @if(request('areas_of_interest'))<span class="filter-badge">✓</span>@endif</span>
                        <i class="chevron">▾</i>
                    </button>
                    <div class="accordion-body {{ request('areas_of_interest') ? 'open' : '' }}" id="acc-interests">
                        <input type="text" name="areas_of_interest" class="filter-input"
                               value="{{ request('areas_of_interest') }}" placeholder="e.g., AI, entrepreneurship">
                        <button type="submit" class="apply-btn">Apply</button>
                    </div>
                </div>

            </form>

          
        </div><!-- /filter-sidebar -->
    <!-- ── LEFT: PROFILE CARDS (65%) ── -->
        <div class="cards-panel">

            <div class="results-header">
            </div>

            @if($users->count() > 0)
                @foreach($users as $user)
                    @if(Auth::id() != $user->id)
                    <div class="profile-card">

                        @if($user->photo)
                            <img src="{{ Storage::url($user->photo) }}" alt="{{ $user->first_name }}" class="profile-avatar">
                        @else
                            <div class="profile-avatar-placeholder">
                                <span>{{ substr($user->first_name ?? $user->name, 0, 1) }}</span>
                            </div>
                        @endif

                        <div class="profile-body">
                            <h4 class="profile-name">{{ $user->title }} {{ $user->first_name }} {{ $user->last_name }}</h4>
                            <p class="profile-title">{{ $user->job_title ?? 'Professional' }}</p>

                            <div class="profile-meta">
                                @if($user->institution)<span>Institution: {{ $user->institution }}</span>@endif
                                
                            </div>
                             <div class="profile-meta">
                               
                                @if($user->country)<span>Country: {{ $user->country }}</span>@endif
                            </div>

                            @if($user->bio)
                                <div class="profile-bio">{{ Str::limit($user->bio, 85) }}</div>
                            @endif

                            @if($user->keywords)
                                <div class="profile-keywords">
                                    @foreach(array_slice(explode(',', $user->keywords), 0, 3) as $keyword)
                                        <span class="keyword-tag">{{ trim($keyword) }}</span>
                                    @endforeach
                                    @if(count(explode(',', $user->keywords)) > 5)
                                        <span class="keyword-more">+{{ count(explode(',', $user->keywords)) - 5 }} more</span>
                                    @endif
                                </div>
                            @endif

                            <a href="{{ route('profile.show', $user->id) }}{{ request()->getQueryString() ? '?' . request()->getQueryString() : '' }}" class="view-profile-btn">VIEW PROFILE</a>
                        </div>

                    </div>
                    @endif
                @endforeach

                <div class="pagination-wrap">{{ $users->appends(request()->query())->links() }}</div>

            @else
                <div class="empty-state">
                    <span class="empty-icon">🔍</span>
                    <h3>No professionals found</h3>
                    <p>Try adjusting your filters or clear them to browse everyone.</p>
                    <a href="{{ route('search') }}" class="view-profile-btn">Browse All Professionals</a>
                </div>
            @endif

        </div><!-- /cards-panel -->


    </div><!-- /main-layout -->

</div><!-- /search-page -->

<script>
    document.querySelectorAll('.accordion-trigger').forEach(trigger => {
        trigger.addEventListener('click', () => {
            const targetId = trigger.dataset.target;
            const body = document.getElementById(targetId);
            const isOpen = trigger.classList.contains('open');
            trigger.classList.toggle('open', !isOpen);
            body.classList.toggle('open', !isOpen);
        });
    });

    document.querySelectorAll('[data-option-search]').forEach(searchInput => {
        searchInput.addEventListener('input', () => {
            const selectId = searchInput.getAttribute('data-option-search');
            const select = document.getElementById(selectId);
            const term = searchInput.value.trim().toLowerCase();

            Array.from(select.options).forEach(option => {
                const match = option.text.toLowerCase().includes(term);
                option.hidden = !match;
            });
        });
    });
</script>

@endsection