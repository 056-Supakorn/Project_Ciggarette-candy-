<?php
// ตั้งค่าการเชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ตรวจสอบว่ามีค่าที่ส่งมาหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'], $_POST['email'], $_POST['password'])) {
    // รับข้อมูลจากฟอร์มและป้องกัน XSS
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = !empty($_POST['password']) ? $_POST['password'] : "defaultPass123";


    // เตรียมคำสั่ง SQL และผูกพารามิเตอร์
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");

    // ตรวจสอบว่าการเตรียมคำสั่ง SQL สำเร็จหรือไม่
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // ผูกพารามิเตอร์
    $stmt->bind_param("sss", $username, $email, $password);

    // ประมวลผลคำสั่ง SQL
    if ($stmt->execute()) {
        echo "Registration successful!";
        header("Location: ../HTML/index.html");
    } else {
        echo "Error: " . $stmt->error;
    }

    // ปิด statement
    $stmt->close();
} else {
    echo "Invalid form submission.";
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?>
