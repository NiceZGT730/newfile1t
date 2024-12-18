const events = [
    {
        image: './img/111.png', // Replace with actual image link
        question: 'นี่คือภาพของเหตุการณ์อะไร? 🌒',
        answers: ['สุริยุปราคา 🌞', 'จันทรุปราคา 🌕', 'โลกหมุนรอบตัวเอง🌍', 'น้ำขึ้นน้ำลง 💧'],
        correct: 2
    },
    {
        image: './img/222.png', // Replace with actual image link
        question: 'นี่คือภาพของเหตุการณ์อะไร? ❄️',
        answers: ['โลกหมุนรอบตัวเอง🌍', 'ฤดูหนาว 🌨️', 'การเกิดทิศทาง 🧭', 'ดาวตก 🌠'],
        correct: 0
    },
    {
        image: './img/333.png', // Replace with actual image link
        question: 'นี่คือภาพของเหตุการณ์อะไร? ❄️',
        answers: ['จันทรุปราคา 🌕', 'โลกโคจรรอบดวงอาทิตย์ ☀️', 'การเกิดทิศทาง 🧭', 'สุริยุปราคา 🌞'],
        correct: 1
    },
    {
        image: './img/444.png', // Replace with actual image link
        question: 'นี่คือภาพของเหตุการณ์อะไร? ❄️',
        answers: ['การขึ้นและตกของดวงอาทิตย์ ☀️', 'ข้างขึ้นข้างแรม 🌕', 'การเกิดทิศทาง 🧭', 'ดาวตก 🌠'],
        correct: 1
    },
    {
        image: './img/5.png', // Replace with actual image link
        question: 'นี่คือภาพของเหตุการณ์อะไร? ❄️',
        answers: ['น้ำขึ้นน้ำลง 💧', 'ฤดูหนาว 🌨️', 'โลกหมุนรอบตัวเอง🌍', 'สุริยุปราคา 🌞'],
        correct: 0
    },
    {
        image: './img/6.png', // Replace with actual image link
        question: 'นี่คือภาพของเหตุการณ์อะไร? ❄️',
        answers: ['สุริยุปราคา 🌞', 'จันทรุปราคา 🌕', 'การเกิดทิศทาง 🧭', 'ดาวตก 🌠'],
        correct: 0
    },
    {
        image: './img/7.png', // Replace with actual image link
        question: 'นี่คือภาพของเหตุการณ์อะไร? ❄️',
        answers: ['การขึ้นและตกของดวงอาทิตย์ ☀️', 'ฤดูหนาว 🌨️', 'สุริยุปราคา 🌞', 'จันทรุปราคา 🌕'],
        correct: 3
    }
];

let currentEventIndex = 0;
let score = 0;

const imageElement = document.getElementById('event-image');
const questionElement = document.getElementById('question');
const answerButtonsElement = document.getElementById('answer-buttons');
const scoreContainer = document.getElementById('score-container');

// ฟังก์ชันสุ่มคำตอบ
function shuffleAnswers(event) {
    const answers = [...event.answers];  // สร้างสำเนาของคำตอบ
    const correctAnswer = answers[event.correct];  // เก็บคำตอบที่ถูกต้องไว้
    for (let i = answers.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [answers[i], answers[j]] = [answers[j], answers[i]];  // สลับตำแหน่งคำตอบ
    }
    event.correct = answers.indexOf(correctAnswer);  // อัปเดตตำแหน่งคำตอบที่ถูกต้องใหม่
    return answers;
}

function startGame() {
    currentEventIndex = 0;
    score = 0;
    scoreContainer.innerText = `คะแนน: ${score}`;  // แสดงคะแนนเริ่มต้น
    showEvent();
}

function showEvent() {
    const currentEvent = events[currentEventIndex];
    imageElement.src = currentEvent.image;
    questionElement.innerText = currentEvent.question;

    const shuffledAnswers = shuffleAnswers(currentEvent);  // เรียกใช้ฟังก์ชันสุ่มคำตอบ
    answerButtonsElement.innerHTML = '';

    shuffledAnswers.forEach((answer, index) => {
        const button = document.createElement('button');
        button.innerText = answer;
        button.classList.add('btn');
        button.addEventListener('click', () => selectAnswer(index));
        answerButtonsElement.appendChild(button);
    });
}

function selectAnswer(index) {
    const currentEvent = events[currentEventIndex];
    if (index === currentEvent.correct) {
        score++;  // เพิ่มคะแนนถ้าตอบถูก
        scoreContainer.innerText = `คะแนน: ${score}`;  // อัปเดตคะแนน
        // ถ้าตอบถูกให้เลื่อนไปยังคำถามถัดไปทันที
        currentEventIndex++;
        if (currentEventIndex < events.length) {
            showEvent();  // แสดงคำถามถัดไป
        } else {
            showEndScreen();  // จบเกมถ้าถึงคำถามสุดท้าย
        }
    } else {
        // ถ้าตอบผิดไม่ทำอะไร
        alert("ตอบผิด! ลองใหม่อีกครั้ง");
    }
}

function showEndScreen() {
    questionElement.innerText = 'จบเกม! คะแนนของคุณคือ: ' + score + ' 🚀';
    answerButtonsElement.innerHTML = '';
}

startGame();