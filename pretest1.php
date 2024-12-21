<?php

include_once('header.php');

// ตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือไม่
if (!isset($_SESSION['userid'])) {
    header('Location: signin.php'); // ถ้ายังไม่ได้ login ให้ไปหน้า signin
    exit();
}

$user_id = $_SESSION['userid'];

// เชื่อมต่อฐานข้อมูล


// ตรวจสอบสถานะ pretest_done
$sql = "SELECT pretest_done FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user['pretest_done'] == true) {
    // ถ้าผู้ใช้ทำ Pretest เสร็จแล้วให้ redirect ไปหน้า welcome.php
    header('Location: testindex.php');
    exit();
}

// ดึงคำถาม Pretest (ใช้ chapter_id = 5 เป็นตัวระบุคำถาม Pretest)
$sql = "SELECT id, question_text, option_a, option_b, option_c, option_d FROM quiz_questions WHERE chapter_id = 5";
$result = $conn->query($sql);
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
        }

        .card:hover {
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
        }

        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .form-card {
            width: 100%;
            max-width: 600px;
            background-color: #fff;
        
            padding: 40px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-card h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-card p {
            margin-bottom: 10px;
        }

        .form-card input {
            margin-bottom: 10px;
        }

        .btn-submit {
            width: 100%;
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        /* ปรับแต่งสำหรับ Modal */
        .modal-content {
            padding: 20px;
        }

        .modal-header, .modal-footer {
            border: none;
        }
        h4{
            font-size: 20px;
        }
        .choice{
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <header class="bg-light py-3 border-bottom">
        <div class="container d-flex justify-content-start align-items-center">
            <div class="logo">
                <a href="#"><img src="logosolar.png" width="150px" alt="Logo" class="logo"></a>
            </div>
            
            <div class="language-login d-flex gap-3 align-items-center ms-auto">
                <?php if (isset($_SESSION['userid'])): ?>
                    <span class="username"><?= htmlspecialchars($_SESSION['username']); ?></span>
                    <a href="logout.php" class="logins btn btn-danger btn-sm">ออกจากระบบ</a>
                <?php else: ?>
                    <a href="testlogin.php" class="logins btn btn-primary btn-sm">เข้าสู่ระบบ</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <main class="form-container">
    <form action="submit_pretest.php" method="POST" onsubmit="return validateForm()">
        <div class="form-card">
            <h2>แบบทดสอบก่อนเรียน</h2>
            <input type="hidden" name="user_id" value="<?= $user_id; ?>">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="choice">
                    <h4><?= $row['question_text']; ?></h4>
                    <label>
                        <input type="radio" name="answer[<?= $row['id']; ?>]" value="A"> 
                        A. <?= $row['option_a']; ?>
                    </label><br>
                    <label>
                        <input type="radio" name="answer[<?= $row['id']; ?>]" value="B"> 
                        B. <?= $row['option_b']; ?>
                    </label><br>
                    <label>
                        <input type="radio" name="answer[<?= $row['id']; ?>]" value="C"> 
                        C. <?= $row['option_c']; ?>
                    </label><br>
                    <label>
                        <input type="radio" name="answer[<?= $row['id']; ?>]" value="D"> 
                        D. <?= $row['option_d']; ?>
                    </label><br>
                </div>
            <?php endwhile; ?>
            <button type="submit" class="btn-submit">ส่งคำตอบ</button>
        </div>
    </form>
</main>



    <!-- Modal -->
    <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="alertModalLabel">คำเตือน</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>โปรดทำให้เสร็จก่อน!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function validateForm() {
    var formValid = true;

    // ตรวจสอบทุกกลุ่มของคำถามที่อยู่ใน .choice
    var questions = document.querySelectorAll('.choice');
    
    questions.forEach(function(questionDiv) {
        var selected = false;
        
        // เช็คว่าแต่ละคำถามมีการเลือกคำตอบหรือไม่
        var radios = questionDiv.querySelectorAll('input[type="radio"]');
        radios.forEach(function(radio) {
            if (radio.checked) {
                selected = true; // ถ้ามีการเลือกคำตอบ
            }
        });

        if (!selected) {
            formValid = false; // ถ้าไม่มีการเลือกคำตอบ
        }
    });

    if (!formValid) {
        var myModal = new bootstrap.Modal(document.getElementById('alertModal'));
        myModal.show();
        return false;  // หยุดการส่งฟอร์ม
    }

    return true;  // ส่งฟอร์ม
}

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>