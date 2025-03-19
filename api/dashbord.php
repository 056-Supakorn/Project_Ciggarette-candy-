<?php
session_start();

// ตรวจสอบว่าผู้ใช้ล็อกอินหรือยัง
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// ส่งค่าชื่อผู้ใช้ไปยัง HTML
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script>
        // ส่งค่าชื่อผู้ใช้ไปที่หน้า HTML
        document.addEventListener("DOMContentLoaded", function () {
            let username = "<?php echo $username; ?>";
            document.getElementById("welcome-message").innerHTML = "ลูกอมอร่อย ส่งตรงถึงมือคุณ, " + username;
        });
    </script>
</head>
<body>
    <h1>ยินดีต้อนรับ, <?php echo $username; ?>!</h1>
    <p><a href="logout.php">ออกจากระบบ</a></p>

    <!-- โหลด dashbord.html -->
    <iframe src="dashbord.html" width="100%" height="600px"></iframe>
</body>
</html>
