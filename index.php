<?php

declare(strict_types=1);

require __DIR__ . '/data/fleet.php';

$pageTitle = 'POGO Jet Ski Rentals — Rule the Lake · Kelowna, BC';
$minDate = (new DateTimeImmutable('tomorrow'))->format('Y-m-d');
$defaultModel = 'apex-300';
$defaultDuration = '2h';
$defaultLaunch = 'downtown';

include __DIR__ . '/includes/header.php';
?>
<main id="main">
    <div id="preloader" aria-hidden="true">
        <div class="text-center">
            <p class="preloader-wordmark text-liquid">POGO&#8202;</p>
            <p class="mt-6 font-mono text-[11px] uppercase tracking-[0.48em] text-white/40">Kelowna · Okanagan Lake</p>
        </div>
        <div class="preloader-counter" data-preloader-count>0%</div>
        <div class="preloader-bar"><span data-preloader-bar></span></div>
    </div>

    <section id="top">
        <div class="hero-pin">
            <img class="hero-video" src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&w=2000&q=80" alt="Glass-calm alpine lake in the Okanagan">
            <div class="hero-vignette absolute inset-0"></div>
            <div class="hero-grid pointer-events-none absolute inset-0 opacity-40"></div>
            <div class="hero-copy-wrap relative z-10 mt-auto px-4 pt-24 sm:px-5 md:px-12">
                <p class="hero-kicker font-mono text-[10px] uppercase tracking-[0.32em] text-aqua md:text-[11px] md:tracking-[0.42em]">Unleash the Okanagan</p>
                <h1 class="hero-title mt-3 max-w-6xl text-[clamp(2.15rem,10vw,9.2rem)] font-extrabold leading-[0.94] tracking-tight md:mt-5 md:text-[clamp(3.1rem,11vw,9.2rem)] md:leading-[0.82] md:tracking-tighter">
                    <span class="block whitespace-nowrap text-liquid" data-split>RULE THE LAKE.</span>
                    <span class="block whitespace-nowrap text-white" data-split>POGO KELOWNA.</span>
                </h1>
                <p class="hero-copy mt-3 max-w-xl text-sm leading-relaxed text-white/65 md:mt-6 md:text-lg">
                    Supercharged Rotax performance. Glass-calm alpine water. VIP dockside launch in Kelowna — no boat license required.
                </p>
            </div>

            <form id="quick-launch" class="quick-launch glass z-20 rounded-3xl p-2.5 md:rounded-full md:px-4 md:py-3" aria-label="Quick launch bar">
            <div class="grid gap-1 md:grid-cols-[1.3fr_1.1fr_0.9fr_auto] md:items-center md:gap-2">
                <label class="flex flex-col gap-0.5 rounded-2xl px-3 py-1.5 md:rounded-full md:px-4 md:py-2">
                    <span class="font-mono text-[10px] uppercase tracking-[0.22em] text-white/40">Launch Location</span>
                    <select name="launch" class="magnetic w-full bg-transparent text-sm font-semibold tracking-tight outline-none" data-quick="launch">
                        <?php foreach ($launches as $launch): ?>
                            <option value="<?= htmlspecialchars($launch['id'], ENT_QUOTES) ?>"<?= $launch['id'] === $defaultLaunch ? ' selected' : '' ?>><?= htmlspecialchars($launch['name'], ENT_QUOTES) ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <label class="flex flex-col gap-0.5 rounded-2xl px-3 py-1.5 md:rounded-full md:px-4 md:py-2">
                    <span class="font-mono text-[10px] uppercase tracking-[0.22em] text-white/40">Model</span>
                    <select name="model" class="magnetic w-full bg-transparent text-sm font-semibold tracking-tight outline-none" data-quick="model">
                        <?php foreach ($fleet as $ski): ?>
                            <option value="<?= htmlspecialchars($ski['id'], ENT_QUOTES) ?>"<?= $ski['id'] === $defaultModel ? ' selected' : '' ?>><?= htmlspecialchars($ski['name'], ENT_QUOTES) ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <label class="flex flex-col gap-0.5 rounded-2xl px-3 py-1.5 md:rounded-full md:px-4 md:py-2">
                    <span class="font-mono text-[10px] uppercase tracking-[0.22em] text-white/40">Duration</span>
                    <select name="duration" class="magnetic w-full bg-transparent text-sm font-semibold tracking-tight outline-none" data-quick="duration">
                        <?php foreach ($durations as $duration): ?>
                            <option value="<?= htmlspecialchars($duration['id'], ENT_QUOTES) ?>"<?= $duration['id'] === $defaultDuration ? ' selected' : '' ?>><?= htmlspecialchars($duration['label'], ENT_QUOTES) ?> · <?= htmlspecialchars($duration['short'], ENT_QUOTES) ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <button type="submit" class="magnetic mt-1 inline-flex min-h-12 items-center justify-center gap-2 rounded-2xl bg-coral px-6 py-3 text-xs font-bold uppercase tracking-[0.2em] text-white md:mt-0 md:rounded-full md:py-4" data-magnetic>
                    Launch
                    <i data-lucide="chevrons-right" class="h-4 w-4"></i>
                </button>
            </div>
            </form>
        </div>
    </section>

    <div class="relative z-10 overflow-hidden border-y border-white/10 bg-abyss py-4">
        <div class="marquee-track font-mono text-[11px] uppercase tracking-[0.28em] text-white/45">
            <?php for ($i = 0; $i < 2; $i++): ?>
                <span>300 HP Supercharged Rotax</span>
                <span class="text-aqua">·</span>
                <span>67 MPH Top End</span>
                <span class="text-coral">·</span>
                <span>Zero Boat License</span>
                <span class="text-aqua">·</span>
                <span>Okanagan Lake 24°C</span>
                <span class="text-coral">·</span>
                <span>VIP Dockside Briefing</span>
                <span class="text-aqua">·</span>
                <span>Life Vests Included</span>
                <span class="text-coral">·</span>
                <span>Kelowna · British Columbia</span>
                <span class="text-aqua">·</span>
            <?php endfor; ?>
        </div>
    </div>

    <section id="anatomy" class="anatomy-section relative bg-abyss">
        <div class="anatomy-pin relative flex flex-col px-4 pt-24 md:px-12 md:pt-28">
            <div class="mb-4 flex items-end justify-between gap-6 md:mb-6">
                <div>
                    <p class="font-mono text-[11px] uppercase tracking-[0.32em] text-aqua">The Anatomy of POGO</p>
                    <h2 class="mt-2 max-w-3xl text-3xl font-extrabold tracking-tighter md:mt-3 md:text-5xl xl:text-6xl">Pinned to the water. Built for the lake.</h2>
                </div>
                <p class="hidden max-w-xs text-right font-mono text-[11px] uppercase leading-relaxed tracking-[0.18em] text-white/40 md:block">Scroll to inspect the machine · 3 telemetry phases</p>
            </div>

            <div class="anatomy-stage relative grid items-center gap-4 md:gap-5">
                <article class="anatomy-card order-2 glass rounded-3xl p-5 md:p-6 lg:order-none" data-phase="1">
                    <p class="font-mono text-[10px] uppercase tracking-[0.28em] text-aqua">Phase 01 · 0–33%</p>
                    <h3 class="mt-3 text-2xl font-bold tracking-tight">300HP Supercharged Rotax Engine</h3>
                    <p class="mt-3 text-sm leading-relaxed text-white/60">The Rotax 1630 ACE Supercharged sits in a sealed bay, force-fed for lake-level punch. Apple-clean power delivery, zero lag off the hole.</p>
                    <p class="hp-readout mt-5 font-mono text-4xl font-semibold tracking-tighter text-aqua md:text-5xl"><span data-hp>0</span> HP</p>
                </article>

                <div class="anatomy-visual relative order-1 mx-auto w-full lg:order-none">
                    <div class="absolute inset-x-10 top-1/2 h-40 -translate-y-1/2 rounded-full bg-aqua/20 blur-3xl"></div>
                    <img src="assets/img/anatomy.jpg" alt="POGO Apex carving Okanagan Lake" class="relative z-10 w-full rounded-[2rem] border border-white/10 object-cover shadow-[0_40px_120px_rgba(0,0,0,0.45)]" style="aspect-ratio: 16/10;">
                    <svg class="anatomy-lines pointer-events-none absolute inset-0 z-20 h-full w-full overflow-visible" viewBox="0 0 1000 625" fill="none" aria-hidden="true">
                        <path class="draw-line" data-line="engine" d="M 575 350 C 380 260, 190 210, 2 198"></path>
                        <circle data-hotspot="engine" cx="575" cy="350" r="6" fill="#00F0FF"></circle>
                        <path class="draw-line" data-line="hull" d="M 530 430 C 690 270, 860 145, 998 128"></path>
                        <circle data-hotspot="hull" cx="530" cy="430" r="6" fill="#FF5E36"></circle>
                        <path class="draw-line" data-line="launch" d="M 705 395 C 840 470, 930 545, 998 572"></path>
                        <circle data-hotspot="launch" cx="705" cy="395" r="6" fill="#ffffff"></circle>
                    </svg>
                    <div class="absolute -bottom-4 left-6 z-30 hidden rounded-full border border-white/10 bg-black/50 px-4 py-2 font-mono text-[10px] uppercase tracking-[0.2em] text-white/70 backdrop-blur-xl md:block">
                        APX-300 · Rotax 1630 ACE · Kelowna
                    </div>
                </div>

                <div class="anatomy-rail order-3 lg:order-none">
                    <article class="anatomy-card glass rounded-3xl p-5 md:p-6" data-phase="2">
                        <p class="font-mono text-[10px] uppercase tracking-[0.28em] text-coral">Phase 02 · 33–66%</p>
                        <h3 class="mt-3 text-2xl font-bold tracking-tight">ErgoLock Hull &amp; Waterproof Audio</h3>
                        <p class="mt-3 text-sm leading-relaxed text-white/60">A locked-in riding pocket and a 100W marine sound system that stays loud at 50 knots. Hydrodynamics first, theatre second.</p>
                    </article>
                    <article class="anatomy-card glass rounded-3xl p-5 md:p-6" data-phase="3">
                        <p class="font-mono text-[10px] uppercase tracking-[0.28em] text-white/50">Phase 03 · 66–100%</p>
                        <h3 class="mt-3 text-2xl font-bold tracking-tight">Zero-Hassle Kelowna Launch</h3>
                        <ul class="mt-4 space-y-2 font-mono text-[12px] uppercase tracking-[0.14em] text-white/70">
                            <li class="flex items-center gap-2"><i data-lucide="shield-check" class="h-4 w-4 text-aqua"></i> VIP dockside briefing</li>
                            <li class="flex items-center gap-2"><i data-lucide="life-buoy" class="h-4 w-4 text-aqua"></i> Life vests included</li>
                            <li class="flex items-center gap-2"><i data-lucide="badge-check" class="h-4 w-4 text-aqua"></i> No boat license required</li>
                        </ul>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <section id="fleet" class="fleet-section relative bg-midnight">
        <div class="fleet-pin flex flex-col">
            <div class="flex shrink-0 items-end justify-between px-4 pb-3 pt-20 md:px-12">
                <div>
                    <p class="font-mono text-[11px] uppercase tracking-[0.32em] text-aqua">The Fleet</p>
                    <h2 class="mt-2 text-3xl font-extrabold tracking-tighter md:text-5xl">Three machines. One lake.</h2>
                </div>
                <p class="hidden font-mono text-[11px] uppercase tracking-[0.18em] text-white/40 md:block">Drag the horizon · Horizontal inspect</p>
            </div>
            <div class="fleet-track min-h-0 flex-1">
                <?php $fleetIndex = 0; foreach ($fleet as $ski): $fleetIndex++; ?>
                    <?php
                    $speedPct = min(100, (int) round(($ski['telemetry']['speed'] / 70) * 100));
                    $hpPct = min(100, (int) round(($ski['telemetry']['hp'] / 300) * 100));
                    $seatPct = (int) round(($ski['passengers'] / 3) * 100);
                    ?>
                    <article class="fleet-panel flex h-full items-center px-4 pb-8 md:px-12" data-model="<?= htmlspecialchars($ski['id'], ENT_QUOTES) ?>">
                        <div class="fleet-card glass mx-auto grid w-full max-w-5xl overflow-hidden rounded-[1.75rem] lg:grid-cols-[1.05fr_1fr]">
                            <div class="relative h-56 overflow-hidden sm:h-64 lg:h-full lg:min-h-[22rem]">
                                <img src="<?= htmlspecialchars($ski['image'], ENT_QUOTES) ?>" alt="<?= htmlspecialchars($ski['imageAlt'], ENT_QUOTES) ?>" class="absolute inset-0 h-full w-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-abyss via-abyss/20 to-transparent"></div>
                                <span class="absolute left-5 top-5 rounded-full border border-white/15 bg-black/40 px-3 py-1 font-mono text-[11px] uppercase tracking-[0.22em] backdrop-blur-xl"><?= htmlspecialchars($ski['badge'], ENT_QUOTES) ?></span>
                            </div>
                            <div class="flex flex-col gap-6 p-5 sm:p-6 md:p-8">
                                <div>
                                    <p class="font-mono text-xs uppercase tracking-[0.24em]" style="color: <?= htmlspecialchars($ski['accent'], ENT_QUOTES) ?>"><?= htmlspecialchars($ski['code'], ENT_QUOTES) ?> · 0<?= $fleetIndex ?></p>
                                    <h3 class="mt-2 text-4xl font-extrabold tracking-tighter md:text-5xl"><?= htmlspecialchars($ski['name'], ENT_QUOTES) ?></h3>
                                    <p class="mt-2 text-base text-white/55"><?= htmlspecialchars($ski['tagline'], ENT_QUOTES) ?></p>
                                    <p class="mt-3 text-base leading-relaxed text-white/70 md:text-lg"><?= htmlspecialchars($ski['blurb'], ENT_QUOTES) ?></p>
                                    <div class="mt-6 space-y-3.5 font-mono text-xs uppercase tracking-[0.16em] text-white/60 md:text-sm">
                                        <div>
                                            <div class="mb-2 flex justify-between"><span>Top Speed</span><span><?= (int) $ski['telemetry']['speed'] ?> mph</span></div>
                                            <div class="meter"><span data-meter style="--w:<?= $speedPct ?>%"></span></div>
                                        </div>
                                        <div>
                                            <div class="mb-2 flex justify-between"><span>Acceleration 0–30</span><span><?= htmlspecialchars($ski['telemetry']['accel'], ENT_QUOTES) ?></span></div>
                                            <div class="meter"><span data-meter style="--w:<?= $hpPct ?>%"></span></div>
                                        </div>
                                        <div>
                                            <div class="mb-2 flex justify-between"><span>Passenger Capacity</span><span><?= (int) $ski['passengers'] ?> up</span></div>
                                            <div class="meter"><span data-meter style="--w:<?= $seatPct ?>%"></span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-wrap items-end justify-between gap-4">
                                    <div>
                                        <p class="font-mono text-[11px] uppercase tracking-[0.2em] text-white/40">From</p>
                                        <p class="text-4xl font-extrabold tracking-tight">$<?= (int) $ski['pricing']['1h'] ?><span class="text-lg font-medium text-white/45">/hr</span></p>
                                        <p class="font-mono text-xs text-white/45">Full-day $<?= (int) $ski['pricing']['8h'] ?></p>
                                    </div>
                                    <button type="button" class="magnetic configure-ride rounded-full bg-white px-6 py-3.5 text-sm font-bold uppercase tracking-[0.16em] text-abyss" data-magnetic data-configure="<?= htmlspecialchars($ski['id'], ENT_QUOTES) ?>">
                                        Configure Ride
                                    </button>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="routes" class="relative overflow-hidden bg-abyss py-16 md:py-24">
        <div class="mx-auto grid max-w-6xl gap-8 px-4 md:px-6 lg:grid-cols-[0.9fr_1.1fr] lg:gap-10">
            <div>
                <p class="font-mono text-[11px] uppercase tracking-[0.32em] text-aqua">Okanagan Lake Route Explorer</p>
                <h2 class="mt-3 text-3xl font-extrabold tracking-tighter md:text-6xl">Pick a line. Watch it glow.</h2>
                <p class="mt-5 max-w-md text-sm leading-relaxed text-white/60">Three riding zones from the Kelowna waterfront. Hover or tap a route to draw the line across a dark vector of the lake.</p>
                <div class="mt-8 space-y-3" role="tablist" aria-label="Lake routes">
                    <?php foreach ($routes as $routeIndex => $route): ?>
                        <button type="button" class="route-tab magnetic w-full rounded-2xl border border-white/10 bg-white/[0.03] p-4 text-left transition <?= $routeIndex === array_key_first($routes) ? 'is-active' : '' ?>" data-route="<?= htmlspecialchars($route['id'], ENT_QUOTES) ?>" role="tab" aria-selected="<?= $routeIndex === array_key_first($routes) ? 'true' : 'false' ?>" data-magnetic>
                            <div class="flex items-start justify-between gap-3">
                                <span class="text-base font-bold tracking-tight md:text-lg"><?= htmlspecialchars($route['name'], ENT_QUOTES) ?></span>
                                <span class="shrink-0 font-mono text-[10px] uppercase tracking-[0.16em] text-aqua"><?= htmlspecialchars($route['duration'], ENT_QUOTES) ?></span>
                            </div>
                            <p class="mt-1 text-sm text-white/50"><?= htmlspecialchars($route['mood'], ENT_QUOTES) ?></p>
                        </button>
                    <?php endforeach; ?>
                </div>
                <aside id="route-meta" class="glass mt-8 rounded-3xl p-6">
                    <p class="font-mono text-[10px] uppercase tracking-[0.22em] text-white/40" data-route-mood><?= htmlspecialchars($routes['skyline']['mood'], ENT_QUOTES) ?></p>
                    <p class="mt-3 text-sm leading-relaxed text-white/70" data-route-copy><?= htmlspecialchars($routes['skyline']['copy'], ENT_QUOTES) ?></p>
                    <dl class="mt-6 grid grid-cols-3 gap-3 font-mono text-[11px] uppercase tracking-[0.14em]">
                        <div>
                            <dt class="text-white/35">Distance</dt>
                            <dd class="mt-1 text-aqua" data-route-distance><?= htmlspecialchars($routes['skyline']['distance'], ENT_QUOTES) ?></dd>
                        </div>
                        <div>
                            <dt class="text-white/35">Fuel</dt>
                            <dd class="mt-1 text-aqua" data-route-fuel><?= htmlspecialchars($routes['skyline']['fuel'], ENT_QUOTES) ?></dd>
                        </div>
                        <div>
                            <dt class="text-white/35">Ski</dt>
                            <dd class="mt-1 text-aqua" data-route-ski><?= htmlspecialchars($fleet[$routes['skyline']['model']]['name'], ENT_QUOTES) ?></dd>
                        </div>
                    </dl>
                </aside>
            </div>

            <div class="map-stage relative max-h-[52vh] overflow-hidden rounded-[1.5rem] border border-white/10 p-3 md:max-h-none md:rounded-[2rem] md:p-8">
                <svg viewBox="0 0 560 900" class="mx-auto h-auto w-full max-w-lg" role="img" aria-label="Stylized map of Okanagan Lake">
                    <defs>
                        <linearGradient id="lakeFill" x1="0" y1="0" x2="1" y2="1">
                            <stop offset="0%" stop-color="#08202c"/>
                            <stop offset="50%" stop-color="#0a3a4c"/>
                            <stop offset="100%" stop-color="#051018"/>
                        </linearGradient>
                        <filter id="glow">
                            <feGaussianBlur stdDeviation="3.5" result="blur"/>
                            <feMerge>
                                <feMergeNode in="blur"/>
                                <feMergeNode in="SourceGraphic"/>
                            </feMerge>
                        </filter>
                    </defs>
                    <rect width="560" height="900" fill="#070b12" rx="28"></rect>
                    <path class="lake-water" d="M268 48 C 312 62 338 108 346 168 C 356 236 378 292 392 352 C 404 406 396 452 368 498 C 344 538 352 588 362 642 C 374 710 348 768 318 818 C 292 858 278 882 286 910 L 214 910 C 204 870 214 820 228 770 C 246 708 214 652 204 590 C 194 526 216 470 236 414 C 258 352 244 292 248 228 C 252 164 232 108 246 70 C 254 54 260 50 268 48 Z"></path>
                    <path id="route-line" class="route-path is-on" d="<?= htmlspecialchars($routes['skyline']['path'], ENT_QUOTES) ?>" filter="url(#glow)"></path>
                    <circle class="hotspot" cx="348" cy="412" r="6"></circle>
                    <circle class="hotspot" cx="360" cy="268" r="5"></circle>
                    <circle class="hotspot" cx="264" cy="710" r="5"></circle>
                    <g fill="rgba(255,255,255,0.55)" font-family="JetBrains Mono, monospace" font-size="13" letter-spacing="1.4">
                        <text x="372" y="418">KELOWNA</text>
                        <text x="376" y="262">MCKINLEY</text>
                        <text x="86" y="718">PEACHLAND</text>
                        <text x="372" y="200">KNOX Mtn</text>
                        <text x="300" y="760">RATTLESNAKE I.</text>
                    </g>
                </svg>
            </div>
        </div>
    </section>

    <section id="book" class="relative bg-midnight py-16 md:py-24">
        <div class="mx-auto max-w-6xl px-4 md:px-6">
            <div class="flex flex-col justify-between gap-4 md:flex-row md:items-end md:gap-6">
                <div>
                    <p class="font-mono text-[11px] uppercase tracking-[0.32em] text-aqua">Live Configurator</p>
                    <h2 class="mt-3 text-3xl font-extrabold tracking-tighter md:text-6xl">Build the ride.</h2>
                </div>
                <ol class="flex flex-wrap gap-2 font-mono text-[10px] uppercase tracking-[0.16em]" id="step-dots">
                    <li class="step-dot is-on rounded-full bg-white/10 px-3 py-1.5" data-step-dot="1">01 Model</li>
                    <li class="step-dot rounded-full bg-white/10 px-3 py-1.5" data-step-dot="2">02 Duration</li>
                    <li class="step-dot rounded-full bg-white/10 px-3 py-1.5" data-step-dot="3">03 Add-ons</li>
                    <li class="step-dot rounded-full bg-white/10 px-3 py-1.5" data-step-dot="4">04 Details</li>
                </ol>
            </div>

            <form id="booking-form" class="mt-8 grid gap-5 md:mt-10 md:gap-6 lg:grid-cols-[1.15fr_0.85fr]" novalidate>
                <div class="glass rounded-[1.5rem] p-4 md:rounded-[2rem] md:p-8">
                    <section class="booking-step is-on" data-step="1">
                        <h3 class="text-2xl font-bold tracking-tight">Choose your machine</h3>
                        <div class="mt-6 grid gap-4 md:grid-cols-3">
                            <?php foreach ($fleet as $ski): ?>
                                <button type="button" class="option-card magnetic rounded-2xl border border-white/10 p-4 text-left <?= $ski['id'] === $defaultModel ? 'is-on' : '' ?>" data-model="<?= htmlspecialchars($ski['id'], ENT_QUOTES) ?>" data-magnetic>
                                    <p class="font-mono text-[10px] uppercase tracking-[0.2em] text-white/40"><?= htmlspecialchars($ski['badge'], ENT_QUOTES) ?></p>
                                    <p class="mt-2 text-lg font-bold tracking-tight"><?= htmlspecialchars($ski['name'], ENT_QUOTES) ?></p>
                                    <p class="mt-3 font-mono text-sm text-aqua">$<?= (int) $ski['pricing']['1h'] ?>/hr</p>
                                    <p class="mt-1 text-xs text-white/45"><?= (int) $ski['passengers'] ?> riders · <?= (int) $ski['telemetry']['hp'] ?> hp</p>
                                </button>
                            <?php endforeach; ?>
                        </div>
                    </section>

                    <section class="booking-step" data-step="2">
                        <h3 class="text-2xl font-bold tracking-tight">How long on the lake?</h3>
                        <div class="mt-6 grid gap-4 sm:grid-cols-2">
                            <?php foreach ($durations as $duration): ?>
                                <button type="button" class="option-card magnetic rounded-2xl border border-white/10 p-5 text-left <?= $duration['id'] === $defaultDuration ? 'is-on' : '' ?>" data-duration="<?= htmlspecialchars($duration['id'], ENT_QUOTES) ?>" data-magnetic>
                                    <p class="font-mono text-[10px] uppercase tracking-[0.2em] text-aqua"><?= htmlspecialchars($duration['tag'], ENT_QUOTES) ?></p>
                                    <p class="mt-2 text-xl font-bold"><?= htmlspecialchars($duration['label'], ENT_QUOTES) ?></p>
                                    <p class="mt-1 text-sm text-white/45"><?= htmlspecialchars($duration['short'], ENT_QUOTES) ?> on Okanagan Lake</p>
                                </button>
                            <?php endforeach; ?>
                        </div>
                    </section>

                    <section class="booking-step" data-step="3">
                        <h3 class="text-2xl font-bold tracking-tight">Optional lake kit</h3>
                        <div class="mt-6 grid gap-4">
                            <?php foreach ($addons as $addon): ?>
                                <button type="button" class="addon-card magnetic flex items-start justify-between gap-4 rounded-2xl border border-white/10 p-5 text-left" data-addon="<?= htmlspecialchars($addon['id'], ENT_QUOTES) ?>" data-magnetic>
                                    <span>
                                        <span class="flex items-center gap-2 text-lg font-bold tracking-tight">
                                            <i data-lucide="<?= htmlspecialchars($addon['icon'], ENT_QUOTES) ?>" class="h-4 w-4 text-aqua"></i>
                                            <?= htmlspecialchars($addon['name'], ENT_QUOTES) ?>
                                        </span>
                                        <span class="mt-2 block text-sm text-white/55"><?= htmlspecialchars($addon['detail'], ENT_QUOTES) ?></span>
                                    </span>
                                    <span class="font-mono text-sm text-aqua">+$<?= (int) $addon['price'] ?></span>
                                </button>
                            <?php endforeach; ?>
                        </div>
                    </section>

                    <section class="booking-step" data-step="4">
                        <h3 class="text-2xl font-bold tracking-tight">Rider details</h3>
                        <div class="mt-6 grid gap-4 md:grid-cols-2">
                            <label class="block">
                                <span class="font-mono text-[10px] uppercase tracking-[0.2em] text-white/40">Full name</span>
                                <input required name="name" autocomplete="name" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/[0.04] px-4 py-3 outline-none ring-aqua/40 focus:ring-2" placeholder="Alex Moreau">
                            </label>
                            <label class="block">
                                <span class="font-mono text-[10px] uppercase tracking-[0.2em] text-white/40">Email</span>
                                <input required type="email" name="email" autocomplete="email" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/[0.04] px-4 py-3 outline-none ring-aqua/40 focus:ring-2" placeholder="alex@email.com">
                            </label>
                            <label class="block">
                                <span class="font-mono text-[10px] uppercase tracking-[0.2em] text-white/40">Phone</span>
                                <input required name="phone" autocomplete="tel" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/[0.04] px-4 py-3 outline-none ring-aqua/40 focus:ring-2" placeholder="(250) 555-0148">
                            </label>
                            <label class="block">
                                <span class="font-mono text-[10px] uppercase tracking-[0.2em] text-white/40">Launch date</span>
                                <input required type="date" name="date" min="<?= htmlspecialchars($minDate, ENT_QUOTES) ?>" value="<?= htmlspecialchars($minDate, ENT_QUOTES) ?>" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/[0.04] px-4 py-3 outline-none ring-aqua/40 focus:ring-2">
                            </label>
                            <label class="block">
                                <span class="font-mono text-[10px] uppercase tracking-[0.2em] text-white/40">Launch zone</span>
                                <select name="launch" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/[0.04] px-4 py-3 outline-none ring-aqua/40 focus:ring-2">
                                    <?php foreach ($launches as $launch): ?>
                                        <option value="<?= htmlspecialchars($launch['id'], ENT_QUOTES) ?>"<?= $launch['id'] === $defaultLaunch ? ' selected' : '' ?>><?= htmlspecialchars($launch['name'], ENT_QUOTES) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </label>
                            <label class="block">
                                <span class="font-mono text-[10px] uppercase tracking-[0.2em] text-white/40">Riders</span>
                                <input required type="number" name="riders" min="1" max="3" value="2" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/[0.04] px-4 py-3 outline-none ring-aqua/40 focus:ring-2">
                            </label>
                            <label class="block md:col-span-2">
                                <span class="font-mono text-[10px] uppercase tracking-[0.2em] text-white/40">Notes</span>
                                <textarea name="notes" rows="3" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/[0.04] px-4 py-3 outline-none ring-aqua/40 focus:ring-2" placeholder="Sunrise slot, birthday ride, GoPro already in the family..."></textarea>
                            </label>
                        </div>
                    </section>

                    <p class="form-error mt-4 hidden text-sm text-coral" data-form-error></p>
                    <div class="mt-6 flex items-center justify-between gap-3 md:mt-8">
                        <button type="button" id="step-back" class="magnetic min-h-12 rounded-full border border-white/15 px-5 py-3 text-xs font-bold uppercase tracking-[0.16em] text-white/70" data-magnetic>Back</button>
                        <button type="button" id="step-next" class="magnetic min-h-12 rounded-full bg-aqua px-6 py-3 text-xs font-bold uppercase tracking-[0.16em] text-abyss" data-magnetic>Next</button>
                    </div>
                </div>

                <aside class="glass order-first h-fit rounded-[1.5rem] p-5 lg:sticky lg:top-28 lg:order-none lg:rounded-[2rem] lg:p-8">
                    <p class="font-mono text-[10px] uppercase tracking-[0.24em] text-white/40">Estimate</p>
                    <p class="price-figure mt-2 text-5xl font-extrabold tracking-tighter md:text-6xl">$<span id="price-value">0</span></p>
                    <p class="mt-1 text-sm text-white/45">incl. 12% BC GST/PST</p>
                    <dl class="mt-8 space-y-3 border-t border-white/10 pt-6 font-mono text-[12px] uppercase tracking-[0.14em] text-white/55">
                        <div class="flex justify-between"><dt>Machine</dt><dd class="text-white" data-sum-model>POGO Apex 300</dd></div>
                        <div class="flex justify-between"><dt>Duration</dt><dd class="text-white" data-sum-duration>2 Hours</dd></div>
                        <div class="flex justify-between"><dt>Launch</dt><dd class="text-white" data-sum-launch>Downtown Marina</dd></div>
                        <div class="flex justify-between"><dt>Add-ons</dt><dd class="text-white" data-sum-addons>$0</dd></div>
                        <div class="flex justify-between"><dt>Subtotal</dt><dd class="text-white" data-sum-sub>$0</dd></div>
                        <div class="flex justify-between"><dt>Tax 12%</dt><dd class="text-white" data-sum-tax>$0</dd></div>
                    </dl>
                    <p class="mt-8 text-xs leading-relaxed text-white/40">Submitting locks a complimentary hold. A POGO captain confirms launch window by text. Fuel, vests, and briefing are staged at the slip.</p>
                </aside>
            </form>
        </div>
    </section>

    <section id="faq" class="bg-abyss py-16 md:py-24">
        <div class="mx-auto max-w-3xl px-4 md:px-6">
            <p class="font-mono text-[11px] uppercase tracking-[0.32em] text-aqua">Lake Notes</p>
            <h2 class="mt-3 text-3xl font-extrabold tracking-tighter md:text-5xl">Before you hit the glass.</h2>
            <div class="mt-10 divide-y divide-white/10 border-y border-white/10">
                <?php foreach ($faqs as $faq): ?>
                    <article class="faq-item">
                        <button type="button" class="faq-toggle flex w-full items-center justify-between gap-4 py-5 text-left text-base font-semibold tracking-tight md:text-lg">
                            <span><?= htmlspecialchars($faq['q'], ENT_QUOTES) ?></span>
                            <i data-lucide="plus" class="faq-icon h-4 w-4 shrink-0 text-aqua transition-transform"></i>
                        </button>
                        <div class="faq-body">
                            <div>
                                <p class="pb-5 text-sm leading-relaxed text-white/60"><?= htmlspecialchars($faq['a'], ENT_QUOTES) ?></p>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>

