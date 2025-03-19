<?php
session_start();
$conn = new mysqli("localhost", "root", "", "project");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT user_id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        
        if ($username === 'admin' && $password === '1234') {
            $_SESSION['user_role'] = 'admin'; // กำหนด Session Role
            header("Location: ../HTML/admin.html"); // เปลี่ยนเส้นทางไปที่หน้า Admin
            exit();
        } else {
            echo "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
        }
        if ($password == $row['password']) { 
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];

            // ส่งค่า username ไปที่ JavaScript ผ่าน sessionStorage
            echo "<script>
                    sessionStorage.setItem('username', '$username');
                    window.location.href = '../HTML/dashbord.html';
                  </script>";
            exit();
        } else {
            echo "รหัสผ่านไม่ถูกต้อง!";
        }
    } else {
        echo "ไม่พบผู้ใช้!";
    }
    $stmt->close();
}
$conn->close();
?>
