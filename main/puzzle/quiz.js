let questions = [
  { question: "Wat is een voordeel van windenergie?", answers: ["Het veroorzaakt luchtvervuiling", "Het is hernieuwbaar", "Het kost veel brandstof"], correct: 1 },
  { question: "Wat gebeurt er als het niet waait?", answers: ["De molen stopt", "De molen gaat sneller", "De molen gebruikt stroom"], correct: 0 },
  { question: "Wat wordt opgewekt door een windmolen?", answers: ["Gas", "Stroom", "Warmte"], correct: 1 },
  { question: "Wat zijn wieken?", answers: ["Een soort motor", "De draaiende bladen", "Een onderdeel van een batterij"], correct: 1 },
  { question: "Is windenergie schoon?", answers: ["Ja", "Nee", "Soms"], correct: 0 },
  { question: "Wat is de functie van de generator in een windmolen?", answers: ["Wind meten", "Elektriciteit opwekken", "De molen stilzetten"], correct: 1 },
  { question: "Waarvoor dient de tandwielkast in een windmolen?", answers: ["Snelheid verhogen", "Windrichting bepalen", "Stroom opslaan"], correct: 0 },
  { question: "Wat is de gondel van een windmolen?", answers: ["De basis", "Het huis bovenaan de toren", "Een wiek"], correct: 1 },
  { question: "Wat is de functie van de mast?", answers: ["Ondersteunen van de gondel", "Wind vangen", "Stroom opslaan"], correct: 0 },
  { question: "Wat doet de controller in een windmolen?", answers: ["Beheert de werking", "Verhoogt de snelheid", "Maakt geluid"], correct: 0 }
];

let currentQuestion = 0;
let score = 0;
let timer;
let unlockedParts = [];

const partsMap = {
  fundering: 0,
  mast: 1,
  gondel: 2,
  rotor: 3,
  wiek1: 4,
  wiek2: 5,
  wiek3: 6,
  aandrijfas: 7,
  tandwielkast: 8,
  generator: 9
};

function startQuiz() {
  document.getElementById('startScreen').style.display = 'none';
  document.getElementById('quiz').style.display = 'block';
  showQuestion();
  startTimer();
}

function showQuestion() {
  const q = questions[currentQuestion];
  document.getElementById('questionText').innerText = q.question;
  const answersDiv = document.getElementById('answers');
  answersDiv.innerHTML = '';

  q.answers.forEach((answer, index) => {
    const btn = document.createElement('button');
    btn.className = 'btn';
    btn.innerText = answer;
    btn.onclick = () => checkAnswer(index);
    answersDiv.appendChild(btn);
  });
}

function checkAnswer(index) {
  const q = questions[currentQuestion];
  if (index === q.correct) {
    score++;
    const partId = Object.keys(partsMap)[score - 1];
    unlockedParts.push(partId);
    enablePart(partId);
  }

  currentQuestion++;
  if (currentQuestion < questions.length) {
    showQuestion();
  } else {
    endQuiz();
  }
}

function startTimer() {
  let timeLeft = 60;
  timer = setInterval(() => {
    document.getElementById('timer').innerText = 'Tijd: ' + timeLeft;
    timeLeft--;
    if (timeLeft < 0) {
      clearInterval(timer);
      endQuiz();
    }
  }, 1000);
}

function endQuiz() {
  clearInterval(timer);
  document.getElementById('quiz').style.display = 'none';
  document.getElementById('puzzle').style.display = 'block';
}

function validateScore() {
    if (score >= 3) {
        endQuiz()
    }
}
function enablePart(id) {
  const part = document.getElementById(id);
  if (part) {
    part.style.opacity = 1;
    part.style.pointerEvents = 'auto';
  }
}

const dragItems = document.querySelectorAll('.drag-item');
const dropZones = document.querySelectorAll('.drop-zone');

dragItems.forEach(item => {
  item.addEventListener('dragstart', e => {
    e.dataTransfer.setData('text/plain', e.target.id);
  });
});

dropZones.forEach(zone => {
  zone.addEventListener('dragover', e => {
    e.preventDefault();
  });
  zone.addEventListener('drop', e => {
    e.preventDefault();
    const partId = e.dataTransfer.getData('text/plain');
    if (e.target.dataset.correct === partId) {
      e.target.classList.add('correct');
      const part = document.getElementById(partId);
      part.style.opacity = 1;
      part.style.pointerEvents = 'none';
      e.target.appendChild(part);
    }
  });
});

function checkPuzzle() {
  const totalParts = Object.keys(partsMap).length;
  const correct = document.querySelectorAll('.drop-zone.correct').length;
  if (correct === totalParts) {
    document.getElementById('puzzle').style.display = 'none';
    document.getElementById('endScreen').style.display = 'block';
  } else {
    alert('Nog niet alle onderdelen zitten op de juiste plek!');
  }
}