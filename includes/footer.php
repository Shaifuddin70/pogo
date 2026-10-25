<?php
declare(strict_types=1);
/** @var array $brand */
?>
<footer class="relative overflow-hidden border-t border-white/10 bg-[#05070B] pt-16 md:pt-20">
    <div class="pointer-events-none absolute inset-x-0 -top-10 flex justify-center">
        <p class="watermark font-sans">POGO</p>
    </div>
    <div class="relative mx-auto grid max-w-6xl gap-12 px-6 pb-16 md:grid-cols-12">
        <div class="md:col-span-5">
            <img src="assets/img/logo.png" alt="POGO Rentals" class="h-16 w-auto">
            <p class="mt-6 max-w-sm text-sm leading-relaxed text-white/55">
                Luxury high-performance jet ski rentals on Okanagan Lake. VIP dockside briefing, life vests included, and a lake that looks like it was poured from glass.
            </p>
            <a href="#book" class="magnetic mt-8 inline-flex items-center gap-2 rounded-full bg-aqua px-5 py-3 text-xs font-bold uppercase tracking-[0.18em] text-abyss" data-magnetic>
                Reserve a ski
                <i data-lucide="arrow-up-right" class="h-4 w-4"></i>
            </a>
        </div>
        <div class="md:col-span-3">
            <p class="font-mono text-[11px] uppercase tracking-[0.22em] text-aqua">Dock</p>
            <p class="mt-4 text-sm text-white/70"><?= htmlspecialchars($brand['address'], ENT_QUOTES) ?></p>
            <p class="mt-2 font-mono text-xs text-white/45"><?= htmlspecialchars($brand['hours'], ENT_QUOTES) ?></p>
        </div>
        <div class="md:col-span-4">
            <p class="font-mono text-[11px] uppercase tracking-[0.22em] text-aqua">Direct</p>
            <a class="mt-4 block text-lg tracking-tight text-white hover:text-aqua" href="tel:+12508707646"><?= htmlspecialchars($brand['phone'], ENT_QUOTES) ?></a>
            <a class="mt-1 block text-white/70 hover:text-white" href="mailto:<?= htmlspecialchars($brand['email'], ENT_QUOTES) ?>"><?= htmlspecialchars($brand['email'], ENT_QUOTES) ?></a>
            <div class="mt-6 flex gap-3">
                <a class="magnetic inline-flex h-10 w-10 items-center justify-center rounded-full border border-white/10" href="https://instagram.com" aria-label="Instagram" data-magnetic>
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                    </svg>
                </a>
                <a class="magnetic inline-flex h-10 w-10 items-center justify-center rounded-full border border-white/10" href="https://maps.google.com/?q=Kelowna+Marina" aria-label="Maps" data-magnetic>
                    <i data-lucide="map-pin" class="h-4 w-4"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="relative flex flex-col gap-3 border-t border-white/10 px-6 py-6 text-[11px] uppercase tracking-[0.18em] text-white/35 md:flex-row md:items-center md:justify-between">
        <p>© <?= date('Y') ?> POGO Jet Ski Rentals · Kelowna, British Columbia</p>
        <p class="font-mono">GST/PST 12% · Operated on Okanagan Lake</p>
    </div>
</footer>

<script>
  window.POGO = <?= json_encode($pogoPayload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>;
</script>
<script src="assets/js/animations.js"></script>
</body>
</html>
