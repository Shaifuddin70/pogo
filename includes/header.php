<?php
declare(strict_types=1);
/** @var array $brand */
/** @var array $launches */
$pageTitle = $pageTitle ?? 'POGO Jet Ski Rentals — Kelowna, Okanagan Lake';
?>
<!DOCTYPE html>
<html lang="en" class="bg-[#05070B]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES) ?></title>
    <meta name="description" content="POGO Jet Ski Rentals in Kelowna, BC. Supercharged Rotax performance on glass-calm Okanagan Lake. VIP dockside launch. No boat license required.">
    <meta name="theme-color" content="#05070B">
    <meta property="og:title" content="POGO Jet Ski Rentals — Kelowna">
    <meta property="og:description" content="Rule the lake. Luxury high-performance jet ski rentals on Okanagan Lake.">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="en_CA">
    <meta property="og:image" content="assets/img/logo.png">
    <link rel="icon" href="assets/img/favicon.svg" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              abyss: '#05070B',
              midnight: '#0B101B',
              aqua: '#00F0FF',
              coral: '#FF5E36'
            },
            fontFamily: {
              sans: ['Plus Jakarta Sans', 'Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
              mono: ['JetBrains Mono', 'ui-monospace', 'SFMono-Regular', 'monospace']
            },
            letterSpacing: {
              tighter: '-0.06em',
              tightest: '-0.09em'
            },
            dropShadow: {
              aqua: '0 0 24px rgba(0,240,255,0.35)'
            }
          }
        }
      };
    </script>
    <link rel="stylesheet" href="https://unpkg.com/lenis@1.1.18/dist/lenis.css">
    <link rel="stylesheet" href="assets/css/custom.css?v=<?= filemtime(__DIR__ . '/../assets/css/custom.css') ?>">
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
    <script src="https://unpkg.com/lenis@1.1.18/dist/lenis.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="is-preloading font-sans antialiased bg-abyss text-white">
<a class="skip-link" href="#main">Skip to content</a>
<div class="grain" aria-hidden="true"></div>
<div class="cursor-dot" aria-hidden="true"></div>
<div class="cursor-ring" aria-hidden="true"></div>

<header class="pointer-events-none fixed inset-x-0 top-0 z-[90] pt-[env(safe-area-inset-top)]">
    <div class="header-bar w-full px-3 pt-3 md:px-4 md:pt-4 lg:mx-auto lg:flex lg:max-w-6xl lg:justify-center lg:pt-6">
        <nav class="nav-pill pointer-events-auto flex w-full items-center justify-between gap-2 rounded-full border border-white/[0.08] bg-[#070b12]/80 px-3 py-1.5 shadow-[0_10px_60px_rgba(0,0,0,0.35)] backdrop-blur-2xl lg:w-auto lg:gap-7 lg:px-5 lg:py-2.5" aria-label="Primary">
            <a href="#top" class="magnetic flex shrink-0 items-center gap-2 pr-1" data-magnetic>
                <img src="assets/img/logo.png" alt="POGO Rentals" class="h-8 w-auto md:h-10">
            </a>
            <div class="hidden items-center gap-6 text-[13px] font-medium tracking-tight text-white/70 lg:flex">
                <a href="#anatomy" class="magnetic transition hover:text-white" data-magnetic>Anatomy</a>
                <a href="#fleet" class="magnetic transition hover:text-white" data-magnetic>Fleet</a>
                <a href="#routes" class="magnetic transition hover:text-white" data-magnetic>Routes</a>
                <a href="#book" class="magnetic transition hover:text-white" data-magnetic>Book</a>
                <a href="#faq" class="magnetic transition hover:text-white" data-magnetic>FAQ</a>
            </div>
            <div class="flex shrink-0 items-center gap-2">
                <div class="hidden items-center gap-2 rounded-full border border-white/10 bg-black/20 px-3 py-1.5 md:flex" aria-live="polite">
                    <span class="lake-dot"></span>
                    <span class="font-mono text-[10px] uppercase tracking-[0.18em] text-white/80">Okanagan Lake: <?= htmlspecialchars($brand['status']['temp'], ENT_QUOTES) ?> · <?= htmlspecialchars($brand['status']['water'], ENT_QUOTES) ?></span>
                </div>
                <a href="#book" class="magnetic hidden rounded-full bg-aqua px-4 py-2 text-[12px] font-bold uppercase tracking-[0.16em] text-abyss md:inline-flex" data-magnetic>Book a Ride</a>
                <button type="button" class="magnetic inline-flex h-11 w-11 items-center justify-center rounded-full border border-white/10 text-white lg:hidden" id="menu-toggle" aria-expanded="false" aria-controls="mobile-menu" data-magnetic>
                    <i data-lucide="menu" class="icon-menu h-4 w-4"></i>
                    <i data-lucide="x" class="icon-close hidden h-4 w-4"></i>
                    <span class="sr-only">Open menu</span>
                </button>
            </div>
        </nav>
    </div>
</header>

<div id="mobile-menu" class="mobile-menu lg:hidden" hidden>
    <button type="button" class="mobile-menu-backdrop" data-menu-close aria-label="Close menu"></button>
    <div class="mobile-menu-panel" role="dialog" aria-modal="true" aria-label="Menu">
        <p class="font-mono text-[11px] uppercase tracking-[0.28em] text-aqua">Navigate</p>
        <div class="mt-8 flex flex-col gap-5 text-3xl font-extrabold tracking-tighter sm:text-4xl">
            <a href="#anatomy" class="menu-link">Anatomy</a>
            <a href="#fleet" class="menu-link">Fleet</a>
            <a href="#routes" class="menu-link">Routes</a>
            <a href="#book" class="menu-link">Book</a>
            <a href="#faq" class="menu-link">FAQ</a>
        </div>
        <div class="mt-auto">
            <a href="#book" class="menu-link magnetic inline-flex w-full items-center justify-center rounded-full bg-aqua px-5 py-3 text-xs font-bold uppercase tracking-[0.18em] text-abyss" data-magnetic>Book a Ride</a>
            <p class="mt-6 font-mono text-xs uppercase tracking-[0.22em] text-white/50">Okanagan Lake · <?= htmlspecialchars($brand['status']['temp'], ENT_QUOTES) ?> · <?= htmlspecialchars($brand['status']['water'], ENT_QUOTES) ?></p>
        </div>
    </div>
</div>
