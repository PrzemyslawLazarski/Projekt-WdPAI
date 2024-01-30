function addQuestion() {
    var container = document.getElementById("questions-container");
    var questionNumber = container.getElementsByClassName("question").length;
    var questionDiv = document.createElement("div");
    questionDiv.className = "question";
    var innerHTML = '<input name="questions[]" type="text" placeholder="Question ' + (questionNumber + 1) + '"><br>';

    for (var i = 0; i < 4; i++) {
        innerHTML += '<div class="answer"><input name="answers[]" type="text" placeholder="Answer"><input type="radio" name="correct_answer[' + questionNumber + ']" value="' + i + '"></div>';
    }

    questionDiv.innerHTML = innerHTML;
    container.appendChild(questionDiv);
}