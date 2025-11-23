<?php
// Load environment variables from .env file
function loadEnv($path) {
    if (!file_exists($path)) {
        return;
    }
    
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        
        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);
        
        if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
            putenv(sprintf('%s=%s', $name, $value));
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
        }
    }
}

// Load .env file
loadEnv(__DIR__ . '/.env');

// Get database credentials from environment or use defaults
// Server: 169.239.251.102
$host = getenv('DB_HOST') ?: 'localhost';
$user = getenv('DB_USER') ?: 'peter.mayen'; // Your MySQL username (likely same as system username)
$pass = getenv('DB_PASS') ?: 'Machuek'; // You need to set this after changing MySQL password
$db = getenv('DB_NAME') ?: 'webtech_2025A_peter_mayen'; // Update with your actual database name

$con = new mysqli($host, $user, $pass, $db);

if ($con->connect_error) {
    error_log("Database connection failed: " . $con->connect_error);
    // Only output JSON if headers haven't been sent
    if (!headers_sent()) {
        header("Content-Type: application/json");
        echo json_encode(["state" => false, "error" => "Database connection failed: " . $con->connect_error]);
    }
    die("Database connection failed: " . $con->connect_error);
}

// Set charset to utf8mb4 for proper character handling
$con->set_charset("utf8mb4");
?>
