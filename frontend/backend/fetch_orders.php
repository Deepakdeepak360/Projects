<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Database connection
$conn = new mysqli("localhost", "root", "2006", "ecommerce"); // Updated password

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Fetch orders with their items
$orders = [];
$query = "SELECT o.id, o.created_at, o.total_amount, oi.product_name, oi.product_price, 
          oi.product_image, oi.quantity, oi.category_id 
          FROM orders o 
          LEFT JOIN ordered_items oi ON o.id = oi.order_id 
          ORDER BY o.created_at DESC";

$result = $conn->query($query);

if ($result) {
    $currentOrder = null;
    
    while ($row = $result->fetch_assoc()) {
        if (!$currentOrder || $currentOrder['id'] !== $row['id']) {
            // Start a new order
            if ($currentOrder) {
                $orders[] = $currentOrder;
            }
            
            $currentOrder = [
                'id' => $row['id'],
                'created_at' => $row['created_at'],
                'total_amount' => $row['total_amount'],
                'status' => 'Delivered',
                'items' => []
            ];
        }
        
        // Add item to current order
        if ($row['product_name']) {
            $currentOrder['items'][] = [
                'product_name' => $row['product_name'],
                'product_price' => $row['product_price'],
                'product_image' => $row['product_image'],
                'quantity' => $row['quantity']
            ];
        }
    }
    
    // Add the last order
    if ($currentOrder) {
        $orders[] = $currentOrder;
    }
}

$conn->close();
echo json_encode($orders);
?>