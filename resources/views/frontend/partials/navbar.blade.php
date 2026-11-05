@php
    $menu = [
        ['home', 'Beranda'],
        ['destinations.index', 'Destinasi'],
        ['packages.index', 'Paket Tour'],
        ['blog.index', 'Blog'],
        ['about', 'Tentang Kami'],
    ];
@endphp
<header class="navbar" id="navbar">
    <div class="container navbar-inner">
        <a href="{{ route('home') }}" class="brand">
            <span class="brand-mark"><x-icon name="compass" size="22" /></span>
            <span>{{ setting('site_name', config('app.name')) }}</span>
        </a>

        <nav class="nav-links" id="navLinks">
            @foreach ($menu as [$route, $label])
                <a href="{{ route($route) }}" @class(['active' => request()->routeIs(str_replace('.index', '.*', $route))])>{{ $label }}</a>
            @endforeach
            <a href="{{ route('contact') }}" class="btn btn-primary btn-sm nav-cta">Hubungi Kami</a>
        </nav>

        <button class="nav-toggle" id="navToggle" aria-label="Buka menu" aria-expanded="false">
            <x-icon name="menu" size="24" />
        </button>
    </div>
</header>
