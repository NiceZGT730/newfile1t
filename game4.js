// เลือกองค์ประกอบจาก DOM
const scientists = document.querySelectorAll("#scientist-list li");
const imageSlots = document.querySelectorAll(".image-slot");
const result = document.getElementById("result");
const correctSound = document.getElementById("correct-sound");
const wrongSound = document.getElementById("wrong-sound");
const resetBtn = document.getElementById("reset-btn");

let draggedScientist = null;

// ฟังก์ชันสุ่มรายการนักวิทยาศาสตร์
function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]]; // สลับ
    }
    return array;
}

// ฟังก์ชันสุ่มนักวิทยาศาสตร์ในรายการ
function shuffleScientists() {
    const scientistsArray = Array.from(scientists); // แปลง NodeList เป็น Array
    const shuffledScientists = shuffleArray(scientistsArray);
    
    // ลบรายการนักวิทยาศาสตร์เก่าออก
    const scientistList = document.getElementById("scientist-list");
    scientistList.innerHTML = ""; 

    // แสดงรายการนักวิทยาศาสตร์ที่สุ่มแล้ว
    shuffledScientists.forEach(scientist => {
        scientistList.appendChild(scientist); // เพิ่มแต่ละนักวิทยาศาสตร์กลับเข้าไปในรายการ
    });
}

// เริ่มต้นการลากนักวิทยาศาสตร์
scientists.forEach(scientist => {
    scientist.addEventListener("dragstart", function () {
        draggedScientist = this;
        setTimeout(() => {
            this.style.display = "none"; // ซ่อนเมื่อเริ่มลาก
        }, 0);
    });

    scientist.addEventListener("dragend", function () {
        setTimeout(() => {
            draggedScientist.style.display = "block"; // แสดงอีกครั้งเมื่อเลิกลาก
            draggedScientist = null; // รีเซ็ตตัวแปร
        }, 0);
    });
});

// ปล่อยนักวิทยาศาสตร์ลงในช่องรูปภาพ
imageSlots.forEach(slot => {
    slot.addEventListener("dragover", function (e) {
        e.preventDefault(); // ป้องกันการกระทำเริ่มต้น
    });

    slot.addEventListener("drop", function () {
        if (draggedScientist) {
            // ตรวจสอบว่าตำแหน่งที่ปล่อยถูกต้องหรือไม่
            if (this.id === draggedScientist.id + "-img") {
                this.textContent = draggedScientist.textContent; // ตั้งค่าชื่อในช่อง
                this.style.backgroundColor = "#32CD32"; // เปลี่ยนพื้นหลังเป็นสีเขียว
                this.style.border = "2px solid #FFD700"; // เพิ่มขอบสีทอง
                correctSound.play(); // เล่นเสียงถูกต้อง
                draggedScientist.remove(); // ลบรายการนักวิทยาศาสตร์
                checkWin(); // ตรวจสอบว่าชนะหรือไม่
            } else {
                this.style.backgroundColor = "#FF6347"; // เปลี่ยนพื้นหลังเป็นสีแดง
                wrongSound.play(); // เล่นเสียงผิด
                setTimeout(() => {
                    this.style.backgroundColor = "rgba(0, 0, 50, 0.7)"; // กลับสู่สีปกติ
                    this.style.border = ""; // ลบขอบ
                }, 1000);
            }
        }
    });
});

// ตรวจสอบว่าผู้เล่นชนะหรือไม่
function checkWin() {
    if (document.querySelectorAll("#scientist-list li").length === 0) {
        result.textContent = "คุณชนะแล้ว!"; // แสดงข้อความชนะ
        result.style.color = "#FFD700"; // เปลี่ยนสีข้อความเป็นทอง
    }
}

// รีเซ็ตเกมเมื่อกดปุ่ม
resetBtn.addEventListener("click", () => {
    window.location.reload(); // โหลดหน้าใหม่เพื่อเริ่มเกมใหม่
});

// สร้างดาวตกในพื้นหลัง
function createStars() {
    const starCount = 100; // จำนวนดาว
    const body = document.body; // ใช้ body แทน .game-container

    for (let i = 0; i < starCount; i++) {
        const star = document.createElement('div');
        star.className = 'star'; // ตั้งชื่อตัวแปรดาว

        // ตั้งค่าตำแหน่งเริ่มต้น
        star.style.left = Math.random() * 100 + 'vw'; // ตำแหน่ง X แบบสุ่ม
        star.style.animationDuration = Math.random() * 3 + 2 + 's'; // ระยะเวลาในการตก
        star.style.animationDelay = Math.random() * 5 + 's'; // ความล่าช้าแบบสุ่ม
        
        // เพิ่มดาวไปที่ body
        body.appendChild(star);
    }
}

// เรียกใช้ฟังก์ชันสร้างดาว
createStars(); 

// เรียกใช้ฟังก์ชันสุ่มนักวิทยาศาสตร์เมื่อเริ่มเกม
shuffleScientists();
