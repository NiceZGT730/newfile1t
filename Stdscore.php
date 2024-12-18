<?php include_once('header.php'); ?>
<?php include_once('nav.php'); ?>



<!-- การจัดคอนเทนต์ของหน้าเว็บ -->
<div class="container">
    
    <?php 

        if(!isset($_SESSION['userid'])){
            header('Location: signin.php');
        }
        
        include_once('config/Database.php');
        include_once('class/UserLogin.php');

        $connectDB = new Database();
        $db = $connectDB->getConnection();

        $users = new UserLogin($db);

        if(isset($_SESSION['userid'])){
            $userid = $_SESSION['userid'];
            $userData = $users->userData($userid);
        }
        $user_id = $_SESSION['userid'];
        $sql = "SELECT chapter_id, score FROM quiz_scores WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$chapters = [];
$sql_chapters = "SELECT DISTINCT chapter_id FROM quiz_questions"; // หรือเลือกจากตารางอื่นที่เก็บข้อมูลบท
$chapters_result = $conn->query($sql_chapters);

while ($row = $chapters_result->fetch_assoc()) {
    $chapters[] = $row['chapter_id'];
}

$user_scores = [];
while ($row = $result->fetch_assoc()) {
    $user_scores[$row['chapter_id']] = $row['score'];
}
    ?>

    <link rel="stylesheet" href="BG-1.css">
    <link rel="stylesheet" href="font.css">

    
    <style>
    body {
        background-color: #E4E0E1 !important;
        font-family: "K2D", sans-serif;
    }
    </style>


<div class='container'>
<?php
            // แสดงคะแนนสำหรับแต่ละบท
            foreach ($chapters as $chapter) {
                // ตรวจสอบว่าผู้ใช้มีคะแนนในบทนั้นหรือไม่
                $score = isset($user_scores[$chapter]) ? $user_scores[$chapter] : 0;
                echo "<tr>";
                echo "<td> บทที่ $chapter: </td>";
                echo "<td>$score/10 คะแนน</td>";
                echo "</tr>";
            }
            ?>

</div>