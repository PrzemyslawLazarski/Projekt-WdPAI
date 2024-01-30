
const searchDiscover = document.querySelector('input[placeholder="search"]');

const quizContainerDiscover = document.querySelector(".discoverProjects");



searchDiscover.addEventListener("keyup", function (event) {
    if (event.key === "Enter") {
        event.preventDefault();
        const data = {searchDiscover: this.value};
        fetch("/searchDiscover", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function (response) {
            return response.json();
        }).then(function (quizzes) {
            console.log(quizzes);
            quizContainerDiscover.innerHTML = "";
            loadQuizzesDiscover(quizzes)
        });
    }
});


function loadQuizzesDiscover(quizzes) {
    quizzes.forEach(quiz => {
        console.log(quiz);
        createQuizDiscover(quiz);
    });
}
function createQuizDiscover(quiz) {
    console.log(document.querySelector("#quiz-template"));
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

    quizContainerDiscover.appendChild(clone);


}
