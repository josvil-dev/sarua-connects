@extends('layouts.app')

@section('title', 'Welcome to Sarua Connect')

@section('content')
<style>
    /* ── Reset / base ── */
    *, *::before, *::after {  margin: 0; padding: 0; }

    body { color: #0f172a; background: #fff; }

    /* ── Header / Hero ── */
    .sc-header {
        background-image: url('https://sarua.africa/wp-content/uploads/2023/04/header-image-home.jpg');
        background-size: cover;
        background-position: center;
    }

    .sc-header-inner {
        max-width: 1500px;
        margin: 0 auto;
        padding: 2rem 1rem 2rem;
    }

    @media (min-width: 640px) {
        .sc-header-inner { padding: 5rem 1.5rem; }
    }

    @media (min-width: 1024px) {
        .sc-header-inner { padding: 5rem 4rem; }
    }

    .sc-header-content {
        max-width: 45rem;
        margin: 0 auto;
        text-align: center;
    }

    @media (min-width: 640px) {
        .sc-header-content { margin: 0; text-align: left; }
    }

    .sc-header-content h1 {
        font-size: 1.875rem;
        font-weight: 800;
        letter-spacing: -0.025em;
        color: #fff;
        margin-top: 1.5rem;
        line-height: 1.1;
    }

    @media (min-width: 640px) { .sc-header-content h1 { font-size: 3rem; } }
    @media (min-width: 768px) { .sc-header-content h1 { font-size: 3.75rem; } }

    .sc-header-content p {
        margin-top: 1rem;
        font-size: 0.875rem;
        color: #e5e7eb;
        max-width: 36rem;
        line-height: 1.75;
    }

    @media (min-width: 640px) { .sc-header-content p { font-size: 1.125rem; } }
    @media (min-width: 768px) { .sc-header-content p { font-size: 1.5rem; } }

    .sc-btn-group {
        margin-top: 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        align-items: center;
    }

    @media (min-width: 640px) {
        .sc-btn-group { flex-direction: row; justify-content: flex-start; }
    }

    .sc-btn {
        display: inline-block;
        background: #d7df23;
        color: #272727;
        font-weight: 700;
        font-size: 1.125rem;
        padding: 0.6rem 1.5rem;
        border-radius: 0px;
        text-decoration: none;
        box-shadow: 0 1px 3px rgba(0,0,0,.2);
        border: none;
        cursor: pointer;
        width: 100%;
        text-align: center;
        transition: background 0.2s;
        font-family: inherit;
    }

    @media (min-width: 640px) { .sc-btn { width: auto; } }

    .sc-btn:hover { background: #059669; color: #fff; }

    /* ── Main ── */
    .sc-main {
        max-width: 100%;
        padding: 2rem 1rem;
        margin: 0 auto;
        background: #fff;
        color: #0f172a;
    }

    @media (min-width: 640px) { .sc-main { padding: 3rem 1.5rem; } }
    @media (min-width: 1024px) { .sc-main { padding: 3rem 4rem; } }

    /* ── About ── */
    .sc-about {
        padding: 1.5rem 0;
    }

    .sc-about h2 {
        font-size: 1.5rem;
        font-weight: 600;
        color: #0f172a;
    }

    .sc-about p {
        margin-top: 0.75rem;
        color: #334155;
        line-height: 1.7;
    }

    /* ── Two-column cards ── */
    .sc-cards {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
        margin-top: 0;
    }

    @media (min-width: 768px) {
        .sc-cards { grid-template-columns: 1fr 1fr; gap: 2.5rem; }
    }

    .sc-card {
        background: #d7df23;
        padding: 3rem 2rem;
        color: #000;
        height: 100%;
    }

    @media (min-width: 640px) { .sc-card { padding: 5rem 2rem; } }

    .sc-card h2 {
        font-size: 1.5rem;
        font-weight: 800;
    }

    @media (min-width: 768px) { .sc-card h2 { font-size: 1.875rem; } }

    .sc-card p {
        margin-top: 1rem;
        font-size: 1rem;
        max-width: 48rem;
    }

    .sc-card ul {
        margin-top: 1.5rem;
        list-style: disc;
        padding-left: 1rem;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        font-size: 1rem;
    }

    /* ── Who section ── */
    .sc-who {
        padding: 1.5rem 0;
        text-align: center;
    }

    .sc-who-inner { max-width: 42rem; margin: 0 auto; }

    .sc-who h2 {
        font-size: 1.875rem;
        font-weight: 800;
        color: #0f172a;
    }

    .sc-who p {
        margin-top: 0.75rem;
        color: #334155;
        line-height: 1.7;
    }

    /* ── CTA section ── */
    .sc-cta {
        padding: 1.5rem 0;
        text-align: center;
    }

    .sc-cta-inner { max-width: 42rem; margin: 0 auto; }

    .sc-cta p { margin-top: 0.75rem; color: #334155; line-height: 1.7; }

    .sc-cta-btns {
        margin-top: 2rem;
        display: flex;
        justify-content: center;
        gap: 1rem;
        flex-wrap: wrap;
    }

    /* ── Contact ── */
    .sc-contact {
        padding: 1.5rem 0;
        text-align: center;
    }

    .sc-contact-inner { max-width: 28rem; margin: 0 auto; }

    .sc-contact h2 {
        font-size: 1.5rem;
        font-weight: 600;
        color: #0f172a;
    }

    .sc-contact p { margin-top: 0.75rem; color: #334155; }

    .sc-contact a {
        color: #1e293b;
        display: inline-block;
    }

    .sc-contact a:hover { text-decoration: underline; }
</style>

{{-- ══════════════════════════════════════════
     HEADER
══════════════════════════════════════════ --}}
<header class="sc-header">
    <div class="sc-header-inner">
        <div class="sc-header-content">
            <h1>Welcome to SARUA CONNECT</h1>

            <p>
                A regional platform for academic connection, collaboration and
                visibility.
            </p>

            <div class="sc-btn-group">
                @guest
                <a href="{{ route('register') }}" class="sc-btn">
                    Join the Database
                </a>
                @endguest

                <a href="{{ auth()->check() ? route('search') : route('login') }}" class="sc-btn">
                    Search the Database
                </a>
            </div>
        </div>
    </div>
</header>

{{-- ══════════════════════════════════════════
     MAIN
══════════════════════════════════════════ --}}
<main class="sc-main">

    {{-- About --}}
    <section id="about" class="sc-about">
        <h2>
            SARUA is proud to host a regional database of subject specialists,
            academic supervisors and researchers working across the SADC higher
            education space.
        </h2>
        <p>
            This resource is designed to strengthen knowledge co-production,
            promote interdisciplinary collaboration and connect scholars,
            institutions and development partners working to address regional and
            global challenges. Whether you're looking to join the network and
            contribute your expertise, or you're seeking to find collaborators
            across fields and countries, this platform is your gateway to
            meaningful academic engagement in the region.
        </p>
    </section>

    {{-- Two yellow cards --}}
    <div class="sc-cards">

        <section id="join">
            <div class="sc-card">
                <h2>Why join the database?</h2>
                <p>Becoming part of this resource offers several benefits:</p>
                <ul>
                    <li>Increased visibility among regional and international peers.</li>
                    <li>Opportunities for collaboration in research, teaching, supervision, and grant writing.</li>
                    <li>Access to SARUA-led initiatives and networks aligned with the SDGs.</li>
                    <li>Potential for engagement in regional capacity-building and policy-shaping activities.</li>
                </ul>
            </div>
        </section>

        <section id="search-benefits">
            <div class="sc-card">
                <h2>Why use the search function?</h2>
                <p>
                    This database offers a valuable tool for those seeking to connect with experts, collaborators and academic partners across the region:
                </p>
                <ul>
                    <li>Discover subject specialists and supervisors across a wide range of disciplines.</li>
                    <li>Identify potential collaborators for research, co-authorship or grant proposals.</li>
                    <li>Connect with institutions and individuals engaged in SDG-aligned projects.</li>
                    <li>Find contributors for academic programmes, policy consultations, or mentoring initiatives.</li>
                </ul>
            </div>
        </section>

    </div>

    {{-- Who is this for --}}
    <section id="who" class="sc-who">
        <div class="sc-who-inner">
            <h2>Who is this for?</h2>
            <p>
                Researchers, subject specialists, academic supervisors, postgraduate supervisors and higher education practitioners across the SADC region — and anyone seeking collaborators or expertise.
            </p>
        </div>
    </section>

    {{-- CTA --}}
    <section class="sc-cta">
        <div class="sc-cta-inner">
            <p>
                We welcome contributors and users from all fields of expertise and across career stages. Whether you're looking to share your own profile or explore the network to find collaborators, supervisors, or research partners, this resource is here to support regional academic engagement.
            </p>
        </div>

        <div class="sc-cta-btns">
            @guest
            <a href="{{ route('register') }}" class="sc-btn">
                Join the Database
            </a>
            @endguest

            <a href="{{ auth()->check() ? route('search') : route('login') }}" class="sc-btn">
                Search the Database
            </a>
        </div>
    </section>

    {{-- Contact --}}
    <section id="contact" class="sc-contact">
        <div class="sc-contact-inner">
            <h2>Questions or need help?</h2>
            <p>
                Email: <a href="mailto:support@sarua.org">support@sarua.org</a>
            </p>
        </div>
    </section>

</main>
@endsection