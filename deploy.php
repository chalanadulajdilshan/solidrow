<?php
// Path to your project directory (ensure this is the correct path)
$repo_dir = '/home/festelsd/sites/solidrow.lk';

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

// Ensure the Git repository exists at the specified path
if (is_dir($projectRoot . '/.git')) {
    chdir($projectRoot);
    
    // Set GIT_DISCOVERY_ACROSS_FILESYSTEM to allow Git to look beyond filesystem boundaries
    putenv("GIT_DISCOVERY_ACROSS_FILESYSTEM=1");

    // Run git pull in project folder
    $output = shell_exec("git pull 2>&1");

    // Log output
    file_put_contents("deploy.log", date("Y-m-d H:i:s") . " - " . $output . "\n", FILE_APPEND);

    echo "Deployment successful: " . $output;
} else {
    http_response_code(500);
    echo "Error: Git repository not found at specified path.";
}
?>
