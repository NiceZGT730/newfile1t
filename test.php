<?php
session_start(); // เริ่มต้น session

// ตรวจสอบว่ามีการตั้งค่า session หรือไม่
if (!isset($_SESSION['user_id'])) {
    // ถ้าไม่มี session ให้ redirect ไปยังหน้า login
    header("Location: signin.php");
    exit; // หยุดการทำงานของ script
}

// ถ้ามี session แสดงเนื้อหาของหน้า
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Protected Page</title>
</head>
<body>
    <h1>Welcome to the Protected Page</h1>
        <p>You are logged in as User ID: <?php echo $_SESSION['user_id']; ?></p>
    <a href="logout.php">Logout</a>
</body>
</html>
