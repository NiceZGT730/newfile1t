<?php
session_start(); // เริ่มต้น session





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
        .card {
            transition: box-shadow 0.3s;
            /* ทำให้เงาเกิดขึ้นอย่างนุ่มนวล */
        }

        .card:hover {
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
            /* เพิ่มเงาเมื่อเมาส์วางบน card */
        }

        .logins {
            padding: 10px;
        }
        .username{
            text-decoration: none;
            font-size: 16px;
        }
        .welcome{
            color:rgb(235, 182, 20);
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
                            <li><a class="dropdown-item" href="#">เกมฝึกฝนทักษะ</a></li>
                        </ul>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">หน้าหลัก</a>
                    </li> -->
                </ul>
            </nav>
            <div class="language-login d-flex gap-3 align-items-center ms-auto">
                <?php if (isset($_SESSION['userid'])): ?>
                    <!-- แสดงชื่อผู้ใช้และปุ่ม logout -->
                    <a class="username" href="#"><span class="username"><?= htmlspecialchars($_SESSION['username']); ?></span></a>
                    <a href="logout.php" class="logins btn btn-danger btn-sm">ออกจากระบบ</a>
                <?php else: ?>
                    <!-- แสดงปุ่มเข้าสู่ระบบ -->
                    <a href="testlogin.php" class="logins btn btn-primary btn-sm">เข้าสู่ระบบ</a>
                <?php endif; ?>
            </div>

          


        </div>

    </header>

    <main>
        <section class="hero py-5 bg-gradient">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="hero-text text-center text-md-start">
                    <h2 class="display-4">ที่ไหน...เวลาใด...ใครก็เรียนได้</h2>
                    <p class="lead">ศึกษาหาความรู้ เข้าเรียนได้แล้ววันนี้!!!</p>
                    <?php if (isset($_SESSION['userid'])): ?>
                    <!-- แสดงชื่อผู้ใช้และปุ่ม logout -->
                    <h3 class="welcome">ยินดีต้อนรับ, <?= htmlspecialchars($_SESSION['username']); ?></h3>
                   
                <?php else: ?>
                    <a href="testlogin.php"><button class="btn btn-primary btn-lg">เข้าสู่ระบบ</button></a>
                    <?php endif; ?>
                </div>
                <div class="hero-image d-none d-md-block">
                    <img src="student-image.jpg" width="500px" alt="Student Image" class="img-fluid rounded-3">
                </div>
            </div>
        </section>

        <section class="programs py-5">
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm border-light rounded-3">
                            <div class="card-body">
                                <div class="icon mb-3">
                                    <img src="chapter.png" alt="เนื้อหาบทเรียน" class="img-fluid" style="width: 100px; height: 100px;">
                                </div>
                                <h3 class="card-title">เนื้อหาบทเรียน</h3>
                                <a href="testchapter.php"><button class="btn btn-primary">แสดงรายวิชา</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm border-light rounded-3">
                            <div class="card-body">
                                <div class="icon mb-3">
                                    <img src="exam.png" alt="แบบทดสอบ" class="img-fluid" style="width: 100px; height: 100px;">
                                </div>
                                <h3 class="card-title">แบบทดสอบหลังเรียน</h3>
                                <a href="testquiz.php"> <button class="btn btn-primary">แสดงรายวิชา</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm border-light rounded-3">
                            <div class="card-body">
                                <div class="icon mb-3">
                                    <img src="console.png" alt="เกมฝึกฝนทักษะ" class="img-fluid" style="width: 100px; height: 100px;">
                                </div>
                                <h3 class="card-title">เกมฝึกฝนทักษะ</h3>
                                <button class="btn btn-primary">แสดงรายวิชา</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <style>
            .card {
                transition: transform 0.3s, box-shadow 0.3s;
                /* การเปลี่ยนแปลงการเคลื่อนไหวและเงา */
            }

            .card:hover {
                transform: scale(1.05);
                /* ขยายขนาดเมื่อเมาส์ไปวาง */
                box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
                /* เงาเพิ่มขึ้น */
            }
        </style>

    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>