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
    header('Location: welcome.php');
    exit();
}

// ดึงคำถาม Pretest (ใช้ chapter_id = 5 เป็นตัวระบุคำถาม Pretest)
$sql = "SELECT id, question_text, option_a, option_b, option_c, option_d FROM quiz_questions WHERE chapter_id = 5";
$result = $conn->query($sql);
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand px-3" href="#" onclick="showAlert(); return false;">
            <h2>Galaxy!</h2>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
            <ul class="navbar-nav">
                <?php if (isset($_SESSION['userid'])) { ?> 
                    <li class="nav-item">
                        <a class="btn btn-danger" href="logout.php">Log out</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item" style="margin-right: 10px;">
                        <a class="nav-link" href="signin.php">LogIn</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary" href="signup.php">Sign Up</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

<link rel="stylesheet" href="font.css">

<form action="submit_pretest.php" method="POST">
    <input type="hidden" name="user_id" value="<?= $user_id; ?>">
    <?php while ($row = $result->fetch_assoc()): ?>
        <div>
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
  function showAlert() {
    alert("โปรดทำให้เสร็จก่อน!");
  }
</script>
