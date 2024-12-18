const descriptions = {
    sun: "เป็นดาวฤกษ์ซึ่งมีมวลร้อยละ 99ของระบบสุริยะจักรวาล",
    mercury: "เป็นดาวเคราะห์ที่มีขนาดเล็กที่สุดและอยู่ใกล้ดวงอาทิตย์ที่สุด",
    venus: "เป็นดาวเคราะห์ที่มีขนาดใกล้เคียงกับโลกมากที่สุด จึงได้รับการขนานนามว่าเป็น “ฝาแฝด” ของโลก",
    earth: "เป็นดาวเคราะห์มีโครงสร้างหลักสามชั้นได้แก่ เปลือกโลก แมนเทิล และแก่นโลก",
    mars: "เป็นดาวที่ได้รับการสำรวจมากที่สุด ได้รับฉายาว่า 'ดาวเคราะห์แดง'",
    jupiter: "เป็นดาวเคราะห์มีมวลมากที่สุด ขนาดใหญ่ที่สุด และมีแรงดึงดูดสูงสุด รวมถึงใช้เวลาน้อยที่สุดในการโคจรรอบตัวเอง",
    saturn: "เป็นดาวเคราะห์มีวงแหวนรอบนอกเจ็ดชั้นจากเศษหินและน้ำแข็ง มีดวงจันทร์บริวารมากกว่า 50 ดวง",
    uranus: "เป็นดาวเคราะห์มีไฮโดรเจนและฮีเลียมเป็นองค์ประกอบหลัก มีสีฟ้าน้ำเงินเนื่องจากมีเทน",
    neptune: "เป็นดาวเคราะห์ ได้รับแสงสว่างน้อยที่สุด มีลักษณะคล้ายดาวยูเรนัส และมีลมที่แรงที่สุดในระบบสุริยะ"
};

let availablePlanets = [...Object.keys(descriptions)];
let currentPlanet = '';
let score = 0;

function updateScoreDisplay() {
    document.getElementById('score').textContent = `คะแนน: ${score}`;
}

function generateQuestion() {
    if (availablePlanets.length === 0) {
        showPassMessage();  // แสดงข้อความ "ผ่าน" หากไม่มีคำถาม
        return;
    }

    const randomIndex = Math.floor(Math.random() * availablePlanets.length);
    currentPlanet = availablePlanets[randomIndex];
    availablePlanets.splice(randomIndex, 1);
    
    document.getElementById('description').textContent = descriptions[currentPlanet];
}

function showPassMessage() {
    document.getElementById('pass-message').style.display = 'block';
    document.getElementById('blur-background').style.display = 'block';
}

document.querySelectorAll('.planet-btn').forEach(button => {
    button.addEventListener('click', function() {
        const selectedPlanet = this.dataset.planet;
        if (selectedPlanet === currentPlanet) {
            score += 10;
            document.getElementById('result').textContent = 'ถูกต้อง! คุณเดาได้ถูกต้อง';
            updateScoreDisplay();
            generateQuestion();
        } else {
            document.getElementById('result').textContent = 'ผิด ลองอีกครั้ง!';
        }
    });
});
function resetGame() {
    score = 0;
    availablePlanets = [...Object.keys(descriptions)];
    document.getElementById('result').textContent = '';
    document.getElementById('pass-message').style.display = 'none';
    document.getElementById('blur-background').style.display = 'none';
    generateQuestion();
    updateScoreDisplay();
}


generateQuestion();
updateScoreDisplay();
