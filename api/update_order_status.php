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
    die(json_encode(["success" => false, "message" => "Connection failed: " . $conn->connect_error]));
}

// รับข้อมูลจาก request
$data = json_decode(file_get_contents("php://input"), true);
$id = $_GET['id'];
$status = $data['status'];

// ตรวจสอบว่ามีข้อมูลที่จำเป็นหรือไม่
if (empty($id) || empty($status)) {
    echo json_encode(["success" => false, "message" => "Missing required data"]);
    exit;
}

// อัปเดตสถานะคำสั่งซื้อ
$sql = "UPDATE `orders` SET status = ? WHERE id = ? ";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $status, $id);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Error updating order status"]);
}

$stmt->close();
$conn->close();
?>