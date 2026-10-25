<?php

declare(strict_types=1);

$taxRate = 0.12;
$currency = 'CAD';
$brand = [
    'name' => 'POGO',
    'legal' => 'POGO Jet Ski Rentals',
    'city' => 'Kelowna, BC',
    'lake' => 'Okanagan Lake',
    'phone' => '(250) 870-7646',
    'email' => 'ride@pogorentals.ca',
    'hours' => '08:00 – 20:00 · May – October',
    'address' => 'Downtown Kelowna Marina, 1070 Water Street, Kelowna, BC',
    'status' => [
        'temp' => '24°C',
        'water' => 'Calm Water',
        'wind' => '4 kt NW',
        'visibility' => 'Unlimited',
    ],
];

$durations = [
    '1h' => [
        'id' => '1h',
        'label' => '1 Hour',
        'short' => '1h',
        'hours' => 1,
        'tag' => 'Quick Hit',
    ],
    '2h' => [
        'id' => '2h',
        'label' => '2 Hours',
        'short' => '2h',
        'hours' => 2,
        'tag' => 'Most Booked',
    ],
    '4h' => [
        'id' => '4h',
        'label' => 'Half-Day',
        'short' => '4h',
        'hours' => 4,
        'tag' => 'Half-Day',
    ],
    '8h' => [
        'id' => '8h',
        'label' => 'Full-Day',
        'short' => '8h',
        'hours' => 8,
        'tag' => 'Full-Day',
    ],
];

$launches = [
    'downtown' => [
        'id' => 'downtown',
        'name' => 'Downtown Kelowna Marina',
        'area' => 'City Centre',
        'detail' => 'VIP slip beside Waterfront Park. Five-minute briefing, then you are on the glass.',
        'minutes' => 5,
        'coords' => ['x' => 348, 'y' => 412],
    ],
    'eldorado' => [
        'id' => 'eldorado',
        'name' => 'Eldorado South Pandosy',
        'area' => 'South Pandosy',
        'detail' => 'Quiet heritage shoreline with a private ramp and faster lake access south.',
        'minutes' => 8,
        'coords' => ['x' => 332, 'y' => 478],
    ],
    'mckinley' => [
        'id' => 'mckinley',
        'name' => 'McKinley Beach',
        'area' => 'North Shore',
        'detail' => 'Resort-side launch aimed at Knox Mountain, Paul’s Tomb, and the northern coves.',
        'minutes' => 6,
        'coords' => ['x' => 360, 'y' => 268],
    ],
];

$addons = [
    'gopro' => [
        'id' => 'gopro',
        'name' => 'GoPro Hero13 Action Pack',
        'price' => 49,
        'detail' => 'Chest mount, 64GB card, and a same-day 4K drop to your phone.',
        'icon' => 'camera',
    ],
    'tube' => [
        'id' => 'tube',
        'name' => 'Chiller Tube Towable',
        'price' => 39,
        'detail' => 'Two-rider inflatable tube with a 50-foot tow rope and spotter briefing.',
        'icon' => 'life-buoy',
    ],
    'fuel' => [
        'id' => 'fuel',
        'name' => 'VIP Dockside Fuel Waiver',
        'price' => 29,
        'detail' => 'Return on fumes. We top the tank. You never think about the pump.',
        'icon' => 'fuel',
    ],
];

$fleet = [
    'apex-300' => [
        'id' => 'apex-300',
        'name' => 'POGO Apex 300',
        'code' => 'APX-300',
        'tagline' => 'Supercharged flagship',
        'blurb' => 'The lake’s apex predator. A 300-horse supercharged Rotax that turns glass-calm Okanagan into a private racetrack.',
        'image' => 'assets/img/apex.jpg',
        'imageAlt' => 'Rider in a stand-up racing jet ski carving spray across open water',
        'accent' => '#00F0FF',
        'badge' => 'Flagship',
        'passengers' => 3,
        'telemetry' => [
            'hp' => 300,
            'speed' => 67,
            'accel' => '1.8s',
            'displacement' => '1,630 cc',
            'system' => 'Rotax 1630 ACE Supercharged',
            'audio' => '100W Bluetooth Marine',
        ],
        'pricing' => [
            '1h' => 149,
            '2h' => 279,
            '4h' => 499,
            '8h' => 799,
        ],
        'recommended' => 'Rattlesnake Island & Peachland Cruise',
    ],
    'cruiser-gti' => [
        'id' => 'cruiser-gti',
        'name' => 'POGO Cruiser GTI',
        'code' => 'GTI-170',
        'tagline' => 'All-day touring instrument',
        'blurb' => 'Stable, planted, and quiet at cruise. The machine you take when the plan is coves, skyline, and a long alpine afternoon.',
        'image' => 'assets/img/cruiser.jpg',
        'imageAlt' => 'Two riders touring on a three-up jet ski across open water',
        'accent' => '#7AB8FF',
        'badge' => 'Touring',
        'passengers' => 3,
        'telemetry' => [
            'hp' => 170,
            'speed' => 52,
            'accel' => '3.2s',
            'displacement' => '1,630 cc',
            'system' => 'Rotax 1630 ACE Naturally Aspirated',
            'audio' => '80W Bluetooth Marine',
        ],
        'pricing' => [
            '1h' => 119,
            '2h' => 219,
            '4h' => 399,
            '8h' => 649,
        ],
        'recommended' => 'Paul’s Tomb & Knox Mountain Cove',
    ],
    'spark-freestyle' => [
        'id' => 'spark-freestyle',
        'name' => 'POGO Freestyle Spark',
        'code' => 'SPK-90',
        'tagline' => 'Lightweight lake toy',
        'blurb' => 'A nimble two-up that treats every wake like a playground. Light, playful, and the fastest way to feel sixteen again.',
        'image' => 'assets/img/spark.jpg',
        'imageAlt' => 'Compact yellow freestyle jet ski floating in turquoise water',
        'accent' => '#FF5E36',
        'badge' => 'Freestyle',
        'passengers' => 2,
        'telemetry' => [
            'hp' => 90,
            'speed' => 40,
            'accel' => '4.1s',
            'displacement' => '899 cc',
            'system' => 'Rotax 900 ACE',
            'audio' => 'Bluetooth Helm Mount',
        ],
        'pricing' => [
            '1h' => 89,
            '2h' => 169,
            '4h' => 299,
            '8h' => 499,
        ],
        'recommended' => 'Okanagan Bridge & City Park Run',
    ],
];

