

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
.logins{
    background-color: #0D6eFD;
    border-color: #0D6eFD;
    padding: 10px 10px;

    color: #fff;
    border: 1;
}
.logins:hover{
    color: #fff;
    background-color: #0056b3;
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
    background-color: #007bff;
    border: none;
    padding: 8px 16px;
    border-radius: 4px;
    text-transform: uppercase;
    font-size: 14px;
}

.btn-primary:hover {
    background-color: #0056b3;
}
hr{
    margin-bottom: 40px;
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
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">หน้าหลัก</a>
                    </li> -->
                </ul>
            </nav>
            <div class="language-login d-flex gap-3 align-items-center ms-auto">
                
                <a href="testlogin.php" class="logins btn  btn-sm">เข้าสู่ระบบ</a>
            </div>
        </div>
    </header>
    

    <main class="container py-5">
        <h1 class="mb-4 text-center section-title">เนื้อหาบทเรียนทั้งหมด</h1>
        <hr>
        <div class="row">
            <!-- Card: บทเรียนที่ 1 -->
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm">
                    <img src="ch1.jpg" class="card-img-top" alt="บทเรียนที่ 1">
                    <div class="card-body">
                        <h5 class="card-title text-center">บทเรียนที่ 1</h5>
                        <p class="card-code text-center">SL01</p>
                        <p class="card-category text-center">เรื่อง เอกภพและระบบสุริยะ</p>
                        <p class="card-author text-center">สถาบันดาราศาสตร์แห่งชาติ</p>
                        <div class="card-rating text-center">
                            ⭐ 4.8
                        </div>
                        <div class="text-center mt-3">
                            <a href="Start.php" class="btn btn-primary">เริ่มเรียน</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card: บทเรียนที่ 2 -->
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm">
                    <img src="ch2.png" class="card-img-top" alt="บทเรียนที่ 2">
                    <div class="card-body">
                        <h5 class="card-title text-center">บทเรียนที่ 2</h5>
                        <p class="card-code text-center">SL02</p>
                        <p class="card-category text-center">เรื่อง ดาวเคราะห์ในระบบสุริยะ</p>
                        <p class="card-author text-center">สถาบันดาราศาสตร์แห่งชาติ</p>
                        <div class="card-rating text-center">
                            ⭐ 4.7
                        </div>
                        <div class="text-center mt-3">
                            <a href="lesson2.php" class="btn btn-primary">เริ่มเรียน</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card: บทเรียนที่ 3 -->
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm">
                    <img src="ch3.jpg" class="card-img-top" alt="บทเรียนที่ 3">
                    <div class="card-body">
                        <h5 class="card-title text-center">บทเรียนที่ 3</h5>
                        <p class="card-code text-center">SL03</p>
                        <p class="card-category text-center">เรื่อง พัฒนาการของแบบจำลองระบบสุริยะ</p>
                        <p class="card-author text-center">สถาบันดาราศาสตร์แห่งชาติ</p>
                        <div class="card-rating text-center">
                            ⭐ 4.6
                        </div>
                        <div class="text-center mt-3">
                            <a href="lesson3.php" class="btn btn-primary">เริ่มเรียน</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card: บทเรียนที่ 4 -->
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm">
                    <img src="ch4.jpg" class="card-img-top" alt="บทเรียนที่ 4">
                    <div class="card-body">
                        <h5 class="card-title text-center">บทเรียนที่ 4</h5>
                        <p class="card-code text-center">SL04</p>
                        <p class="card-category text-center">เรื่อง ปรากฏการณ์ต่างๆ</p>
                        <p class="card-author text-center">สถาบันดาราศาสตร์แห่งชาติ</p>
                        <div class="card-rating text-center">
                            ⭐ 4.9
                        </div>
                        <div class="text-center mt-3">
                            <a href="lesson4.php" class="btn btn-primary">เริ่มเรียน</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
