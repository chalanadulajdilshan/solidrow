<?php
/**
 * Public proxy: candidate registration progress lookup.
 * Forwards the query to the Solidrow Registration (Laravel) API and returns
 * its JSON as-is. Server-to-server, so no CORS is involved.
 */
header('Content-Type: application/json; charset=UTF8');

$q = trim($_GET['q'] ?? '');
if ($q === '') {
    http_response_code(422);
    echo json_encode(['message' => 'Enter your passport, mobile or NIC number.']);
    exit();
}

// Registration API base — local vs live, mirroring class/Database.php detection.
$isLocal = in_array($_SERVER['SERVER_NAME'] ?? '', ['localhost', '127.0.0.1'], true);
$apiBase = $isLocal
    ? 'http://127.0.0.1:8000/api'
    : 'https://registration.solidrow.lk/api';

$url = $apiBase . '/progress?q=' . urlencode($q);

$ch = curl_init($url);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 15,
    CURLOPT_HTTPHEADER => ['Accept: application/json'],
]);
$body = curl_exec($ch);
$status = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($body === false || $status === 0) {
    http_response_code(502);
    echo json_encode(['message' => 'Could not reach the registration service. Please try again later.']);
    exit();
}

http_response_code($status ?: 200);
echo $body; // pass the Laravel JSON straight through
