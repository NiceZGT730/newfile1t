<?php
session_start();
session_destroy(); // ลบข้อมูลทั้งหมดในเซสชัน
header('Location: testindex.php'); // เปลี่ยนเส้นทางกลับไปยังหน้าหลัก
exit();
?>