$routes = [
    'skyline' => [
        'id' => 'skyline',
        'name' => 'Okanagan Bridge & City Park Run',
        'duration' => '15 mins',
        'mood' => 'Iconic Skyline',
        'distance' => '8.4 km',
        'fuel' => '0.4 tank',
        'model' => 'spark-freestyle',
        'copy' => 'Thread the William R. Bennett Bridge, carve the city shoreline, and swing past Waterfront Park while Kelowna watches from the boardwalk.',
        'path' => 'M 300 430 C 318 422, 338 418, 356 424 C 372 430, 378 448, 364 460 C 348 474, 322 470, 308 454 C 298 442, 294 436, 300 430',
    ],
    'knox' => [
        'id' => 'knox',
        'name' => 'Paul’s Tomb & Knox Mountain Cove',
        'duration' => '30 mins',
        'mood' => 'Cliffside Emerald Waters',
        'distance' => '16.2 km',
        'fuel' => '0.6 tank',
        'model' => 'cruiser-gti',
        'copy' => 'Run north along Knox Mountain’s granite shoulder into the emerald pocket at Paul’s Tomb — the lake’s most cinematic cliffside cove.',
        'path' => 'M 340 430 C 352 390, 358 340, 350 300 C 342 262, 328 238, 318 214 C 332 206, 354 218, 362 248 C 372 292, 368 348, 356 400 C 350 418, 344 426, 340 430',
    ],
    'rattlesnake' => [
        'id' => 'rattlesnake',
        'name' => 'Rattlesnake Island & Peachland Cruise',
        'duration' => 'Full Day',
        'mood' => 'Deep Water Adventure',
        'distance' => '42.0 km',
        'fuel' => '1.8 tanks',
        'model' => 'apex-300',
        'copy' => 'Southbound into deeper water, past the Peachland benches, circling the island the locals still call the home of the lake monster.',
        'path' => 'M 338 430 C 328 470, 318 520, 308 568 C 296 622, 278 668, 264 710 C 250 748, 238 770, 246 792 C 268 810, 302 792, 318 750 C 338 698, 348 640, 352 580 C 356 522, 350 470, 338 430',
    ],
];

$faqs = [
    [
        'q' => 'Do I need a boat license to ride with POGO?',
        'a' => 'No boat license is required to launch with POGO. Every rental includes a VIP dockside briefing, on-water orientation, and life vests. Riders must present government photo ID and be 16 or older to operate.',
    ],
    [
        'q' => 'What should I bring to the dock?',
        'a' => 'Swimwear, a towel, reef-safe sunscreen, and a closed-toe pair of extras for the dock. We supply life vests, a dry tube for phones, and a full safety kit on every ski.',
    ],
    [
        'q' => 'Is fuel included in the rental?',
        'a' => 'Each ski launches with a full tank. Standard returns should come back with roughly a quarter tank. Add the VIP Dockside Fuel Waiver and we handle the rest — pull in empty if you want.',
    ],
    [
        'q' => 'How does weather work on Okanagan Lake?',
        'a' => 'We launch in calm to moderate conditions only. Afternoon winds can build after 15:00; morning slots are glass. If we cancel for safety, you get a full reschedule or refund.',
    ],
    [
        'q' => 'Can I ride with kids?',
        'a' => 'Passengers 12+ are welcome in a life vest on the Apex and Cruiser. Operators must be 16+. The Spark is a two-up and is the most playful option for lighter crews.',
    ],
    [
        'q' => 'What is the cancellation policy?',
        'a' => 'Cancel or reschedule up to 24 hours before launch for a full credit. Inside 24 hours, the deposit converts to a same-season rain cheque unless we cancel for weather.',
    ],
];

$pogoPayload = [
    'taxRate' => $taxRate,
    'currency' => $currency,
    'brand' => $brand,
    'durations' => $durations,
    'launches' => $launches,
    'addons' => $addons,
    'fleet' => $fleet,
    'routes' => $routes,
];
