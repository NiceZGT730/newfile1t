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

    <title>บทเรียนระบบสุริยะ</title>

    <link rel="stylesheet" href="lesson1.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=K2D:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&family=Mali:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">  

    <link rel="stylesheet" href="font.css">

</head>

<body>

    <header>

        <h1>บทเรียนที่ 1</h1>

        <p>เรื่อง เอกภพและระบบสุริยะ</p>

    </header>

    <main>

        <section class="content">

            <div class="text">

                <h2>ความหมายของระบบสุริยะ</h2>

                <p>

                    ระบบสุริยะ (Solar System) <br>คือระบบหนึ่งในจักรวาลที่มี ดวงอาทิตย์ เป็นศูนย์กลาง <br>และมีวัตถุท้องฟ้าต่าง ๆ โคจรรอบ 

                    ซึ่งประกอบไปด้วย <br>ดาวเคราะห์ ดาวเคราะห์แคระ ดาวเคราะห์น้อย ดาวหาง ดวงจันทร์ อุกกาบาต และฝุ่นอวกาศ 

                    ระบบสุริยะนี้เป็นส่วนสำคัญที่ทำให้โลกของเราสามารถดำรงชีวิตอยู่ได้ <br>โดยดวงอาทิตย์ทำหน้าที่เป็นแหล่งพลังงานหลักสำหรับทุกชีวิตบนโลก

                </p>

            </div>

            <div class="image">

                <img src="1.png" alt="ภาพระบบสุริยะ">

                <p class="caption">ภาพแสดงดาวเคราะห์ในระบบสุริยะ</p>

            </div>

        </section>

    </main>

  



  <!-- ปุ่มหน้าถัดไปและย้อนกลับ -->

  <!-- ปุ่มนำทาง -->

  <div class="home-button">

    <a href="welcome.php" class="nav-btn menu-btn">Home</a>

  </div>



<!-- ปุ่มย้อนกลับและถัดไป -->

  <div class="nav-buttons">

    <a href="lesson1_2.php" class="nav-btn" title="ถัดไป">&#8594;</a>

  </div>



    <footer>

        <p>© 2024 บทเรียนระบบสุริยะ | สร้างด้วยความรักต่อจักรวาล</p>

    </footer>

</body>

</html>

