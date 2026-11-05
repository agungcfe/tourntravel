<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', setting('site_tagline', 'Tour & Travel')) | {{ setting('site_name', config('app.name')) }}</title>
    <meta name="description" content="@yield('meta_description', setting('hero_subtitle'))">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>
<body class="@yield('body_class')">
    @include('frontend.partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('frontend.partials.footer')

    @if (setting('contact_whatsapp'))
        <a href="https://wa.me/{{ setting('contact_whatsapp') }}" class="wa-float" target="_blank" rel="noopener" aria-label="Chat WhatsApp">
            <x-icon name="whatsapp" size="28" />
        </a>
    @endif

    <script src="{{ asset('js/app.js') }}" defer></script>
    @stack('scripts')
</body>
</html>
