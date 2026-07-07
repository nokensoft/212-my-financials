import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

document.addEventListener('alpine:init', () => {
    Alpine.data('coverUploader', (existing = null) => ({
        preview: existing,
        dragging: false,
        setFiles(files) {
            const file = files && files[0];
            if (!file || !file.type.startsWith('image/')) {
                return;
            }
            const reader = new FileReader();
            reader.onload = (e) => { this.preview = e.target.result; };
            reader.readAsDataURL(file);
            const input = this.$refs.input;
            if (input && files !== input.files) {
                const dt = new DataTransfer();
                dt.items.add(file);
                input.files = dt.files;
            }
            if (this.$refs.remove) {
                this.$refs.remove.checked = false;
            }
        },
        clear() {
            this.preview = null;
            if (this.$refs.input) {
                this.$refs.input.value = '';
            }
        },
    }));

    // Pengunggah bukti transfer: drag & drop + pratinjau gambar, atau nama berkas untuk PDF.
    Alpine.data('proofUploader', () => ({
        preview: null,
        fileName: null,
        isPdf: false,
        dragging: false,
        setFiles(files) {
            const file = files && files[0];
            if (!file) {
                return;
            }
            const isImage = file.type.startsWith('image/') || /\.(jpe?g|png|webp|gif)$/i.test(file.name);
            const isPdf = file.type === 'application/pdf' || /\.pdf$/i.test(file.name);
            if (!isImage && !isPdf) {
                return;
            }
            this.fileName = file.name;
            this.isPdf = isPdf && !isImage;
            if (isImage) {
                const reader = new FileReader();
                reader.onload = (e) => { this.preview = e.target.result; };
                reader.readAsDataURL(file);
            } else {
                this.preview = null;
            }
            const input = this.$refs.input;
            if (input && files !== input.files) {
                const dt = new DataTransfer();
                dt.items.add(file);
                input.files = dt.files;
            }
        },
        clear() {
            this.preview = null;
            this.fileName = null;
            this.isPdf = false;
            if (this.$refs.input) {
                this.$refs.input.value = '';
            }
        },
    }));

    Alpine.store('confirm', {
        open: false,
        title: 'Konfirmasi',
        message: '',
        confirmText: 'Hapus',
        form: null,
        ask(form, opts = {}) {
            this.form = form;
            this.title = opts.title || 'Konfirmasi';
            this.message = opts.message || 'Apakah Anda yakin?';
            this.confirmText = opts.confirmText || 'Hapus';
            this.open = true;
        },
        cancel() {
            this.open = false;
            this.form = null;
        },
        proceed() {
            const form = this.form;
            this.open = false;
            this.form = null;
            if (form) {
                form.submit();
            }
        },
    });
});

Alpine.start();

/* ──────────────────────────────────────────────────────────────
   MY Financials — interaksi halaman publik (vanilla JS)
   Semua di-guard dengan pengecekan elemen agar aman di dashboard/login.
   Diadaptasi dari _template/js/script.js.
   ────────────────────────────────────────────────────────────── */
(function () {
    'use strict';

    const WA_NUMBER = '6282190902163'; // +62 821 9090 2163

    document.addEventListener('DOMContentLoaded', function () {
        /* Nav shadow + back-to-top visibility on scroll */
        const navbar = document.getElementById('navbar');
        const backToTop = document.getElementById('backToTop');
        function onScroll() {
            const y = window.scrollY;
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

        /* Mobile menu: hamburger toggle */
        const hamburger = document.getElementById('hamburger');
        const mobileMenu = document.getElementById('mobileMenu');

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
            mobileMenu.querySelectorAll('a').forEach(function (link) {
                link.addEventListener('click', function () { setMenu(false); });
            });
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') setMenu(false);
            });
        }

        /* Hero: rotating background slider */
        const slides = document.querySelectorAll('.hero-slide');
        if (slides.length > 1) {
            let current = 0;
            setInterval(function () {
                slides[current].classList.remove('active');
                current = (current + 1) % slides.length;
                slides[current].classList.add('active');
            }, 5000);
        }

        /* Scroll spy: highlight the active nav link */
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.nav-links a, .mobile-menu a');

        function setActive(id) {
            navLinks.forEach(function (link) {
                link.classList.toggle('active', link.getAttribute('href') === '#' + id);
            });
        }

        if (sections.length && 'IntersectionObserver' in window) {
            const observer = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) setActive(entry.target.id);
                });
            }, { rootMargin: '-45% 0px -50% 0px', threshold: 0 });
            sections.forEach(function (section) { observer.observe(section); });
        }

        /* Contact form → WhatsApp */
        const contactForm = document.getElementById('contactForm');
        if (contactForm) {
            contactForm.addEventListener('submit', function (e) {
                e.preventDefault();
                const val = function (id) {
                    const el = document.getElementById(id);
                    return el && el.value ? el.value.trim() : '';
                };
                const lines = [
                    'Halo MY Financials, saya ingin menghubungi Anda.',
                    '',
                    'Nama: ' + (val('nama') || '-'),
                    'Email: ' + (val('email') || '-'),
                    'Kebutuhan: ' + (val('kebutuhan') || '-'),
                    'Pesan: ' + (val('pesan') || '-'),
                ];
                const url = 'https://wa.me/' + WA_NUMBER + '?text=' + encodeURIComponent(lines.join('\n'));
                window.open(url, '_blank', 'noopener');
            });
        }
    });
})();
