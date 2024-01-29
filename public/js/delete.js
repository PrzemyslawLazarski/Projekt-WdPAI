
const del = document.querySelector('input[placeholder="delete quiz"]');


del.addEventListener("keyup", function (event) {
    if (event.key === "Enter") {
        event.preventDefault();
        const isConfirmed = confirm("Are you sure you want to delete this quiz?");

        if (isConfirmed) {
            const data = {del: this.value};

            fetch("/delete", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            }).then(function (response) {
                return response.json();
            }).then(function (data) {


                location.reload();
            });
        }
    }
});


