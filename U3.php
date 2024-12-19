<?php
include_once('header.php');
include_once('nav.php');

// รับค่าจาก Session และ URL
$userId = $_SESSION['userid'];
$chapterId = 3; // ใช้ article_id เป็น chapter_id

// ตรวจสอบว่าผู้ใช้อ่านบทความแล้วหรือยัง
$sql = "SELECT is_read FROM user_article_status WHERE user_id = ? AND chapter_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $userId, $chapterId);
$stmt->execute();
$result = $stmt->get_result();
$status = $result->fetch_assoc();

// หากยังไม่ได้อ่านแสดง popup สวยงามและเปลี่ยนเส้นทาง
if (!$status || !$status['is_read']) {
    echo "
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'ไม่สามารถทำ Quiz ได้',
                text: 'กรุณาอ่านบทที่ 3 ให้เสร็จสิ้นก่อนเข้าสู่ Quiz',
                icon: 'warning',
                confirmButtonText: 'ไปที่บทความ',
                confirmButtonColor: '#3085d6',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'lesson3.html';
                }
            });
        });
    </script>";
    exit();
}

// ดึงคำถามจากฐานข้อมูล
$sql = "SELECT id, question_text, option_a, option_b, option_c, option_d 
        FROM quiz_questions 
        WHERE chapter_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $chapterId);
$stmt->execute();
$questions = $stmt->get_result();
?>

<form action="submit_quiz.php" method="POST" id="quizForm">
    <input type="hidden" name="chapter_id" value="<?= $chapterId; ?>">
    <?php while ($row = $questions->fetch_assoc()): ?>
        <div class='container me-3 question-block'>
            <br>
            <p><?= $row['question_text']; ?></p>
            <input type="radio" name="answer[<?= $row['id']; ?>]" value="A"> A. <?= $row['option_a']; ?><br>
            <input type="radio" name="answer[<?= $row['id']; ?>]" value="B"> B. <?= $row['option_b']; ?><br>
            <input type="radio" name="answer[<?= $row['id']; ?>]" value="C"> C. <?= $row['option_c']; ?><br>
            <input type="radio" name="answer[<?= $row['id']; ?>]" value="D"> D. <?= $row['option_d']; ?><br>
        </div>
    <?php endwhile; ?>
    <button type="submit">ส่งคำตอบ</button>
</form>

<script>
    document.getElementById('quizForm').addEventListener('submit', function (e) {
        const questionBlocks = document.querySelectorAll('.question-block');
        let allAnswered = true;

        questionBlocks.forEach(block => {
            const radios = block.querySelectorAll('input[type="radio"]');
            const isAnswered = Array.from(radios).some(radio => radio.checked);
            if (!isAnswered) {
                allAnswered = false;
            }
        });

        if (!allAnswered) {
            e.preventDefault(); // หยุดการส่งฟอร์ม
            Swal.fire({
                title: 'กรุณาตอบคำถามให้ครบทุกข้อ',
                icon: 'error',
                confirmButtonText: 'ตกลง',
                confirmButtonColor: '#d33',
            });
        }
    });
</script>
