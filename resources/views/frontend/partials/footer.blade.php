<footer class="footer">
    <div class="container footer-grid">
        <div>
            <a href="{{ route('home') }}" class="brand brand-light">
                <span class="brand-mark"><x-icon name="compass" size="22" /></span>
                <span>{{ setting('site_name', config('app.name')) }}</span>
            </a>
            <p class="footer-about">{{ setting('site_tagline') }}. Partner perjalanan terpercaya untuk menjelajahi keindahan Nusantara.</p>
            <div class="socials">
                @foreach (['instagram', 'facebook', 'tiktok'] as $social)
                    @if (setting('social_' . $social))
                        <a href="{{ setting('social_' . $social) }}" target="_blank" rel="noopener" aria-label="{{ ucfirst($social) }}"><x-icon :name="$social" size="18" /></a>
                    @endif
                @endforeach
            </div>
        </div>
        <div>
            <h4>Jelajahi</h4>
            <ul>
                <li><a href="{{ route('destinations.index') }}">Destinasi</a></li>
                <li><a href="{{ route('packages.index') }}">Paket Tour</a></li>
                <li><a href="{{ route('blog.index') }}">Blog Wisata</a></li>
                <li><a href="{{ route('about') }}">Tentang Kami</a></li>
            </ul>
        </div>
        <div>
            <h4>Kontak</h4>
            <ul class="footer-contact">
                <li><x-icon name="map-pin" size="16" /> {{ setting('contact_address') }}</li>
                <li><x-icon name="phone" size="16" /> {{ setting('contact_phone') }}</li>
                <li><x-icon name="mail" size="16" /> {{ setting('contact_email') }}</li>
            </ul>
        </div>
        <div>
            <h4>Siap Berpetualang?</h4>
            <p class="footer-about">Konsultasikan rencana liburan Anda secara gratis bersama tim kami.</p>
            <a href="{{ route('contact') }}" class="btn btn-accent">Rencanakan Trip</a>
        </div>
    </div>
    <div class="container footer-bottom">
        <span>&copy; {{ date('Y') }} {{ setting('site_name', config('app.name')) }}. All rights reserved.</span>
    </div>
</footer>
