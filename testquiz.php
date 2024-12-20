<?php
session_start();
if (!isset($_SESSION['userid'])) {
    // ถ้าไม่มีการกำหนด $_SESSION['userid'] ให้เปลี่ยนเส้นทางไปที่หน้า login
    header("Location: testlogin.php");
    exit(); // หยุดการทำงานของ script เพื่อให้แน่ใจว่าจะไม่ประมวลผลโค้ดด้านล่าง
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STOU e-Learning</title>
    <!-- ลิงค์ไปยัง Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Itim&family=K2D:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="testindex.css">
    <style>
        /* ตั้งค่าพื้นฐาน */
        body {
            font-family: 'Mitr', sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
        }

        h1.section-title {
            font-size: 40px;
            /* font-weight: bold; */
        }

        /* การตั้งค่า Card */
        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
            margin-bottom: 20px; /* เพิ่มระยะห่างระหว่างการ์ด */
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .card-img-top {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .card-body {
            padding: 16px;
        }

        /* ตัวอักษร */
        .card-title {
            font-size: 18px;
            margin-bottom: 8px;
        }

        .card-code, .card-category, .card-author {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 8px;
        }

        .card-rating {
            font-size: 14px;
            color: #ffc107;
        }

        /* ปุ่ม */
        .btn-primary {
            background-color: #0D6eFD;

            padding: 10px 10px;

        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        hr {
            margin-bottom: 40px;
        }

        /* เพิ่มการจัดระเบียบระหว่างรายการใน list-group */
        .list-group-item {
            margin-bottom: 15px; /* เพิ่มระยะห่างระหว่างรายการ */
            border-radius: 8px; /* ปรับขอบให้มน */
            padding: 15px;
            font-size: 18px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .list-group-item:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        /* ปรับขนาดตัวอักษรให้เหมาะสม */
        .list-group-item-action {
            font-size: 18px;
        }

        .list-group-item-action:hover {
            background-color: #f1f1f1;
        }
        .alert-line{
            background-color: #ffc107
        }
        .alert-line:hover{
            background-color: #ebb20a;
        }
    </style>
</head>
<body>
    <header class="bg-light py-3 border-bottom">
        <div class="container d-flex justify-content-start align-items-center">
            <div class="logo">
                <a href="testindex.php"><img src="logosolar.png" width="150px" alt="Logo" class="logo"></a>
            </div>
            <nav class="ms-3"> 
                <ul class="nav">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">หมวดหมู่</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="testchapter.php">เนื้อหาบทเรียน</a></li>
                            <li><a class="dropdown-item" href="testquiz.php">แบบทดสอบหลังเรียน</a></li>
                            <li><a class="dropdown-item" href="testgame.html">เกมฝึกฝนทักษะ</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <div class="language-login d-flex gap-3 align-items-center ms-auto">
                <a href="testlogin.php" class="logins btn btn-primary btn-sm">เข้าสู่ระบบ</a>
            </div>
        </div>
    </header>

    <main class="container py-5">
        <h1 class="mb-4 text-center section-title">แบบทดสอบหลังเรียน</h1>
        <hr>
        <div class="list-group">
            <!-- แบบทดสอบที่ 1 -->
            <a href="test1.html" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                แบบทดสอบที่ 1: เอกภพและระบบสุริยะ
            </a>
            <!-- แบบทดสอบที่ 2 -->
            <a href="test2.html" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                แบบทดสอบที่ 2: ดาวเคราะห์ในระบบสุริยะ
            </a>
            <!-- แบบทดสอบที่ 3 -->
            <a href="test3.html" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                แบบทดสอบที่ 3: พัฒนาการของแบบจำลองระบบสุริยะ
            </a>
            <!-- แบบทดสอบที่ 4 -->
            <a href="test4.html" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                แบบทดสอบที่ 4: ปรากฏการณ์ต่างๆ
            </a>
            <!-- แบบทดสอบหลังเรียน -->
            <a href="finaltest.html" class="alert-line list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                แบบทดสอบหลังเรียน: ทบทวนเนื้อหาทั้งหมด
            </a>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
