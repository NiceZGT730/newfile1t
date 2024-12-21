<?php

include_once('header.php');

$user_id = $_SESSION['userid'];

// ตรวจสอบสถานะ pretest_done
$sql = "SELECT pretest_done FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// ถ้าผู้ใช้ทำ Pretest เสร็จแล้วให้ redirect ไปหน้า index.php
if ($user['pretest_done'] == true) {
    header('Location: testindex.php');  // เปลี่ยนไปหน้า index หรือหน้าอื่นที่คุณต้องการ
    exit();
}

$answers = $_POST['answer'];
$score = 0;

// คำนวณคะแนนจากคำตอบที่ได้รับ
foreach ($answers as $question_id => $user_answer) {
    $sql = "SELECT correct_option FROM quiz_questions WHERE id = $question_id AND chapter_id = 5"; 
    $result = $conn->query($sql);
    $correct_answer = $result->fetch_assoc()['correct_option'];
    if ($user_answer === $correct_answer) {
        $score++;
    }
}

// บันทึกคะแนน Pretest ลงในฐานข้อมูล
$sql = "INSERT INTO pretest_results (user_id, score) VALUES ($user_id, $score)";
$conn->query($sql);

// อัปเดตสถานะ pretest_done เป็น TRUE
$sql = "UPDATE users SET pretest_done = TRUE WHERE id = $user_id";
$conn->query($sql);

?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ผลคะแนน Pretest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        html,body{
            background-color: #f3f3f3;
        }
        .container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .score-card {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .score-card h2 {
            margin-bottom: 20px;
            font-size: 28px;
            color: #007bff;
        }
        .score-card p {
            font-size: 20px;
            margin-bottom: 30px;
        }
        .btn-home {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 12px 30px;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-home:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="score-card">
            <h2>ผลคะแนน Pretest</h2>
            <p>คุณทำ Pretest เสร็จสิ้นและได้คะแนน <?= $score; ?> จาก 30 คะแนน!</p>
            <a href="testindex.php" class="btn-home">กลับไปยังหน้าแรก</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
