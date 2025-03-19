<?php
$servername = "localhost";
$username = "root"; // แทนที่ด้วยชื่อผู้ใช้ฐานข้อมูลของคุณ
$password = ""; // แทนที่ด้วยรหัสผ่านฐานข้อมูลของคุณ
$dbname = "project";

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ดึงข้อมูลผลิตภัณฑ์
$sql = "SELECT `id`, `name`, `description`, `price`, `image_path` FROM `products`";
$result = $conn->query($sql);

$products = array();

if ($result->num_rows > 0) {
    // วนลูปเพื่อดึงข้อมูลแต่ละแถว
    while($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
} else {
    echo "0 results";
}

// ปิดการเชื่อมต่อ
$conn->close();

// ส่งข้อมูลกลับเป็น JSON
header('Content-Type: application/json');
echo json_encode($products);
?>