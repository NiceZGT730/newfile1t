<?php include_once('header.php'); ?>





<?php

// เรียกใช้ Database.php เพื่อสร้างการเชื่อมต่อฐานข้อมูล

include_once('config/Database.php');

$db = new Database();

$db->getConnection();

?>





<?php include_once('footer.php'); ?>

<?php

$userId = $_SESSION['userid']; // ใช้ session ไอดีผู้ใช้
$chapter_id = 2; 

// บันทึกข้อมูลลงฐานข้อมูลทันทีเมื่อเข้าหน้านี้
$sql = "INSERT INTO user_article_status (user_id, chapter_id, is_read) 
        SELECT ?, ?, TRUE 
        FROM DUAL 
        WHERE NOT EXISTS (
            SELECT 1 FROM user_article_status WHERE user_id = ? AND chapter_id = ?
        )";
$stmt = $conn->prepare($sql);
$stmt->bind_param('iiii', $userId, $chapter_id, $userId, $chapter_id);
$stmt->execute();
?>










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
    <style>
        h2 {
            text-align: center;
        }

        .button {
            text-align: center;
            margin-top: 20px;
        }
        main{
            margin-top: 8%;
        }

        .content{
            padding: 25px;
        }
        #fireworks {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 999;
    pointer-events: none; /* เพื่อไม่ให้บังการคลิก */
}
.chnext{
    margin-left: 25px;
}
        
    </style>

</head>

<body>

    <header>

        <h1>จบเนื้อหา บทเรียนที่ 2 แล้วเย้ๆๆๆ!!!</h1>

        <p>เรื่อง ดาวเคราะห์ในระบบสุริยะ</p>

    </header>

    <main>
    <canvas id="fireworks"></canvas>
        <section class="content">

            <div class="text">

                <h2>เลือกเนื้อหาที่ต้องการในการเรียนรู้ ต่อ!!!</h2>

                <div class="button">
                    <span>
                        <a href="indexsun.php">ทำแบบฝึกหัดบทที่ 2</a>
                    </span>
                    <span class="chnext">
                        <a href="lesson3.html">ไปยังการเรียนรู้บทที่ 3 ต่อ</a>
                    </span>
                </div>

            </div>

        </section>

    </main>





    <!-- ปุ่มหน้าถัดไปและย้อนกลับ -->

    <!-- ปุ่มนำทาง -->

    <div class="home-button">

        <a href="welcome.php" class="nav-btn menu-btn">Home</a>

    </div>



    <!-- ปุ่มย้อนกลับและถัดไป -->

    <!-- <div class="nav-buttons">

        <a href="lesson1_2.php" class="nav-btn" title="ถัดไป">&#8594;</a>

    </div> -->



    <footer>

        <p>© 2024 บทเรียนระบบสุริยะ | สร้างด้วยความรักต่อจักรวาล</p>

    </footer>
    <script>
// ฟังก์ชันสร้างพลุ
window.onload = function () {
    const canvas = document.getElementById("fireworks");
    const ctx = canvas.getContext("2d");
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;

    const particles = [];
    function random(min, max) {
        return Math.random() * (max - min) + min;
    }

    class Particle {
        constructor(x, y, color) {
            this.x = x;
            this.y = y;
            this.color = color;
            this.radius = random(2, 4);
            this.speedX = random(-3, 3);
            this.speedY = random(-3, 3);
            this.alpha = 1;
            this.fade = random(0.005, 0.015); // ทำให้จางช้าลง
        }
        draw() {
            ctx.globalAlpha = this.alpha;
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
            ctx.fillStyle = this.color;
            ctx.fill();
        }
        update() {
            this.x += this.speedX;
            this.y += this.speedY;
            this.alpha -= this.fade;
        }
    }

    function createFirework(x, y) {
        const colors = ["#FF0000", "#00FF00", "#0000FF", "#FFFF00", "#FF00FF", "#00FFFF"];
        for (let i = 0; i < 50; i++) {
            particles.push(new Particle(x, y, colors[Math.floor(Math.random() * colors.length)]));
        }
    }

    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        particles.forEach((particle, index) => {
            if (particle.alpha <= 0) {
                particles.splice(index, 1);
            } else {
                particle.update();
                particle.draw();
            }
        });
        requestAnimationFrame(animate);
    }

    canvas.addEventListener("click", (e) => {
        createFirework(e.clientX, e.clientY);
    });

    // เริ่มแสดงพลุเมื่อเปิดหน้า
    createFirework(canvas.width / 2, canvas.height / 2);
    animate();
};
</script>




</body>


</html>

