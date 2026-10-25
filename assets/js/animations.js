(() => {
  const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const finePointer = window.matchMedia('(hover: hover) and (pointer: fine)').matches;
  const data = window.POGO || {};
  const qs = (sel, root = document) => root.querySelector(sel);
  const qsa = (sel, root = document) => Array.from(root.querySelectorAll(sel));

  gsap.registerPlugin(ScrollTrigger);
  gsap.ticker.lagSmoothing(0);
  if (window.lucide) lucide.createIcons();

  const state = {
    model: qs('[data-quick="model"]')?.value || 'apex-300',
    duration: qs('[data-quick="duration"]')?.value || '2h',
    launch: qs('[data-quick="launch"]')?.value || 'downtown',
    addons: new Set(),
    step: 1,
    lenis: null,
  };

  const priceObj = { val: 0 };

  function cad(value, digits = 0) {
    return Number(value).toLocaleString('en-CA', {
      style: 'currency',
      currency: 'CAD',
      minimumFractionDigits: digits,
      maximumFractionDigits: digits,
    });
  }

  function splitHeadline() {
    qsa('[data-split]').forEach((line) => {
      const text = (line.textContent || '').trim();
      line.textContent = '';
      text.split(/\s+/).forEach((word, index, words) => {
        const wordEl = document.createElement('span');
        wordEl.className = 'word';
        [...word].forEach((char) => {
          const span = document.createElement('span');
          span.className = 'char';
          span.textContent = char;
          wordEl.appendChild(span);
        });
        line.appendChild(wordEl);
        if (index < words.length - 1) {
          const space = document.createElement('span');
          space.className = 'char char-space';
          space.innerHTML = '&nbsp;';
          line.appendChild(space);
        }
      });
    });
  }

  function initCursor() {
    if (!finePointer || reduced) return;
    const dot = qs('.cursor-dot');
    const ring = qs('.cursor-ring');
    if (!dot || !ring) return;
    gsap.set([dot, ring], { xPercent: -50, yPercent: -50, opacity: 0 });
    window.addEventListener('mousemove', (event) => {
      gsap.to(dot, { x: event.clientX, y: event.clientY, opacity: 1, duration: 0.12, ease: 'power3.out' });
      gsap.to(ring, { x: event.clientX, y: event.clientY, opacity: 1, duration: 0.28, ease: 'power3.out' });
    });
    qsa('a, button, select, input, textarea, [data-magnetic]').forEach((el) => {
      el.addEventListener('mouseenter', () => ring.classList.add('is-hot'));
      el.addEventListener('mouseleave', () => ring.classList.remove('is-hot'));
    });
  }

  function initMagnetic() {
    if (!finePointer || reduced) return;
    qsa('[data-magnetic]').forEach((el) => {
      el.addEventListener('mousemove', (event) => {
        const rect = el.getBoundingClientRect();
        const x = event.clientX - (rect.left + rect.width / 2);
        const y = event.clientY - (rect.top + rect.height / 2);
        gsap.to(el, { x: x * 0.22, y: y * 0.22, duration: 0.35, ease: 'power3.out' });
      });
      el.addEventListener('mouseleave', () => {
        gsap.to(el, { x: 0, y: 0, duration: 0.55, ease: 'power3.out' });
      });
    });
  }

  function initNav() {
    const pill = qs('.nav-pill');
    const toggle = qs('#menu-toggle');
    const menu = qs('#mobile-menu');
    if (pill) {
      ScrollTrigger.create({
        start: 80,
        onUpdate: (self) => pill.classList.toggle('is-compact', self.scroll() > 80),
      });
    }
    if (!toggle || !menu) return;
    const label = toggle.querySelector('.sr-only');
    const setOpenState = (open) => {
      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
      toggle.classList.toggle('menu-toggle-open', open);
      if (label) label.textContent = open ? 'Close menu' : 'Open menu';
    };
    const closeMenu = () => {
      menu.classList.remove('is-open');
      setOpenState(false);
      document.body.style.overflow = '';
      if (state.lenis) state.lenis.start();
      window.setTimeout(() => {
        menu.hidden = true;
      }, 700);
    };
    toggle.addEventListener('click', () => {
      const open = toggle.getAttribute('aria-expanded') === 'true';
      if (open) {
        closeMenu();
        return;
      }
      menu.hidden = false;
      setOpenState(true);
      document.body.style.overflow = 'hidden';
      if (state.lenis) state.lenis.stop();
      requestAnimationFrame(() => menu.classList.add('is-open'));
    });
    qsa('[data-menu-close]', menu).forEach((el) => el.addEventListener('click', closeMenu));
    qsa('.menu-link', menu).forEach((link) => link.addEventListener('click', closeMenu));
  }

  function initLenis() {
    if (reduced || typeof Lenis === 'undefined') return null;
    const lenis = new Lenis({
      lerp: 0.08,
      smoothWheel: true,
      syncTouch: false,
      autoRaf: false,
    });
    lenis.on('scroll', ScrollTrigger.update);
    gsap.ticker.add((time) => lenis.raf(time * 1000));
    gsap.ticker.lagSmoothing(0);
    qsa('a[href^="#"]').forEach((link) => {
      link.addEventListener('click', (event) => {
        const id = link.getAttribute('href');
        if (!id || id === '#') return;
        const target = qs(id);
        if (!target) return;
        event.preventDefault();
        lenis.scrollTo(target, { offset: -12, duration: 1.35 });
      });
    });
    state.lenis = lenis;
    window.__pogoLenis = lenis;
    return lenis;
  }

  function scrollToBook() {
    const target = qs('#book');
    if (!target) return;
    if (state.lenis) state.lenis.scrollTo(target, { offset: -16, duration: 1.4 });
    else target.scrollIntoView({ behavior: reduced ? 'auto' : 'smooth' });
  }

  function playHero() {
    const chars = qsa('.hero-title .char');
    gsap.set(chars, { yPercent: 120, opacity: 0, rotateX: 40 });
    gsap.to(chars, {
      yPercent: 0,
      opacity: 1,
      rotateX: 0,
      duration: 1.15,
      stagger: 0.028,
      ease: 'power4.out',
    });
    gsap.from('.hero-kicker, .hero-copy, .quick-launch', {
      y: 36,
      opacity: 0,
      duration: 1,
      stagger: 0.12,
      delay: 0.35,
      ease: 'power3.out',
    });
    if (reduced) return;
    gsap.to('.hero-video', {
      yPercent: 14,
      scale: 1.18,
      ease: 'none',
      scrollTrigger: { trigger: '#top', start: 'top top', end: 'bottom top', scrub: true },
    });
  }

  function initAnatomy() {
    const section = qs('#anatomy');
    if (!section) return;
    const hpObj = { val: 0 };
    const hpEl = qs('[data-hp]');
    qsa('.draw-line').forEach((line) => {
      const len = Math.ceil(line.getTotalLength()) + 32;
      gsap.set(line, { strokeDasharray: len, strokeDashoffset: len });
    });
    const mm = gsap.matchMedia();
    mm.add('(min-width: 1024px)', () => {
      gsap.set('.anatomy-card', { opacity: 0, y: 32 });
      gsap.set('[data-phase="1"]', { opacity: 1, y: 0 });
      gsap.set('[data-line="hull"], [data-line="launch"], [data-hotspot="hull"], [data-hotspot="launch"]', { opacity: 0 });
      gsap.set('[data-line="engine"], [data-hotspot="engine"]', { opacity: 1 });
      const tl = gsap.timeline({
        scrollTrigger: {
          trigger: section,
          start: 'top top',
          end: '+=200%',
          pin: true,
          scrub: 1,
          anticipatePin: 1,
        },
      });
      tl.to('[data-phase="1"]', { opacity: 1, y: 0, duration: 0.18 }, 0)
        .to('[data-line="engine"]', { strokeDashoffset: 0, duration: 0.22 }, 0)
        .to(hpObj, {
          val: 300,
          duration: 0.32,
          ease: 'none',
          onUpdate: () => {
            if (hpEl) hpEl.textContent = String(Math.round(hpObj.val));
          },
        }, 0)
        .to('.anatomy-visual img', { scale: 1.06, duration: 0.34, ease: 'none' }, 0.33)
        .to('[data-phase="2"]', { opacity: 1, y: 0, duration: 0.18 }, 0.33)
        .to('[data-hotspot="hull"]', { opacity: 1, duration: 0.1 }, 0.33)
        .to('[data-line="hull"]', { opacity: 1, strokeDashoffset: 0, duration: 0.22 }, 0.33)
        .to('[data-phase="3"]', { opacity: 1, y: 0, duration: 0.18 }, 0.66)
        .to('[data-hotspot="launch"]', { opacity: 1, duration: 0.1 }, 0.66)
        .to('[data-line="launch"]', { opacity: 1, strokeDashoffset: 0, duration: 0.22 }, 0.66);
      return () => tl.kill();
    });
    mm.add('(max-width: 1023px)', () => {
      gsap.set('.anatomy-card', { opacity: 1, y: 0 });
      gsap.set('.draw-line', { strokeDashoffset: 0, opacity: 1 });
      gsap.set('[data-hotspot]', { opacity: 1 });
      if (hpEl) hpEl.textContent = '300';
    });
  }

  function fillMeters(panel) {
    qsa('[data-meter]', panel).forEach((el) => {
      const width = getComputedStyle(el).getPropertyValue('--w').trim() || '70%';
      gsap.to(el, { width, duration: 1.05, ease: 'power3.out' });
    });
  }

  function initFleet() {
    const panels = qsa('.fleet-panel');
    const track = qs('.fleet-track');
    if (!panels.length || !track) return;

    panels.forEach((panel) => {
      const card = qs('.fleet-card', panel);
      if (!card || !finePointer) return;
      panel.addEventListener('mousemove', (event) => {
        const rect = card.getBoundingClientRect();
        const x = (event.clientX - rect.left) / rect.width;
        const y = (event.clientY - rect.top) / rect.height;
        gsap.to(card, {
          rotateY: (x - 0.5) * 10,
          rotateX: (0.5 - y) * 8,
          duration: 0.45,
          ease: 'power2.out',
          transformPerspective: 1100,
        });
      });
      panel.addEventListener('mouseleave', () => {
        gsap.to(card, { rotateX: 0, rotateY: 0, duration: 0.7, ease: 'power3.out' });
      });
    });

    const mm = gsap.matchMedia();
    mm.add('(min-width: 769px)', () => {
      const tween = gsap.to(track, {
        xPercent: -100 * (panels.length - 1),
        ease: 'none',
        scrollTrigger: {
          trigger: '#fleet',
          pin: true,
          scrub: 1,
          anticipatePin: 1,
          invalidateOnRefresh: true,
          end: () => `+=${window.innerWidth * (panels.length - 1)}`,
        },
      });
      panels.forEach((panel) => {
        ScrollTrigger.create({
          trigger: panel,
          containerAnimation: tween,
          start: 'left 70%',
          onEnter: () => fillMeters(panel),
        });
      });
      return () => tween.kill();
    });
    mm.add('(max-width: 768px)', () => {
      gsap.set(track, { clearProps: 'transform' });
      panels.forEach((panel) => {
        fillMeters(panel);
        ScrollTrigger.create({
          trigger: panel,
          start: 'top 75%',
          onEnter: () => fillMeters(panel),
        });
      });
    });
  }

  function setRoute(id) {
    const route = data.routes?.[id];
    if (!route) return;
    qsa('.route-tab').forEach((tab) => {
      const on = tab.dataset.route === id;
      tab.classList.toggle('is-active', on);
      tab.setAttribute('aria-selected', on ? 'true' : 'false');
    });
    const line = qs('#route-line');
    if (line) {
      line.classList.remove('is-on');
      line.setAttribute('d', route.path);
      const length = line.getTotalLength();
      line.style.strokeDasharray = `${length}`;
      line.style.strokeDashoffset = `${length}`;
      requestAnimationFrame(() => {
        line.style.transition = reduced ? 'none' : 'stroke-dashoffset 1.35s cubic-bezier(0.22, 1, 0.36, 1)';
        line.style.strokeDashoffset = '0';
      });
    }
    const modelName = data.fleet?.[route.model]?.name || route.model;
    const map = {
      '[data-route-mood]': route.mood,
      '[data-route-copy]': route.copy,
      '[data-route-distance]': route.distance,
      '[data-route-fuel]': route.fuel,
      '[data-route-ski]': modelName,
    };
    Object.entries(map).forEach(([sel, value]) => {
      const el = qs(sel);
      if (!el) return;
      gsap.fromTo(el, { opacity: 0, y: 8 }, { opacity: 1, y: 0, duration: 0.45, ease: 'power2.out' });
      el.textContent = value;
    });
  }

  function initRoutes() {
    qsa('.route-tab').forEach((tab) => {
      const activate = () => setRoute(tab.dataset.route);
      tab.addEventListener('click', activate);
      tab.addEventListener('mouseenter', activate);
    });
    const first = qs('.route-tab')?.dataset.route;
    if (first) setRoute(first);
  }

  function calcTotals() {
    const model = data.fleet?.[state.model];
    const rate = model?.pricing?.[state.duration] ?? 0;
    let addonTotal = 0;
    state.addons.forEach((id) => {
      addonTotal += data.addons?.[id]?.price || 0;
    });
    const subtotal = rate + addonTotal;
    const tax = Math.round(subtotal * (data.taxRate || 0.12) * 100) / 100;
    const total = Math.round((subtotal + tax) * 100) / 100;
    return { rate, addonTotal, subtotal, tax, total, model };
  }

  function renderBooking() {
    const { rate, addonTotal, subtotal, tax, total, model } = calcTotals();
    const priceEl = qs('#price-value');
    if (priceEl) {
      gsap.to(priceObj, {
        val: total,
        duration: reduced ? 0 : 0.75,
        ease: 'power3.out',
        overwrite: true,
        onUpdate: () => {
          priceEl.textContent = Math.round(priceObj.val).toLocaleString('en-CA');
        },
      });
    }
    const duration = data.durations?.[state.duration];
    const launch = data.launches?.[state.launch];
    const setText = (sel, value) => {
      const el = qs(sel);
      if (el) el.textContent = value;
    };
    setText('[data-sum-model]', model?.name || '—');
    setText('[data-sum-duration]', duration?.label || state.duration);
    setText('[data-sum-launch]', launch?.name || state.launch);
    setText('[data-sum-addons]', cad(addonTotal));
    setText('[data-sum-sub]', cad(subtotal));
    setText('[data-sum-tax]', cad(tax, 2));

    qsa('.option-card[data-model]').forEach((btn) => btn.classList.toggle('is-on', btn.dataset.model === state.model));
    qsa('.option-card[data-duration]').forEach((btn) => btn.classList.toggle('is-on', btn.dataset.duration === state.duration));
    qsa('[data-addon]').forEach((btn) => btn.classList.toggle('is-on', state.addons.has(btn.dataset.addon)));
    const launchSelect = qs('#booking-form [name="launch"]');
    if (launchSelect && launchSelect.value !== state.launch) launchSelect.value = state.launch;
    const riders = qs('#booking-form [name="riders"]');
    if (riders && model) riders.max = String(model.passengers);
  }

  function goStep(next) {
    state.step = Math.min(4, Math.max(1, next));
    qsa('.booking-step').forEach((step) => {
      step.classList.toggle('is-on', Number(step.dataset.step) === state.step);
    });
    qsa('[data-step-dot]').forEach((dot) => {
      dot.classList.toggle('is-on', Number(dot.dataset.stepDot) <= state.step);
    });
    const nextBtn = qs('#step-next');
    const backBtn = qs('#step-back');
    if (backBtn) backBtn.style.visibility = state.step === 1 ? 'hidden' : 'visible';
    if (nextBtn) nextBtn.textContent = state.step === 4 ? 'Lock Reservation' : 'Next';
  }

  function validateDetails() {
    const form = qs('#booking-form');
    const error = qs('[data-form-error]');
    if (!form) return false;
    const name = form.name.value.trim();
    const email = form.email.value.trim();
    const phone = form.phone.value.trim();
    const date = form.date.value;
    const riders = Number(form.riders.value);
    const model = data.fleet?.[state.model];
    const messages = [];
    if (name.length < 2) messages.push('Add the rider name.');
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) messages.push('Email looks off.');
    if ((phone.replace(/\D/g, '').length) < 10) messages.push('Phone needs 10 digits.');
    if (!date) messages.push('Pick a launch date.');
    if (model && (riders < 1 || riders > model.passengers)) messages.push(`This ski holds ${model.passengers}.`);
    if (error) {
      error.classList.toggle('hidden', messages.length === 0);
      error.textContent = messages.join(' ');
    }
    return messages.length === 0;
  }

  function openPass(payload) {
    const overlay = qs('#pass-overlay');
    if (!overlay) return;
    overlay.hidden = false;
    const map = {
      '[data-pass-status]': payload.pass?.status || 'HOLD CONFIRMED',
      '[data-pass-model]': payload.ride?.model || '',
      '[data-pass-sub]': payload.pass?.subtitle || '',
      '[data-pass-code]': payload.confirmation || '',
      '[data-pass-date]': payload.ride?.dateLabel || '',
      '[data-pass-duration]': payload.ride?.duration || '',
      '[data-pass-total]': cad(payload.breakdown?.total || 0, 2),
      '[data-pass-note]': payload.pass?.note || '',
    };
    Object.entries(map).forEach(([sel, value]) => {
      const el = qs(sel);
      if (el) el.textContent = value;
    });
    gsap.set('.wallet-pass', { y: 48, rotateX: 14, opacity: 0 });
    overlay.classList.add('is-open');
    gsap.to('.wallet-pass', { y: 0, rotateX: 0, opacity: 1, duration: 0.7, ease: 'power4.out' });
    if (state.lenis) state.lenis.stop();
  }

  function closePass() {
    const overlay = qs('#pass-overlay');
    if (!overlay) return;
    gsap.to('.wallet-pass', {
      y: 30,
      opacity: 0,
      duration: 0.35,
      onComplete: () => {
        overlay.classList.remove('is-open');
        overlay.hidden = true;
        if (state.lenis) state.lenis.start();
      },
    });
  }

  async function submitBooking() {
    const form = qs('#booking-form');
    const nextBtn = qs('#step-next');
    const error = qs('[data-form-error]');
    if (!form || !validateDetails()) return;
    state.launch = form.launch.value;
    const payload = {
      model: state.model,
      duration: state.duration,
      launch: state.launch,
      addons: Array.from(state.addons),
      name: form.name.value.trim(),
      email: form.email.value.trim(),
      phone: form.phone.value.trim(),
      date: form.date.value,
      riders: Number(form.riders.value),
      notes: form.notes.value.trim(),
    };
    if (nextBtn) {
      nextBtn.disabled = true;
      nextBtn.textContent = 'Calculating…';
    }
    try {
      const response = await fetch('api/book-estimate.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload),
      });
      const json = await response.json();
      if (!response.ok || !json.ok) {
        throw new Error(json.error || 'The dock could not confirm that estimate.');
      }
      gsap.to(priceObj, {
        val: json.breakdown.total,
        duration: 0.55,
        ease: 'power3.out',
        onUpdate: () => {
          const el = qs('#price-value');
          if (el) el.textContent = Math.round(priceObj.val).toLocaleString('en-CA');
        },
      });
      openPass(json);
    } catch (err) {
      if (error) {
        error.classList.remove('hidden');
        error.textContent = err.message || 'Could not reach the dock.';
      }
    } finally {
      if (nextBtn) {
        nextBtn.disabled = false;
        nextBtn.textContent = 'Lock Reservation';
      }
    }
  }

  function initBooking() {
    qsa('.option-card[data-model]').forEach((btn) => {
      btn.addEventListener('click', () => {
        state.model = btn.dataset.model;
        renderBooking();
      });
    });
    qsa('.option-card[data-duration]').forEach((btn) => {
      btn.addEventListener('click', () => {
        state.duration = btn.dataset.duration;
        renderBooking();
      });
    });
    qsa('.addon-card').forEach((btn) => {
      btn.addEventListener('click', () => {
        const id = btn.dataset.addon;
        if (state.addons.has(id)) state.addons.delete(id);
        else state.addons.add(id);
        renderBooking();
      });
    });
    qs('#booking-form [name="launch"]')?.addEventListener('change', (event) => {
      state.launch = event.target.value;
      renderBooking();
    });
    qs('#step-next')?.addEventListener('click', () => {
      if (state.step < 4) goStep(state.step + 1);
      else submitBooking();
    });
    qs('#step-back')?.addEventListener('click', () => goStep(state.step - 1));
    qs('#pass-close')?.addEventListener('click', closePass);
    qs('#pass-overlay')?.addEventListener('click', (event) => {
      if (event.target.id === 'pass-overlay') closePass();
    });
    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape') closePass();
    });
    qsa('[data-configure]').forEach((btn) => {
      btn.addEventListener('click', () => {
        state.model = btn.dataset.configure;
        goStep(1);
        renderBooking();
        scrollToBook();
      });
    });
    qs('#quick-launch')?.addEventListener('submit', (event) => {
      event.preventDefault();
      const form = event.currentTarget;
      state.launch = form.launch.value;
      state.model = form.model.value;
      state.duration = form.duration.value;
      goStep(2);
      renderBooking();
      scrollToBook();
    });
    goStep(1);
    renderBooking();
  }

  function initFaq() {
    qsa('.faq-item').forEach((item) => {
      qs('.faq-toggle', item)?.addEventListener('click', () => {
        const open = item.classList.contains('is-open');
        qsa('.faq-item').forEach((other) => other.classList.remove('is-open'));
        if (!open) item.classList.add('is-open');
      });
    });
  }

  function bootStage() {
    initLenis();
    initNav();
    initAnatomy();
    initFleet();
    initRoutes();
    initBooking();
    initFaq();
    playHero();
    ScrollTrigger.refresh();
    window.addEventListener('load', () => ScrollTrigger.refresh());
  }

  function runPreloader() {
    splitHeadline();
    initCursor();
    initMagnetic();
    const preloader = qs('#preloader');
    const count = qs('[data-preloader-count]');
    const bar = qs('[data-preloader-bar]');
    const wordmark = qs('.preloader-wordmark');
    if (!preloader || reduced) {
      if (preloader) preloader.remove();
      document.body.classList.remove('is-preloading');
      bootStage();
      return;
    }
    const counter = { val: 0 };
    let booted = false;
    const finish = () => {
      if (booted) return;
      booted = true;
      gsap.to(preloader, {
        yPercent: -110,
        duration: 1.15,
        ease: 'power4.inOut',
        onComplete: () => {
          preloader.remove();
          document.body.classList.remove('is-preloading');
          bootStage();
        },
      });
    };
    window.setTimeout(finish, 4200);
    const tl = gsap.timeline({
      defaults: { ease: 'power2.inOut' },
      onComplete: finish,
    });
    tl.to(counter, {
      val: 100,
      duration: 2.15,
      onUpdate: () => {
        if (count) count.textContent = `${Math.round(counter.val)}%`;
      },
    }, 0);
    if (bar) tl.to(bar, { width: '100%', duration: 2.15 }, 0);
    if (wordmark) {
      tl.fromTo(wordmark, { scale: 0.82, letterSpacing: '-0.1em' }, { scale: 1, letterSpacing: '-0.04em', duration: 2.15 }, 0);
    }
  }

  runPreloader();
})();
