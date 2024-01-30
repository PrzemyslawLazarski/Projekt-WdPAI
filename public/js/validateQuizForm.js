function validateQuizForm() {
    let title = document.querySelector('input[name="title"]').value;
    let description = document.querySelector('textarea[name="description"]').value;
    let image = document.querySelector('input[type="file"]').files.length;
    let questions = document.querySelectorAll('.question');
    let valid = true;
    let message = '';

    if (!title) {
        message += 'Please add a quiz title.\n';
        valid = false;
    }

    if (!description) {
        message += 'Please add a description for the quiz.\n';
        valid = false;
    }

    if (image === 0) {
        message += 'Please upload an image for the quiz.\n';
        valid = false;
    }

    questions.forEach((question, index) => {
        let questionText = question.querySelector('input[name="questions[]"]').value;
        let answers = question.querySelectorAll('input[name="answers[]"]');
        let correctAnswerChecked = question.querySelector('input[type="radio"]:checked');

        if (!questionText) {
            message += `Question ${index + 1} is empty.\n`;
            valid = false;
        }

        answers.forEach((answer, answerIndex) => {
            if (!answer.value) {
                message += `Answer ${answerIndex + 1} in question ${index + 1} is empty.\n`;
                valid = false;
            }
        });

        if (!correctAnswerChecked) {
            message += `No correct answer selected for question ${index + 1}.\n`;
            valid = false;
        }
    });

    if (!valid) {
        alert(message);
    }

    return valid;
}