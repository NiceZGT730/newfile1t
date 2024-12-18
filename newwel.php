<?php
include_once('header.php');
include_once('nav.php');
?>

<!-- Main Container -->
<div class="container">
    <!-- Contact Button -->
    <div style="position: fixed; bottom: 20px; right: 20px;">
        <a href="contact.php" class="btn btn-primary btn-lg rounded-circle">
            <i class="bi bi-envelope"></i>
        </a>
    </div>

    <!-- Page Header -->
    <div class="text-centermy-5">
        <h1 class="display-4">Welcome to Solar System E-Learning</h1>
        <p class="lead">Explore and learn about the wonders of the solar system!</p>
    </div>
    <div class="begin-text">
    เชิญชวนมาใช้
    <span class="dynamic-word" id="dynamic-word">
        บทเรียน e-learning รูปแบบใหม่
    </span>
        ทดลองใช้
    </div>


<!-- About Section -->
<div class="text-center my-5">
    <!-- Lesson Section -->
    <div class="row row-cols-1 row-cols-md-3 g-4 ">
        <?php
        $lessons = [
            ["title" => "Lesson 1", "description" => "Introduction to the Solar System", "link" => "Start.php", "image" => "./Lp1.png"],
            ["title" => "Lesson 2", "description" => "Planets and Their Characteristics", "link" => "lesson2.php", "image" => "./Lp2.png"],
            ["title" => "Lesson 3", "description" => "Moons, Asteroids, and Comets", "link" => "lesson3.php", "image" => "./Lp3.png"],
            ["title" => "Lesson 4", "description" => "Exploration of Space", "link" => "lesson4.php", "image" => "./Lp4.png"]
        ];

        foreach ($lessons as $lesson) {
            echo "<div class='col'>
                    <div class='card h-100 mt-5'>
                        <img src='{$lesson['image']}' class='card-img-top' alt='{$lesson['title']}'>
                        <div class='card-body'>
                            <h5 class='card-title'>{$lesson['title']}</h5>
                            <p class='card-text'>{$lesson['description']}</p>
                            <a href='{$lesson['link']}' class='btn btn-primary'>Start Lesson</a>
                        </div>
                    </div>
                </div>";
        }
        ?>
    </div>

    <!-- Category Section -->
    
        <h2>Category</h2>
        <div class="row row-cols-1 row-cols-md-2 g-4 mt-5">
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Lessons</h5>
                        <p class="card-text">Explore all the lessons to expand your knowledge.</p>
                        <a href="#" class="btn btn-success">View Lessons</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Quizzes</h5>
                        <p class="card-text">Test your understanding with our quizzes.</p>
                        <a href="#" class="btn btn-warning">Start Quizzes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php include_once('footer.php'); ?>

<style>
    body{
        text-align: center;
    }
    .begin-text, .ending-text {
    font-size: 20px;
    color: #333;
    }
    img{
        width: 100px;
        height: 250px;
    }

    .dynamic-word {
    font-size: 24px;
    font-weight: bold;
    color: #007bff;
    display: inline-block;
    opacity: 1;
    transition: opacity 1s ease;
    }

    /* เอฟเฟคที่ตัวหนังสือหายและขึ้นคำใหม่ */
    @keyframes fadeOutIn {
    0% {
        opacity: 1;
    }
    50% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
    }

    .dynamic-word.hidden {
    animation: fadeOutIn 3s infinite;
    }

</style>

<script>
    const words = [
    "เชิญมาสัมผัสกับบทเรียน E-learning รูปแบบใหม่ ที่จะเปิดโลกให้กับการเรียนรู้ของคุณ",
    "มาเริ่มต้นใช้งาน ระบบ E-learning ช่วยเพิ่มประสิทธิภาพการเรียน",
    "มาร่วมก้าวสู่เส้นทางการเรียนรู้ที่เต็มไปด้วยความรู้และความสนุกสำหรับคุณ"
    ];

let currentIndex = 0;
const dynamicWordElement = document.getElementById("dynamic-word");

function changeWord() {
  dynamicWordElement.classList.add("hidden");
  
  setTimeout(() => {
    dynamicWordElement.textContent = words[currentIndex];
    dynamicWordElement.classList.remove("hidden");
    
    currentIndex = (currentIndex + 1) % words.length;
  }, 1000); // Wait 1 second before changing the text
}

setInterval(changeWord, 3000); // Change text every 3 seconds

</script>