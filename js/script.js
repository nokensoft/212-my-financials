/* MY Financials — interactivity (vanilla JS) */
(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    /* ── NAV shadow + BACK-TO-TOP visibility on scroll ── */
    var navbar = document.getElementById('navbar');
    var backToTop = document.getElementById('backToTop');
    function onScroll() {
      var y = window.scrollY;
      if (navbar) navbar.classList.toggle('scrolled', y > 40);
      if (backToTop) backToTop.classList.toggle('show', y > 400);
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    if (backToTop) {
      backToTop.addEventListener('click', function () {
        window.scrollTo({ top: 0, behavior: 'smooth' });
      });
    }

    /* ── MOBILE MENU: hamburger toggle ── */
    var hamburger = document.getElementById('hamburger');
    var mobileMenu = document.getElementById('mobileMenu');

    function setMenu(open) {
      if (!mobileMenu || !hamburger) return;
      mobileMenu.classList.toggle('open', open);
      hamburger.classList.toggle('active', open);
      hamburger.setAttribute('aria-expanded', open ? 'true' : 'false');
    }

    if (hamburger && mobileMenu) {
      hamburger.addEventListener('click', function () {
        setMenu(!mobileMenu.classList.contains('open'));
      });
      // Close the menu after tapping any link inside it.
      mobileMenu.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', function () { setMenu(false); });
      });
      // Close on Escape for keyboard users.
      document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') setMenu(false);
      });
    }

    /* ── HERO: rotating background slider (zoom in / out) ── */
    var slides = document.querySelectorAll('.hero-slide');
    if (slides.length > 1) {
      var current = 0;
      setInterval(function () {
        slides[current].classList.remove('active');
        current = (current + 1) % slides.length;
        slides[current].classList.add('active');
      }, 5000);
    }

    /* ── SCROLL SPY: highlight the active main-nav link ── */
    var sections = document.querySelectorAll('section[id]');
    var navLinks = document.querySelectorAll('.nav-links a, .mobile-menu a');

    function setActive(id) {
      navLinks.forEach(function (link) {
        link.classList.toggle('active', link.getAttribute('href') === '#' + id);
      });
    }

    if (sections.length && 'IntersectionObserver' in window) {
      var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) setActive(entry.target.id);
        });
      }, { rootMargin: '-45% 0px -50% 0px', threshold: 0 });

      sections.forEach(function (section) { observer.observe(section); });
    }

    /* ── CONTACT FORM → WhatsApp ── */
    var contactForm = document.getElementById('contactForm');
    if (contactForm) {
      var WA_NUMBER = '6282190902163'; // +62 821 9090 2163
      contactForm.addEventListener('submit', function (e) {
        e.preventDefault();
        var val = function (id) {
          var el = document.getElementById(id);
          return el && el.value ? el.value.trim() : '';
        };
        var lines = [
          'Halo MY Financials, saya ingin menghubungi Anda.',
          '',
          'Nama: ' + (val('nama') || '-'),
          'Email: ' + (val('email') || '-'),
          'Kebutuhan: ' + (val('kebutuhan') || '-'),
          'Pesan: ' + (val('pesan') || '-')
        ];
        var url = 'https://wa.me/' + WA_NUMBER + '?text=' + encodeURIComponent(lines.join('\n'));
        window.open(url, '_blank', 'noopener');
      });
    }
  });
})();
