// ========== Loader ==========
window.addEventListener('load', () => {
    const l = document.getElementById('loader');
    if (l) setTimeout(() => l.classList.add('hide'), 500);
});

// ========== Navbar scroll ==========
const nav = document.getElementById('navbar');
window.addEventListener('scroll', () => {
    if (!nav) return;
    if (window.scrollY > 30) nav.classList.add('navbar-scrolled');
    else nav.classList.remove('navbar-scrolled');
});

// ========== Mobile menu ==========
const menuBtn = document.getElementById('menuBtn');
const mobileMenu = document.getElementById('mobileMenu');
if (menuBtn && mobileMenu) {
    menuBtn.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));
    mobileMenu.querySelectorAll('a').forEach(a => a.addEventListener('click', () => mobileMenu.classList.add('hidden')));
}

// ========== Fade-up on scroll ==========
const io = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } });
}, { threshold: 0.12 });
document.querySelectorAll('.fade-up').forEach(el => io.observe(el));

// ========== Skill bars ==========
const skillIO = new IntersectionObserver((entries) => {
    entries.forEach(e => {
        if (e.isIntersecting) {
            e.target.querySelectorAll('.skill-bar > span').forEach(s => { s.style.width = s.dataset.val + '%'; });
            skillIO.unobserve(e.target);
        }
    });
}, { threshold: 0.3 });
document.querySelectorAll('[data-skills]').forEach(el => skillIO.observe(el));

// ========== Counters ==========
const counterIO = new IntersectionObserver((entries) => {
    entries.forEach(e => {
        if (!e.isIntersecting) return;
        const el = e.target;
        const target = +el.dataset.count;
        let cur = 0; const step = Math.max(1, Math.floor(target / 60));
        const t = setInterval(() => {
            cur += step;
            if (cur >= target) { cur = target; clearInterval(t); }
            el.textContent = cur.toLocaleString();
        }, 24);
        counterIO.unobserve(el);
    });
}, { threshold: 0.5 });
document.querySelectorAll('[data-count]').forEach(el => counterIO.observe(el));

// ========== Testimonial slider ==========
const slider = document.getElementById('testiSlider');
if (slider) {
    const slides = slider.querySelectorAll('[data-slide]');
    let i = 0;
    const show = (n) => slides.forEach((s, idx) => s.classList.toggle('hidden', idx !== n));
    show(0);
    setInterval(() => { i = (i + 1) % slides.length; show(i); }, 5000);
    const prev = document.getElementById('testiPrev'), next = document.getElementById('testiNext');
    prev && prev.addEventListener('click', () => { i = (i - 1 + slides.length) % slides.length; show(i); });
    next && next.addEventListener('click', () => { i = (i + 1) % slides.length; show(i); });
}

// ========== Hero code slider ==========
const heroCodeSlider = document.getElementById('heroCodeSlider');
if (heroCodeSlider) {
    const slides = heroCodeSlider.querySelectorAll('[data-hero-slide]');
    const dots = document.querySelectorAll('[data-hero-dot]');
    const prev = document.getElementById('heroCodePrev');
    const next = document.getElementById('heroCodeNext');
    let i = 0;
    let timer;

    const show = (n) => {
        slides.forEach((s, idx) => s.classList.toggle('hidden', idx !== n));
        dots.forEach((d, idx) => d.classList.toggle('active', idx === n));
    };

    const start = () => {
        timer = setInterval(() => {
            i = (i + 1) % slides.length;
            show(i);
        }, 4000);
    };

    const restart = () => {
        clearInterval(timer);
        start();
    };

    show(0);
    start();

    prev && prev.addEventListener('click', () => {
        i = (i - 1 + slides.length) % slides.length;
        show(i);
        restart();
    });

    next && next.addEventListener('click', () => {
        i = (i + 1) % slides.length;
        show(i);
        restart();
    });

    dots.forEach((dot) => {
        dot.addEventListener('click', () => {
            i = Number(dot.dataset.heroDot || 0);
            show(i);
            restart();
        });
    });
}

// ========== Project filter ==========
const filterBtns = document.querySelectorAll('[data-filter]');
const projectCards = document.querySelectorAll('[data-cat]');
filterBtns.forEach(b => b.addEventListener('click', () => {
    filterBtns.forEach(x => x.classList.remove('active-filter'));
    b.classList.add('active-filter');
    const f = b.dataset.filter;
    projectCards.forEach(c => {
        c.style.display = (f === 'all' || c.dataset.cat.includes(f)) ? '' : 'none';
    });
}));

// ========== Form fake submit ==========
document.querySelectorAll('form[data-demo]').forEach(f => {
    f.addEventListener('submit', (e) => {
        e.preventDefault();
        const msg = f.querySelector('[data-msg]');
        if (msg) { msg.textContent = '✓ Transmission received. I will reply within 24h.'; msg.classList.remove('hidden'); }
        f.reset();
    });
});

// ========== Particles (lightweight) ==========
const cv = document.getElementById('particles');
if (cv) {
    const ctx = cv.getContext('2d');
    let w, h, parts = [];
    const resize = () => { w = cv.width = cv.offsetWidth; h = cv.height = cv.offsetHeight; };
    resize(); window.addEventListener('resize', resize);
    for (let i = 0; i < 60; i++) parts.push({ x: Math.random() * w, y: Math.random() * h, vx: (Math.random() - .5) * .4, vy: (Math.random() - .5) * .4, r: Math.random() * 1.6 + .4 });
    const tick = () => {
        ctx.clearRect(0, 0, w, h);
        parts.forEach(p => {
            p.x += p.vx; p.y += p.vy;
            if (p.x < 0 || p.x > w) p.vx *= -1; if (p.y < 0 || p.y > h) p.vy *= -1;
            ctx.beginPath(); ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
            ctx.fillStyle = 'rgba(0,240,255,.7)'; ctx.shadowColor = '#00f0ff'; ctx.shadowBlur = 8; ctx.fill();
        });
        for (let i = 0; i < parts.length; i++) for (let j = i + 1; j < parts.length; j++) {
            const a = parts[i], b = parts[j], d = Math.hypot(a.x - b.x, a.y - b.y);
            if (d < 110) { ctx.strokeStyle = `rgba(177,76,255,${1 - d / 110})`; ctx.lineWidth = .6; ctx.shadowBlur = 0; ctx.beginPath(); ctx.moveTo(a.x, a.y); ctx.lineTo(b.x, b.y); ctx.stroke(); }
        }
        requestAnimationFrame(tick);
    };
    tick();
}
