const start_btn = document.querySelector(".start_btn button");
const quiz_box = document.querySelector(".quiz_box");
const result_box = document.querySelector(".result_box");
const option_list = document.querySelector(".option_list");
const timeText = document.querySelector(".timer .time_left_txt");
const timeCount = document.querySelector(".timer .timer_sec");


start_btn.onclick = () => {

    const urlParams = new URLSearchParams(window.location.search);
    const quizId = urlParams.get('quiz_id');


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
                    displayQuestions(questions);
                    next_btn.classList.add("show");
                    startTimer(15);
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

let timeValue =  15;
let que_count = 0;
let que_numb = 1;
let userScore = 0;
let counter;
let counterLine;
let widthValue = 0;

const next_btn = document.querySelector("footer .next_btn");
const bottom_ques_counter = document.querySelector("footer .total_que");

function displayQuestions(questions) {
    const que_text = document.querySelector(".que_text");
    const option_list = document.querySelector(".option_list");

    // Ustawienie pierwszego pytania
    showQuestion(questions, 0);

    const next_btn = document.querySelector("footer .next_btn");
    let que_count = 0;

    // Przypisanie funkcji obsługującej kliknięcie do przycisku "Next"
    next_btn.onclick = () => {
        que_count++;
        showQuestion(questions, que_count);
        queCounter(que_numb);
        clearInterval(counter); //clear counter
        clearInterval(counterLine); //clear counterLine
        startTimer(timeValue);

    };



    function showQuestion(questions, index) {

        if (index < questions.length) {
            const que_tag = '<span> Question - ' + (index + 1) + "<br> " + questions[index].question_text + '</span>';
            const option_tag = questions[index].answers.map((answer, answerIndex) =>
                '<div class="option"><span>' + answer.answer_text + '</span></div>'
            ).join('');

            que_text.innerHTML = que_tag;
            option_list.innerHTML = option_tag;
        } else {
            // Jeśli skończono wszystkie pytania, możesz tutaj obsłużyć koniec quizu
            console.log("Koniec quizu");
            alert("Koniec pytan");
        }
    }
}









