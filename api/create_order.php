<?php
header("Content-Type: application/json");

// เชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// รับข้อมูลจาก request
$data = json_decode(file_get_contents("php://input"), true);

$totalPrice = $data['totalPrice'];
$items = $data['items'];

// บันทึกข้อมูลการสั่งซื้อลงตาราง orders
$sql = "INSERT INTO orders (total_price) VALUES ($totalPrice)";
if ($conn->query($sql) === TRUE) {
    $orderId = $conn->insert_id; // ดึง ID ของคำสั่งซื้อที่เพิ่งสร้าง

    // บันทึกข้อมูลสินค้าในคำสั่งซื้อลงตาราง order_items
    foreach ($items as $item) {
        $productName = $item['name'];
        $quantity = $item['quantity'];
        $price = $item['price'];

        $sql = "INSERT INTO order_items (order_id, product_name, quantity, price) 
                VALUES ($orderId, '$productName', $quantity, $price)";
        $conn->query($sql);
    }

    echo json_encode(["success" => true, "message" => "Order created successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Error creating order"]);
}

$conn->close();
?>