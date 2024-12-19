<?php include_once('header.php'); ?>


<?php
    // เรียกใช้ Database.php เพื่อสร้างการเชื่อมต่อฐานข้อมูล
    include_once('config/Database.php');
    $db = new Database();
    $db->getConnection();
?>


<?php include_once('footer.php'); ?>




<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>โลกแห่งการแยกดาว</title>
    <link rel="stylesheet" href="game1.css">
    <link rel="stylesheet" href="font.css">
    <style>
    body {
        font-family: "K2D", sans-serif;
    }

    </style>
</head>
<body>
    <header></header>
    <img src="game1/Game1header (2).png" alt="เกมแยกดาวเคราะห์" />
    </header>
    <div class="wrapper">
        <div class="game-container">
            <div id="planets" class="planets-container">
                <p>ลากดาวเคราะห์ไปยังกลุ่มที่ถูกต้อง</p>
                <img id="mercury" class="planet" src="game1/Mercury.png" alt="Mercury" draggable="true" ondragstart="drag(event)">
                <img id="venus" class="planet" src="game1/venus.png" alt="Venus" draggable="true" ondragstart="drag(event)">
                <img id="earth" class="planet" src="game1/earth.png" alt="Earth" draggable="true" ondragstart="drag(event)">
                <img id="mars" class="planet" src="game1/mars.png" draggable="true" ondragstart="drag(event)">
                <img id="jupiter" class="planet" src="game1/jupiter.png" draggable="true" ondragstart="drag(event)">
                <img id="saturn" class="planet" src="game1/saturn.png" alt="Saturn" draggable="true" ondragstart="drag(event)">
                <img id="uranus" class="planet" src="game1/uranus.png" alt="Uranus" draggable="true" ondragstart="drag(event)">
                <img id="neptune" class="planet" src="game1/neptune.png" alt="Neptune" draggable="true" ondragstart="drag(event)">
            </div>

            <div class="dropzone-container">
                <div id="inner" class="dropzone" ondrop="drop(event, 'inner')" ondragover="allowDrop(event)">
                    <h2>ดาวเคราะห์ชั้นใน</h2>
                </div>
                <div id="outer" class="dropzone" ondrop="drop(event, 'outer')" ondragover="allowDrop(event)">
                    <h2>ดาวเคราะห์ชั้นนอก</h2>
                </div>
            </div>
        </div>
        <div id="score">คะแนน: 0</div>
    </div>
    <div class="home-button">
        <a href="Start.php" class="nav-btn menu-btn">Home</a>
    </div>
    
    <!-- ปุ่มย้อนกลับและถัดไป -->
    <div class="nav-buttons">
        <a href="lesson1_3.php" class="nav-btn" title="ย้อนกลับ">&#8592;</a>
        <a href="endof1.php" class="nav-btn" title="ถัดไป">&#8594;</a>
    </div>
    <audio id="correct-sound" src="game1/correct.mp3"></audio>
    <audio id="wrong-sound" src="game1/wrong.mp3"></audio>    
    <script src="game1.js"></script>
</body>
</html>
