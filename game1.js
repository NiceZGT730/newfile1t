// JavaScript
let score = 0;

function allowDrop(event) {
    event.preventDefault();
}

function drag(event) {
    event.dataTransfer.setData("text", event.target.id);
}

function playSound(correct) {
    const sound = correct ? document.getElementById('correct-sound') : document.getElementById('wrong-sound');
    sound.play();
}

function drop(event, group) {
    event.preventDefault();
    const data = event.dataTransfer.getData("text");
    const planet = document.getElementById(data);

    if ((group === 'inner' && ['mercury', 'venus', 'earth', 'mars'].includes(data)) ||
        (group === 'outer' && ['jupiter', 'saturn', 'uranus', 'neptune'].includes(data))) {
        
        event.target.appendChild(planet);
        score += 10;
        updateScore();
        playSound(true); // เสียงถูกต้อง
    } else {
        playSound(false); // เสียงผิด
        alert('ผิดกลุ่ม! ลองใหม่อีกครั้ง');
    }
}

function updateScore() {
    document.getElementById('score').textContent = `คะแนน: ${score}`;
}
