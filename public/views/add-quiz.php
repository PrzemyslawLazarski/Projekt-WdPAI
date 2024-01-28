<!DOCTYPE html>

<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    $url = "http://$_SERVER[HTTP_HOST]";
    header("Location: {$url}/login");
    return;
}
?>


<script>

    function addQuestion() {
        var container = document.getElementById("questions-container");
        var questionNumber = container.getElementsByClassName("question").length;
        var questionDiv = document.createElement("div");
        questionDiv.className = "question";
        var innerHTML = '<input name="questions[]" type="text" placeholder="Pytanie ' + (questionNumber + 1) + '"><br>';

        for (var i = 0; i < 4; i++) {
            innerHTML += '<input name="answers[]" type="text" placeholder="Odpowiedź"><input type="radio" name="correct_answer[' + questionNumber + ']" value="' + i + '"><br>';
        }

        questionDiv.innerHTML = innerHTML;
        container.appendChild(questionDiv);
    }

</script>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto:wght@500&display=swap" rel="stylesheet">
    <script type="text/javascript" src="/public/js/quiz.js" defer></script>
    <link rel="stylesheet" type="text/css" href="public/css/myquizzes.css">
    <title>AddQuiz</title>
    <link rel="shortcut icon" type="image/x-icon" href="public/img/small-logo.png" />
</head>

<body>
<div class="container">
    <div class="menu">
        <div class="logo">
            <a href="dashboard"><img src="public/img/logowhite.svg"></a>
        </div>
        <div class="links">
            <a href="dashboard">Home</a></br>
            <a href="quizzes">My Quizzes</a></br>
            <a href="discover">Discover</a></br>
            <a href="#">Statistics</a></br>
            <a href=/logout">Log Out</a>
        </div>

    </div>
    <div class="right">
        <div class="board">
            AddQuiz
            <div class="separator"></div>
            <section class="project-form">
                <form action="addQuiz" method="POST" ENCTYPE="multipart/form-data">
                    <div class="messages">
                        <?php
                        if(isset($messages)){
                            foreach($messages as $message) {
                                echo $message;
                            }
                        }
                        ?>
                    </div>
                    <input name="title" type="text" placeholder="title">
                    <textarea name="description" rows=5 placeholder="description"></textarea>
                    <input type="file" name="file"/><br/>

                    <div id="questions-container">
                        <h6>Pytania</h6>
                        <div class="question">
                            <input name="questions[]" type="text" placeholder="Pytanie 1">
                            <input name="answers[]" type="text" placeholder="Odpowiedź"><input type="radio" name="correct_answer[0]" value="0"><br>
                            <input name="answers[]" type="text" placeholder="Odpowiedź"><input type="radio" name="correct_answer[0]" value="1"><br>
                            <input name="answers[]" type="text" placeholder="Odpowiedź"><input type="radio" name="correct_answer[0]" value="2"><br>
                            <input name="answers[]" type="text" placeholder="Odpowiedź"><input type="radio" name="correct_answer[0]" value="3"><br>


                        </div>
                    </div>

                    <button type="button" onclick="addQuestion()">Dodaj pytanie</button>

                    <button type="submit">send</button>
                </form>
            </section>
        </div>

    </div>


</div>
</body>
