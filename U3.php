<?php include_once('header.php'); ?>
<?php include_once('nav.php'); ?>

<?php
$chapter_id = 3;
$sql = "SELECT id, question_text, option_a, option_b, option_c, option_d FROM quiz_questions WHERE chapter_id = $chapter_id";
$result = $conn->query($sql);
?>

<form action="submit_quiz.php" method="POST">
    <input type="hidden" name="chapter_id" value="<?= $chapter_id; ?>">
    <?php while ($row = $result->fetch_assoc()): ?>
        
        <div class='container me-3'>
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
