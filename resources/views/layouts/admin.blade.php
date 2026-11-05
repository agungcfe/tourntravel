<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') | CMS {{ setting('site_name', config('app.name')) }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
@php
    $nav = [
        'Utama' => [
            ['admin.dashboard', 'grid', 'Dashboard', 'admin.dashboard'],
            ['admin.inquiries.index', 'inbox', 'Booking Masuk', 'admin.inquiries.*'],
        ],
        'Konten' => [
            ['admin.destinations.index', 'map-pin', 'Destinasi', 'admin.destinations.*'],
            ['admin.packages.index', 'package', 'Paket Tour', 'admin.packages.*'],
            ['admin.posts.index', 'file-text', 'Artikel Blog', 'admin.posts.*'],
            ['admin.categories.index', 'tag', 'Kategori Blog', 'admin.categories.*'],
            ['admin.testimonials.index', 'message', 'Testimoni', 'admin.testimonials.*'],
        ],
    ];
    if (auth()->user()->isAdmin()) {
        $nav['Administrator'] = [
            ['admin.users.index', 'users', 'User Management', 'admin.users.*'],
            ['admin.settings.edit', 'settings', 'Pengaturan Website', 'admin.settings.*'],
        ];
    }
    $newInquiries = \App\Models\Inquiry::where('status', 'new')->count();
@endphp

<div class="admin">
    <aside class="sidebar" id="sidebar">
        <a href="{{ route('admin.dashboard') }}" class="brand">
            <span class="brand-mark"><x-icon name="compass" size="20" /></span>
            <span>{{ setting('site_name', config('app.name')) }}</span>
        </a>

        <nav class="side-nav">
            @foreach ($nav as $group => $items)
                <p class="side-group">{{ $group }}</p>
                @foreach ($items as [$route, $icon, $label, $pattern])
                    <a href="{{ route($route) }}" @class(['side-link', 'active' => request()->routeIs($pattern)])>
                        <x-icon :name="$icon" size="18" />
                        <span>{{ $label }}</span>
                        @if ($route === 'admin.inquiries.index' && $newInquiries)
                            <span class="pill">{{ $newInquiries }}</span>
                        @endif
                    </a>
                @endforeach
            @endforeach
        </nav>

        <a href="{{ route('home') }}" target="_blank" class="side-link view-site">
            <x-icon name="external" size="18" /> <span>Lihat Website</span>
        </a>
    </aside>
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <div class="main">
        <header class="topbar">
            <button class="icon-btn" id="sidebarToggle" aria-label="Menu"><x-icon name="menu" /></button>
            <h1 class="page-title">@yield('title', 'Dashboard')</h1>

            <div class="dropdown" data-dropdown>
                <button class="user-btn" data-dropdown-toggle>
                    <span class="avatar">{{ auth()->user()->initials }}</span>
                    <span class="user-meta">
                        <strong>{{ auth()->user()->name }}</strong>
                        <small>{{ auth()->user()->role_label }}</small>
                    </span>
                </button>
                <div class="dropdown-menu">
                    <a href="{{ route('admin.profile.edit') }}"><x-icon name="user" size="16" /> Profil Saya</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"><x-icon name="logout" size="16" /> Logout</button>
                    </form>
                </div>
            </div>
        </header>

        <main class="content">
            @include('admin.partials.alerts')
            @yield('content')
        </main>
    </div>
</div>

{{-- Modal konfirmasi hapus (dipakai semua tombol dengan data-confirm) --}}
<div class="modal" id="confirmModal" aria-hidden="true">
    <div class="modal-card">
        <span class="modal-icon"><x-icon name="trash" size="26" /></span>
        <h3>Hapus data ini?</h3>
        <p class="muted" id="confirmText">Data yang dihapus tidak dapat dikembalikan.</p>
        <div class="modal-actions">
            <button class="btn btn-light" data-modal-close>Batal</button>
            <button class="btn btn-danger" id="confirmYes">Ya, Hapus</button>
        </div>
    </div>
</div>

<script src="{{ asset('js/admin.js') }}" defer></script>
@stack('scripts')
</body>
</html>
