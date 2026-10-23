window.__rv = 1; // tells the inline fallback that this script loaded
const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
const fine = window.matchMedia('(hover: hover) and (pointer: fine)').matches;

// Mobile menu
const btn = document.querySelector('.menu-btn');
const nav = document.querySelector('.nav nav');
if (btn && nav) btn.addEventListener('click', () => nav.classList.toggle('open'));

// Scroll reveal
const io = new IntersectionObserver((entries) => {
  entries.forEach((e) => { if (e.isIntersecting) { e.target.classList.add('on'); io.unobserve(e.target); } });
}, { threshold: 0.12, rootMargin: '0px 0px -6% 0px' });
document.querySelectorAll('.reveal').forEach((el) => io.observe(el));

if (!reduce) {
  // Nav condenses + progress bar + hero parallax: one passive scroll handler, rAF-throttled
  const header = document.querySelector('header.nav');
  const bar = document.createElement('div');
  bar.className = 'progress';
  bar.setAttribute('aria-hidden', 'true');
  document.body.appendChild(bar);
  const hero = document.querySelector('.hero');
  let ticking = false;
  const update = () => {
    const y = window.scrollY;
    const max = document.documentElement.scrollHeight - window.innerHeight;
    if (header) header.classList.toggle('scrolled', y > 24);
    bar.style.transform = 'scaleX(' + (max > 0 ? Math.min(1, y / max) : 0) + ')';
    if (hero && y < 900) hero.style.setProperty('--py', y);
    ticking = false;
  };
  window.addEventListener('scroll', () => { if (!ticking) { ticking = true; requestAnimationFrame(update); } }, { passive: true });
  update();

  // Card spotlight follows the pointer (desktop only)
  if (fine) {
    document.addEventListener('pointermove', (e) => {
      const card = e.target.closest && e.target.closest('.card');
      if (!card) return;
      const r = card.getBoundingClientRect();
      card.style.setProperty('--mx', (e.clientX - r.left) + 'px');
      card.style.setProperty('--my', (e.clientY - r.top) + 'px');
    }, { passive: true });
  }
}

// Staggered chat messages
document.querySelectorAll('.msgs').forEach((box) => {
  [...box.children].forEach((m, i) => { m.style.animationDelay = (0.6 + i * 1.1) + 's'; });
});

// Volume slider demo (AI + human page)
const slider = document.getElementById('volSlider');
if (slider) {
  const bars = document.querySelectorAll('.vol-row .bar');
  const label = document.getElementById('volLabel');
  const note = document.getElementById('volNote');
  const draw = () => {
    const cap = +slider.value; // human capacity line, % of chart height
    let over = 0;
    bars.forEach((b) => {
      const total = +b.dataset.v;
      const human = Math.min(total, cap);
      const ai = Math.max(0, total - cap);
      if (ai > 0) over++;
      b.querySelector('.h').style.height = human + '%';
      b.querySelector('.ai').style.height = ai + '%';
    });
    label.textContent = cap + '% staffed';
    note.textContent = over
      ? 'AI picked up the overflow in ' + over + ' of ' + bars.length + ' time blocks. No caller waited in a queue.'
      : 'Human agents covered every time block. AI stayed on standby.';
  };
  slider.addEventListener('input', draw);
  draw();
}
