<?php
header("Content-Type: application/json");

$product = $_POST['productName'] ?? '';
$file = $_FILES['csvFile'] ?? null;

if (!$product || !$file) {
    echo json_encode(["error" => "Product name and file required"]);
    exit;
}

$uploadDir = __DIR__ . "/uploads/";
if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

$targetPath = $uploadDir . basename($file['name']);
if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
    echo json_encode(["error" => "Failed to upload file"]);
    exit;
}

// Escape arguments
$escapedProduct = escapeshellarg($product);
$escapedPath = escapeshellarg($targetPath);

// Command to run Python
$command = "python predict.py $escapedProduct $escapedPath 2>&1";
exec($command, $output, $statusCode);

// Log output to file for debugging
file_put_contents("debug_output.log", "COMMAND: $command\nSTATUS: $statusCode\nOUTPUT:\n" . implode("\n", $output));

if ($statusCode !== 0) {
    echo json_encode(["error" => "Python script failed", "details" => implode("\n", $output)]);
    exit;
}

$response = implode("\n", $output);
$json = json_decode($response, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode([
        "error" => "Invalid JSON from Python",
        "raw" => $response,
        "json_error" => json_last_error_msg()
    ]);
    exit;
}

$csvPath = __DIR__ . "/downloads/predicted_output.csv";
if (!file_exists($csvPath)) {
    echo json_encode(["error" => "CSV output file not found"]);
    exit;
}


echo json_encode($json);