<div id="pass-overlay" class="pass-overlay" role="dialog" aria-modal="true" aria-labelledby="pass-title" hidden>
    <article class="wallet-pass overflow-hidden rounded-[2rem] border border-white/10 bg-gradient-to-b from-[#101826] to-[#05070b] shadow-[0_40px_120px_rgba(0,0,0,0.55)]">
        <div class="flex items-center justify-between bg-gradient-to-r from-aqua/20 via-transparent to-coral/20 px-6 py-4">
            <img src="assets/img/logo.png" alt="" class="h-10 w-auto">
            <p class="font-mono text-[10px] uppercase tracking-[0.22em] text-aqua" data-pass-status>HOLD CONFIRMED</p>
        </div>
        <div class="px-6 py-5">
            <p class="font-mono text-[10px] uppercase tracking-[0.22em] text-white/40" id="pass-title">POGO Reservation Pass</p>
            <p class="mt-2 text-3xl font-extrabold tracking-tighter" data-pass-model>POGO Apex 300</p>
            <p class="mt-1 text-sm text-white/55" data-pass-sub>Downtown · Okanagan Lake</p>
            <dl class="mt-6 grid grid-cols-2 gap-4 font-mono text-[11px] uppercase tracking-[0.14em] text-white/55">
                <div><dt class="text-white/35">Code</dt><dd class="mt-1 text-base text-white" data-pass-code>POGO-000000</dd></div>
                <div><dt class="text-white/35">Date</dt><dd class="mt-1 text-base text-white" data-pass-date>—</dd></div>
                <div><dt class="text-white/35">Duration</dt><dd class="mt-1 text-base text-white" data-pass-duration>—</dd></div>
                <div><dt class="text-white/35">Total</dt><dd class="mt-1 text-base text-aqua" data-pass-total>—</dd></div>
            </dl>
            <div class="pass-stripes mt-6"></div>
            <p class="mt-4 text-xs leading-relaxed text-white/45" data-pass-note></p>
        </div>
        <button type="button" id="pass-close" class="magnetic w-full border-t border-white/10 py-4 text-xs font-bold uppercase tracking-[0.2em] text-white/70" data-magnetic>Close pass</button>
    </article>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
