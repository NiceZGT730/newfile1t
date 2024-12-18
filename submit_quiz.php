<?php
include_once('header.php');

$user_id = $_SESSION['userid'];
$chapter_id = $_POST['chapter_id'];
$answers = $_POST['answer'];
$score = 0;

// คำนวณคะแนนจากคำตอบ
foreach ($answers as $question_id => $user_answer) {
    $sql = "SELECT correct_option FROM quiz_questions WHERE id = $question_id";
    $result = $conn->query($sql);
    $correct_answer = $result->fetch_assoc()['correct_option'];
    if ($user_answer === $correct_answer) {
        $score++;
    }
}

// ตรวจสอบและคะแนนในภานถ้อมูล
$sql = "SELECT score FROM quiz_scores WHERE user_id = $user_id AND chapter_id = $chapter_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $existing_score = $result->fetch_assoc()['score'];

    // เปรียบเทียบคะแนนใหม่กับคะแนนเดิม
    if ($score > $existing_score) {
        // อัปเดตคะแนนในภานถ้อมูล
        $sql = "UPDATE quiz_scores SET score = $score WHERE user_id = $user_id AND chapter_id = $chapter_id";
        $conn->query($sql);
        $message = "<strong>คุณได้คะแนนล่าสุด $score จาก 10 และคะแนนของคุณถูกอัปเดต!</strong>";
    } else {
        $message = "<strong>คุณได้คะแนนล่าสุด $score จาก 10 และคะแนนเดิมของคุณคือ $existing_score คะแนน!</strong>";
    }
} else {
    // ถ้าไม่มีคะแนนในภานถ้อมูล ให้เพิ่มเข้าไป
    $sql = "INSERT INTO quiz_scores (user_id, chapter_id, score) VALUES ($user_id, $chapter_id, $score)";
    $conn->query($sql);
    $message = "<strong>คุณได้คะแนนล่าสุด $score จาก 10!</strong>";
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แสดงคะแนน</title>
    <style>
        body {
            font-family: "K2D", sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .score-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .score-table th, .score-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        .score-table th {
            background-color: #f9f9f9;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px 0;
            text-decoration: none;
            color: #fff;
            background-color: #007BFF;
            border-radius: 5px;
            text-align: center;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .container{
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>แสดงคะแนนของคุณ</h2>
    <table class="score-table">
        <tr>
            <th>บทเรียนที่</th>
            <th>แคนนเดิม</th>
            <th>แคนนใหม่</th>
        </tr>
        <tr>
            <td><?php echo $chapter_id; ?></td>
            <td><?php echo isset($existing_score) ? $existing_score : '-'; ?></td>
            <td><?php echo $score; ?></td>
        </tr>
    </table>
    <p><?php echo $message; ?></p>
    <a href="u1.php" class="btn">กลับไปทำแบบทดสอบใหม่</a>
    <a href="welcome.php" class="btn">กลับไปหน้าหลัก</a>
</div>
</body>
</html>
