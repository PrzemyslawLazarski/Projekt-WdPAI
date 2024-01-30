
const del = document.querySelector('input[placeholder="delete quiz"]');
del.addEventListener("keyup", function (event) {
    if (event.key === "Enter") {
        event.preventDefault();

        const quizTitle = this.value;
        const isConfirmed = confirm("Are you sure you want to delete quiz?");

        if (isConfirmed) {
            const data = { del: quizTitle };

            fetch("/delete", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                    } else {
                        location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    }
});

document.querySelectorAll('.delete').forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        const quizId = this.getAttribute('data-quiz-id');
        const isConfirmed = confirm("Are you sure you want to delete this quiz?");

        if (isConfirmed) {
            fetch(`/deleteById/${quizId}`, {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({quizId})
            }).then(function(response) {
                return response.json();
            }).then(function(data) {
                location.reload();

            }).catch(function(error) {
                console.error('Error:', error);
            });
        }
    });
});
