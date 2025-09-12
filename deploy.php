<?php
// Path to your project directory
$projectRoot = "/sites/solidrow.lk";

// Secret key (same as you set in GitHub webhook secret)
$secret = "d928fbbc94e6e4f00955932551879048bf729773d01be8580ee53456665414b6";

// Get raw payload from GitHub
$payload = file_get_contents("php://input");
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';

// Verify signature (security)
if ($secret && $signature) {
    $expected = "sha256=" . hash_hmac('sha256', $payload, $secret);
    if (!hash_equals($expected, $signature)) {
        http_response_code(403);

        
        die("Invalid signature");
    }
}

// Decode payload
$data = json_decode($payload, true);

// Optional: log payload for debugging
file_put_contents("webhook.log", date("Y-m-d H:i:s") . " - " . $payload . "\n", FILE_APPEND);

// Run git pull in project folder
chdir($projectRoot);
$output = shell_exec("git pull 2>&1");

// Log output
file_put_contents("deploy.log", date("Y-m-d H:i:s") . " - " . $output . "\n", FILE_APPEND);

echo "Deployment successful: " . $output;
