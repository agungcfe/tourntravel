/**
 * Nusantara Trip — interaksi frontend (vanilla JS, tanpa build step)
 * - Navbar berubah saat scroll & menu mobile
 * - Animasi reveal saat elemen terlihat
 * - Counter angka di hero
 * - Slider testimoni
 * - Tab di halaman detail paket
 */
document.addEventListener('DOMContentLoaded', () => {
    // Navbar
    const navbar = document.getElementById('navbar');
    const toggle = document.getElementById('navToggle');
    const onScroll = () => navbar?.classList.toggle('scrolled', window.scrollY > 30);
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });

    toggle?.addEventListener('click', () => {
        const open = document.body.classList.toggle('nav-open');
        toggle.setAttribute('aria-expanded', open);
    });
    document.querySelectorAll('#navLinks a').forEach((a) =>
        a.addEventListener('click', () => document.body.classList.remove('nav-open'))
    );

    // Reveal on scroll
    const io = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                io.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

    document.querySelectorAll('.reveal').forEach((el, i) => {
        el.style.transitionDelay = `${(i % 3) * 80}ms`;
        io.observe(el);
    });

    // Counter
    const counters = document.querySelectorAll('[data-count]');
    const fmt = new Intl.NumberFormat('id-ID');
    counters.forEach((el) => {
        const target = +el.dataset.count;
        const start = performance.now();
        const step = (now) => {
            const p = Math.min((now - start) / 1600, 1);
            el.textContent = fmt.format(Math.floor(target * (1 - Math.pow(1 - p, 3)))) + (p === 1 ? '+' : '');
            if (p < 1) requestAnimationFrame(step);
        };
        requestAnimationFrame(step);
    });

    // Slider
    const slider = document.getElementById('testimonialSlider');
    document.querySelectorAll('[data-slide]').forEach((btn) => {
        btn.addEventListener('click', () => {
            const card = slider.firstElementChild;
            const amount = card ? card.getBoundingClientRect().width + 24 : 300;
            slider.scrollBy({ left: btn.dataset.slide === 'next' ? amount : -amount, behavior: 'smooth' });
        });
    });

    // Tabs
    document.querySelectorAll('[data-tabs]').forEach((tabs) => {
        tabs.querySelectorAll('.tab').forEach((tab) => {
            tab.addEventListener('click', () => {
                tabs.querySelectorAll('.tab, .tab-panel').forEach((el) => el.classList.remove('active'));
                tab.classList.add('active');
                tabs.querySelector('#' + tab.dataset.tab)?.classList.add('active');
            });
        });
    });
});
