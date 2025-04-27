<?php
// CORS headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}


$host = "localhost";
$username = "root";
$password = "2006";
$database = "ecommerce"; // ✅ your correct database name

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
}

// Read raw POST data
$data = json_decode(file_get_contents("php://input"), true);

$cartItems = $data["cart"] ?? [];
$totalAmount = $data["total"] ?? 0;

// Step 1: Save order
$orderStmt = $conn->prepare("INSERT INTO orders (total_amount, created_at) VALUES (?, NOW())");
$orderStmt->bind_param("d", $totalAmount);
$orderStmt->execute();
$orderId = $orderStmt->insert_id;
$orderStmt->close();

// Step 2: Save ordered items into the ecommerce.ordered_items table
$stmt = $conn->prepare("INSERT INTO ordered_items (order_id, product_name, product_price, product_image, category_id, quantity) VALUES (?, ?, ?, ?, ?, ?)");

foreach ($cartItems as $item) {
    $stmt->bind_param(
        "isdssi",
        $orderId,
        $item["name"],
        $item["price"],
        $item["image"],
        $item["category_id"],
        $item["quantity"]
    );
    $stmt->execute();
}
$stmt->close();

$conn->close();

echo json_encode(["status" => "success", "order_id" => $orderId]);
?>
