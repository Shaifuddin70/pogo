<?php

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');
header('Cache-Control: no-store');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Methods: POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');
    http_response_code(204);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'Send a POST request to request a POGO estimate.']);
    exit;
}

require dirname(__DIR__) . '/data/fleet.php';

$raw = file_get_contents('php://input');
$decoded = json_decode($raw ?: '', true);
$input = is_array($decoded) ? $decoded : $_POST;

function pogo_fail(int $status, string $message, array $fields = []): never
{
    http_response_code($status);
    echo json_encode([
        'ok' => false,
        'error' => $message,
        'fields' => $fields,
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function pogo_text(mixed $value, int $max = 120): string
{
    $text = trim((string) $value);
    $text = preg_replace('/\s+/u', ' ', $text) ?? $text;
    if (function_exists('mb_substr')) {
        return mb_substr($text, 0, $max);
    }
    return substr($text, 0, $max);
}

function pogo_cents(float|int $amount): int
{
    return (int) round(((float) $amount) * 100);
}

function pogo_money(int $cents): float
{
    return round($cents / 100, 2);
}

$modelId = pogo_text($input['model'] ?? '', 40);
$durationId = pogo_text($input['duration'] ?? '', 8);
$launchId = pogo_text($input['launch'] ?? '', 40);
$name = pogo_text($input['name'] ?? '', 80);
$email = pogo_text($input['email'] ?? '', 120);
$phone = pogo_text($input['phone'] ?? '', 40);
$date = pogo_text($input['date'] ?? '', 12);
$riders = (int) ($input['riders'] ?? 1);
$notes = pogo_text($input['notes'] ?? '', 280);
$addonIds = $input['addons'] ?? [];

if (!is_array($addonIds)) {
    $addonIds = [];
}

$addonIds = array_values(array_unique(array_map(static fn($id) => pogo_text($id, 40), $addonIds)));

$fields = [];

if (!isset($fleet[$modelId])) {
    $fields['model'] = 'Choose a POGO model.';
}

if (!isset($durations[$durationId])) {
    $fields['duration'] = 'Choose a launch duration.';
}

if (!isset($launches[$launchId])) {
    $fields['launch'] = 'Choose a Kelowna launch zone.';
}

$nameLength = function_exists('mb_strlen') ? mb_strlen($name) : strlen($name);
if ($nameLength < 2) {
    $fields['name'] = 'Name needs at least two characters.';
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $fields['email'] = 'Enter a valid email for the reservation pass.';
}

$phoneDigits = preg_replace('/\D+/', '', $phone) ?? '';
if (strlen($phoneDigits) < 10) {
    $fields['phone'] = 'Enter a 10-digit phone number.';
}

$today = new DateTimeImmutable('today');
$rideDate = DateTimeImmutable::createFromFormat('Y-m-d', $date) ?: false;
if ($rideDate === false) {
    $fields['date'] = 'Pick a launch date.';
} elseif ($rideDate < $today) {
    $fields['date'] = 'Launch date cannot be in the past.';
}

$model = $fleet[$modelId] ?? null;
if ($model !== null) {
    $maxRiders = (int) $model['passengers'];
    if ($riders < 1 || $riders > $maxRiders) {
        $fields['riders'] = 'This ski holds ' . $maxRiders . ' rider' . ($maxRiders === 1 ? '' : 's') . '.';
    }
}

$cleanAddons = [];
foreach ($addonIds as $addonId) {
    if ($addonId === '') {
        continue;
    }
    if (!isset($addons[$addonId])) {
        $fields['addons'] = 'Unknown add-on in the request.';
        break;
    }
    $cleanAddons[] = $addonId;
}

if ($fields !== []) {
    pogo_fail(422, 'We could not confirm that configuration.', $fields);
}

$rateCents = pogo_cents($model['pricing'][$durationId]);
$addonLines = [];
$addonCents = 0;

foreach ($cleanAddons as $addonId) {
    $addon = $addons[$addonId];
    $lineCents = pogo_cents($addon['price']);
    $addonCents += $lineCents;
    $addonLines[] = [
        'id' => $addon['id'],
        'name' => $addon['name'],
        'price' => pogo_money($lineCents),
    ];
}

$subtotalCents = $rateCents + $addonCents;
$taxCents = (int) round($subtotalCents * $taxRate);
$totalCents = $subtotalCents + $taxCents;

$confirmation = sprintf(
    'POGO-%s-%s',
    strtoupper(substr(bin2hex(random_bytes(3)), 0, 6)),
    $rideDate->format('md')
);

$payload = [
    'ok' => true,
    'confirmation' => $confirmation,
    'issuedAt' => (new DateTimeImmutable('now'))->format(DateTimeInterface::ATOM),
    'rider' => [
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'riders' => $riders,
        'notes' => $notes,
    ],
    'ride' => [
        'date' => $rideDate->format('Y-m-d'),
        'dateLabel' => $rideDate->format('D, M j Y'),
        'modelId' => $model['id'],
        'model' => $model['name'],
        'code' => $model['code'],
        'durationId' => $durationId,
        'duration' => $durations[$durationId]['label'],
        'hours' => $durations[$durationId]['hours'],
        'launchId' => $launchId,
        'launch' => $launches[$launchId]['name'],
        'launchArea' => $launches[$launchId]['area'],
    ],
    'breakdown' => [
        'currency' => $currency,
        'rate' => pogo_money($rateCents),
        'addons' => $addonLines,
        'addonTotal' => pogo_money($addonCents),
        'subtotal' => pogo_money($subtotalCents),
        'taxRate' => $taxRate,
        'taxLabel' => 'BC GST + PST (12%)',
        'tax' => pogo_money($taxCents),
        'total' => pogo_money($totalCents),
    ],
    'pass' => [
        'title' => 'POGO Reservation Pass',
        'subtitle' => $launches[$launchId]['area'] . ' · Okanagan Lake',
        'status' => 'HOLD CONFIRMED',
        'note' => 'Show this pass at the dock. A POGO captain will complete the briefing 15 minutes before launch.',
    ],
];

echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
