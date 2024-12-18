// ฟังก์ชันแสดงเอฟเฟค
function showResultEffect(score) {
    const messageDiv = document.createElement('div');
    messageDiv.classList.add('message');

    if (score > 5) {
        messageDiv.textContent = `ยินดี! คุณได้คะแนนของคุณที่ ${score} คะแนน!`; // แสดงความยินดี
        messageDiv.style.color = 'green';
    } else {
        messageDiv.textContent = `เสียใจ! แต่คะเพยยและลองแล้วแก้ไขและเมือใหม่ (คะแนน: ${score})`; // แสดงความเสียใจ
        messageDiv.style.color = 'red';
    }

    document.body.appendChild(messageDiv);

    // ลบข้อความหลัง 5 วินาที
    setTimeout(() => {
        messageDiv.remove();
    }, 5000);
}

// ตัวอย่างการเรียกใช้งาน
// showResultEffect(7); // ลองปรับคะแนน
