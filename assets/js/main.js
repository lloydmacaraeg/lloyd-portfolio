/* Portfolio interactions: theme toggle, mobile nav, project filter,
   active-section highlight, scroll reveal, form alert focus. */
(function () {
    'use strict';

    var root = document.documentElement;

    /* ---------- Theme ---------- */
    var themeBtn = document.getElementById('theme-toggle');
    var themeMeta = document.querySelector('meta[name="theme-color"]');

    function applyTheme(theme) {
        root.setAttribute('data-theme', theme);
        if (themeMeta) { themeMeta.setAttribute('content', theme === 'dark' ? '#0e0e10' : '#f3f3f4'); }
        if (themeBtn) {
            themeBtn.setAttribute('aria-label', theme === 'dark' ? 'Switch to light theme' : 'Switch to dark theme');
        }
    }

    applyTheme(root.getAttribute('data-theme') === 'light' ? 'light' : 'dark');

    if (themeBtn) {
        themeBtn.addEventListener('click', function () {
            var next = root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
            applyTheme(next);
            try { localStorage.setItem('theme', next); } catch (err) { /* storage blocked */ }
        });
    }

    /* ---------- Mobile navigation ---------- */
    var navToggle = document.getElementById('nav-toggle');
    var navLinks = document.getElementById('nav-links');

    function setMenu(open) {
        if (!navToggle || !navLinks) { return; }
        navLinks.classList.toggle('is-open', open);
        navToggle.setAttribute('aria-expanded', String(open));
        navToggle.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
        var icon = navToggle.querySelector('i');
        if (icon) { icon.className = open ? 'fa-solid fa-xmark' : 'fa-solid fa-bars'; }
    }

    if (navToggle && navLinks) {
        navToggle.addEventListener('click', function () {
            setMenu(navToggle.getAttribute('aria-expanded') !== 'true');
        });
        navLinks.addEventListener('click', function (event) {
            if (event.target.closest('a')) { setMenu(false); }
        });
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && navToggle.getAttribute('aria-expanded') === 'true') {
                setMenu(false);
                navToggle.focus();
            }
        });
        document.addEventListener('click', function (event) {
            if (!event.target.closest('#site-header')) { setMenu(false); }
        });
        window.addEventListener('resize', function () {
            if (window.innerWidth > 1000) { setMenu(false); }
        });
    }

    /* ---------- Active section in nav (home page only) ---------- */
    var sections = document.querySelectorAll('main section[id]');
    var navAnchors = document.querySelectorAll('.nav-links a[data-section]');

    if ('IntersectionObserver' in window && sections.length && navAnchors.length) {
        var spy = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) { return; }
                navAnchors.forEach(function (link) {
                    var current = link.getAttribute('data-section') === entry.target.id;
                    link.classList.toggle('is-current', current);
                    if (current) { link.setAttribute('aria-current', 'true'); }
                    else { link.removeAttribute('aria-current'); }
                });
            });
        }, { rootMargin: '-45% 0px -50% 0px' });
        sections.forEach(function (section) { spy.observe(section); });
    }

    /* ---------- Scroll reveal ---------- */
    var revealItems = document.querySelectorAll('.reveal');
    var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if ('IntersectionObserver' in window && !reduceMotion) {
        var reveal = new IntersectionObserver(function (entries, observer) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });
        revealItems.forEach(function (item) { reveal.observe(item); });
    } else {
        revealItems.forEach(function (item) { item.classList.add('is-visible'); });
    }

})();
