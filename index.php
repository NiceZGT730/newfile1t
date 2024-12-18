<?php include_once('header.php'); ?>
<?php include_once('nav.php'); ?>

<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="font.css">

<?php
    // เรียกใช้ Database.php เพื่อสร้างการเชื่อมต่อฐานข้อมูล
    include_once('config/Database.php');
    $db = new Database();
    $db->getConnection();
?>

<!-- การจัดคอนเทนต์ของหน้าเว็บ -->
<div class="container align-items-center">
    <h1 class="display-4 mt-3">Regis E-learning Solar System</h1>
    
</div>


<br><br>

    <style>
    iframe {
            padding: 12px !important;
            border: none; /* ไม่มีขอบ */
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* ใส่เงาเบาๆ (ถ้าต้องการ) */
        }
    body {
        background-color: #E4E0E1 !important;
        font-family: "K2D", sans-serif;
    }

    </style>
    <center>
        <iframe src="test.html"  style="width: 850px; height: 500px;"></iframe>
    
        <br>
        <div class="container mt-5">
        <a href="signin.php" id="enterButton" class="btn-enter">
    <button type="button" class="btn btn-outline-danger" style="font-weight: bold;">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"></path>
        <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"></path>
        </svg>
        Enter to Website
    </button></div>
        </a>
</center>
    <div id="renderer-container" style="width: 400px; height: 400px;"></div>
    <script src="https://cdn.jsdelivr.net/npm/three@0.128.0"></script>

    

<script>
    // ฟังก์ชันจับการกด Enter
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') { // ตรวจสอบว่ากดปุ่ม Enter
            event.preventDefault(); // ป้องกันพฤติกรรมเริ่มต้น (optional)
            document.getElementById('enterButton').click(); // คลิกปุ่ม Enter to Website
        }
    });
</script>




<?php include_once('footer.php'); ?>
