const search = document.querySelector('input[placeholder="search quiz"]');
const quizContainer = document.querySelector(".projects");

search.addEventListener("keyup", function (event) {
    if (event.key === "Enter") {
        event.preventDefault();
        const data = {search: this.value};
        fetch("/search", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function (response) {
            return response.json();
        }).then(function (quizzes) {
            console.log(quizzes);
            quizContainer.innerHTML = "";
            loadQuizzes(quizzes)
        });
    }
});

function loadQuizzes(quizzes) {
    quizzes.forEach(quiz => {
        console.log(quiz);
        createQuiz(quiz);
    });
}

function createQuiz(quiz) {
    const template = document.querySelector("#quiz-template");
    const clone = template.content.cloneNode(true);
    const div = clone.querySelector("div");
    div.id = quiz.id;
    const image = clone.querySelector("img");
    image.src = `/public/uploads/${quiz.image}`;
    const title = clone.querySelector("h2");
    title.innerHTML = quiz.title;
    const description = clone.querySelector("p");
    description.innerHTML = quiz.description;

    quizContainer.appendChild(clone);
}
