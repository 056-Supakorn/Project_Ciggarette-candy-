<?php
header('Content-Type: application/json');

$host = 'localhost';
$dbname = 'project';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // รับข้อมูลจากฟอร์ม
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // อัปโหลดรูปภาพ
    $imagePath = '';
    if (isset($_FILES['image'])) {
        $targetDir = "img/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true); // สร้างโฟลเดอร์หากไม่มี
        }
        $targetFile = $targetDir . basename($_FILES['image']['name']);
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $imagePath = $targetFile;
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to upload image']);
            exit;
        }
    }

    // เพิ่มสินค้าในฐานข้อมูล
    $stmt = $conn->prepare("INSERT INTO products (name, description, price, image_path) VALUES (:name, :description, :price, :image_path)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':image_path', $imagePath);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add product']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>