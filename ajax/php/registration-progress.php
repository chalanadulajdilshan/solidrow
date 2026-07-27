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

// Enrich the Laravel JSON with the admin-panel Candidate Reg. No (agencystudent.student_id),
// matched on the shared registration_no. Falls back silently if unavailable.
$data = json_decode($body, true);
if (is_array($data) && !empty($data['registration_no'])) {
    try {
        require_once __DIR__ . '/../../class/Database.php';
        $db = new Database();
        $regNo = $db->escapeString($data['registration_no']);
        $result = $db->readQuery(
            "SELECT `student_id` FROM `agencystudent` WHERE `registration_no` = '" . $regNo . "' LIMIT 1"
        );
        if ($result && ($row = mysqli_fetch_assoc($result)) && !empty($row['student_id'])) {
            $data['candidate_reg_no'] = $row['student_id'];
        }
    } catch (\Throwable $e) {
        // Leave the response as-is; the frontend falls back to registration_no.
    }
    $body = json_encode($data);
}

http_response_code($status ?: 200);
echo $body; // Laravel JSON, enriched with candidate_reg_no when available
