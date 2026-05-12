document.addEventListener('DOMContentLoaded', () => {

    // ── SMOOTH SCROLL CTA ──────────────────────────────────────
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (!target) return;
            e.preventDefault();

            const targetY = target.getBoundingClientRect().top + window.scrollY;
            const startY  = window.scrollY;
            const diff    = targetY - startY;
            const duration = 1200;
            let startTime = null;

            function easeInOutQuart(t) {
                return t < 0.5 ? 8 * t * t * t * t : 1 - Math.pow(-2 * t + 2, 4) / 2;
            }

            function step(timestamp) {
                if (!startTime) startTime = timestamp;
                const elapsed  = timestamp - startTime;
                const progress = Math.min(elapsed / duration, 1);
                window.scrollTo(0, startY + diff * easeInOutQuart(progress));
                if (progress < 1) requestAnimationFrame(step);
            }

            requestAnimationFrame(step);
        });
    });

    // ── PARALLAX HERO ──────────────────────────────────────────
    const heroBg = document.getElementById('heroBg');
    if (heroBg) {
        window.addEventListener('scroll', () => {
            heroBg.style.transform = `scale(1.06) translateY(${window.scrollY * 0.28}px)`;
        }, { passive: true });
    }

    // ── SCROLL REVEAL ──────────────────────────────────────────
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12 });

    document.querySelectorAll('.service-card, .testimonial-card').forEach(el => observer.observe(el));

    // ── CAROUSEL ───────────────────────────────────────────────
    const track   = document.getElementById('carouselTrack');
    const dotsEl  = document.getElementById('carouselDots');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    if (!track) return;

    const slides    = track.querySelectorAll('.carousel-slide');
    const totalReal = slides.length / 2;
    let current = 0, isDragging = false, startX = 0, prevTranslate = 0;

    // Build dots
    for (let i = 0; i < totalReal; i++) {
        const dot = document.createElement('button');
        dot.className = 'carousel-dot' + (i === 0 ? ' active' : '');
        dot.addEventListener('click', () => { goTo(i); resetAuto(); });
        dotsEl.appendChild(dot);
    }

    const slideWidth = () => slides[0].getBoundingClientRect().width + 20;

    function goTo(index) {
        current = ((index % totalReal) + totalReal) % totalReal;
        track.style.transform = `translateX(${-(current * slideWidth())}px)`;
        prevTranslate = -(current * slideWidth());
        dotsEl.querySelectorAll('.carousel-dot').forEach((d, i) => d.classList.toggle('active', i === current));
    }

    prevBtn.addEventListener('click', () => { goTo(current - 1); resetAuto(); });
    nextBtn.addEventListener('click', () => { goTo(current + 1); resetAuto(); });

    let autoPlay = setInterval(() => goTo(current + 1), 3800);
    function resetAuto() { clearInterval(autoPlay); autoPlay = setInterval(() => goTo(current + 1), 3800); }

    // Drag
    const onStart = x => { isDragging = true; startX = x; track.classList.add('grabbing'); };
    const onMove  = x => { if (isDragging) track.style.transform = `translateX(${prevTranslate + x - startX}px)`; };
    const onEnd   = x => {
        if (!isDragging) return;
        isDragging = false; track.classList.remove('grabbing');
        const diff = x - startX;
        if (diff < -60) goTo(current + 1);
        else if (diff > 60) goTo(current - 1);
        else goTo(current);
        resetAuto();
    };

    track.addEventListener('mousedown',  e => onStart(e.clientX));
    track.addEventListener('mousemove',  e => onMove(e.clientX));
    track.addEventListener('mouseup',    e => onEnd(e.clientX));
    track.addEventListener('mouseleave', e => onEnd(e.clientX));
    track.addEventListener('touchstart', e => onStart(e.touches[0].clientX), { passive: true });
    track.addEventListener('touchmove',  e => onMove(e.touches[0].clientX),  { passive: true });
    track.addEventListener('touchend',   e => onEnd(e.changedTouches[0].clientX));
});