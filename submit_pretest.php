

<?php

include_once('header.php');

$user_id = $_SESSION['userid'];
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

echo "คุณทำ Pretest เสร็จสิ้นและได้คะแนน $score จาก 30 คะแนน!";
?>

