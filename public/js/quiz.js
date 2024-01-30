const start_btn = document.querySelector(".start_btn button");
const quiz_box = document.querySelector(".quiz_box");
const quit_btn = document.querySelector(".quit");
const next_btn = document.querySelector("footer .next_btn");
const result_box = document.querySelector(".result_box");
const option_list = document.querySelector(".option_list");
const restart_quiz = result_box.querySelector(".buttons .restart");
const bottom_ques_counter = document.querySelector("footer .total_que");

let userScore = 0;
let totalQuestions;

start_btn.onclick = () => {

    const urlParams = new URLSearchParams(window.location.search);
    const quizId = urlParams.get('quiz_id');
    userScore = 0;

    if (quizId) {
        quiz_box.classList.add("activeQuiz");
        fetch(`/getQuestionsForQuiz/${quizId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text().then(text => {
                    console.log("Raw response:", text);
                    return text ? JSON.parse(text) : {};
                });
            })
            .then(data => {
                console.log("Otrzymane dane:", data);
                if (data) {
                    const questions = data;
                    totalQuestions = questions.length;
                    displayQuestions(questions);
                } else {
                    console.log("Brak danych w odpowiedzi");
                }
            })
            .catch(error => {
                console.error('Błąd podczas pobierania pytań:', error);
            });
    }
    else
    {
        console.error('Brak parametru quiz_id w URL');
    }
};

quit_btn.onclick = ()=> {
    quiz_box.classList.remove("activeQuiz");
    result_box.classList.remove("activeResult");
}

restart_quiz.onclick = () => {
    userScore = 0;
    let que_count = 0;

    result_box.classList.remove("activeResult");
    quiz_box.classList.add("activeQuiz");

    const urlParams = new URLSearchParams(window.location.search);
    const quizId = urlParams.get('quiz_id');

    if (quizId) {
        fetch(`/getQuestionsForQuiz/${quizId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data) {
                    const questions = data;
                    displayQuestions(questions);
                    next_btn.classList.add("show");
                } else {
                    console.log("Brak danych w odpowiedzi");
                }
            })
            .catch(error => {
                console.error('Błąd podczas pobierania pytań:', error);
            });
    } else {
        console.error('Brak parametru quiz_id w URL');
    }
};

function displayQuestions(questions) {

    const que_text = document.querySelector(".que_text");
    const option_list = document.querySelector(".option_list");
    showQuestion(questions, 0);

    const next_btn = document.querySelector("footer .next_btn");
    let que_count = 0;

    next_btn.onclick = () => {
        que_count++;
        showQuestion(questions, que_count);
        next_btn.classList.remove("show");
    };

    function showQuestion(questions, index) {

        if (index < questions.length) {
            const que_tag = '<span> Question - ' + (index + 1) + "<br> " + questions[index].question_text + '</span>';
            const option_tag = questions[index].answers.map((answer) =>
                `<div class="option" data-is-correct="${answer.is_correct}"><span>${answer.answer_text}</span></div>`
            ).join('');

            que_text.innerHTML = que_tag;
            option_list.innerHTML = option_tag
            option_list.querySelectorAll(".option").forEach(option => {
                option.addEventListener("click", handleOptionClick);
            });
            bottom_ques_counter.innerHTML = `<h4>Question ${index + 1} out of ${questions.length}</h4>`;
        } else {
            showResult();
        }
    }
    const options = option_list.querySelectorAll(".option");
    options.forEach((option, optionIndex) => {
        option.addEventListener("click", () => {
            if (questions[index].answers[optionIndex].is_correct) {
                console.log("Poprawna odpowiedź");
            } else {
                console.log("Błędna odpowiedź");
                showCorrectAnswer(questions[index].answers);
            }
        });
    });
}
function showCorrectAnswer(answers) {
    answers.forEach((answer, index) => {
        if (answer.is_correct) {
            const correctOption = option_list.children[index];
            correctOption.classList.add("correct");
            correctOption.insertAdjacentHTML("beforeend", tickIconTag);
        }
    });
}

let tickIconTag = '<div class="icon tick"><i class="fas fa-check"></i></div>';
let crossIconTag = '<div class="icon cross"><i class="fas fa-times"></i></div>';

function handleOptionClick() {
    const isCorrect = this.dataset.isCorrect === 'true';
    const options = option_list.querySelectorAll(".option");

    if (isCorrect) {
        this.classList.add("correct");
        this.insertAdjacentHTML("beforeend", tickIconTag);
        console.log("Poprawna odpowiedź!");
        userScore += 1;
    } else {
        this.classList.add("incorrect");
        this.insertAdjacentHTML("beforeend", crossIconTag);
        console.log("Niepoprawna odpowiedź!");

        options.forEach(option => {
            if (option.dataset.isCorrect === 'true') {
                option.classList.add("correct");
                option.insertAdjacentHTML("beforeend", tickIconTag);
            }
        });
    }

    options.forEach(option => {
        option.style.pointerEvents = "none";
    });
    next_btn.classList.add("show");
}

function showResult(){

    quiz_box.classList.remove("activeQuiz");
    result_box.classList.add("activeResult");
    const scoreText = result_box.querySelector(".score_text");
    let scoreTag = '<span>' + userScore  +' out of '+ totalQuestions + '</span>';
    scoreText.innerHTML = scoreTag;
}





