
<!DOCTYPE html>

<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    $url = "http://$_SERVER[HTTP_HOST]";
    header("Location: {$url}/login");
    return;
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="public/css/quiz.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="shortcut icon" type="image/x-icon" href="public/img/small-logo.png" />

    <script type="text/javascript" src="/public/js/questions.js" defer></script>
    <script type="text/javascript" src="/public/js/quiz.js" defer></script>
</head>
<body>
    <!-- start Quiz button -->
    <div class="start_btn"><button>Start Quiz</button></div>
    <div class="go-dashboard"><a href="quizzes">Go back to Quizzes</a></div>



    <!-- Quiz Box -->
    <div class="quiz_box">
        <header>
            <div class="title">Quiz Title</div>

        </header>
        <section>
            <div class="que_text">

            </div>
            <div class="option_list">

            </div>
        </section>


        <footer>
            <div class="total_que">

            </div>
            <div class="timer">
                <div class="time_left_txt">Time Left</div>
                <div class="timer_sec">15</div>
            </div>
            <button class="next_btn">Next</button>
        </footer>
    </div>

    <!-- Result Box -->
    <div class="result_box">
        <div class="icon">
            <img src="public/img/score.svg">
            <div class="complete_text">Your score:</div>
            <div class="score_text">

        </div>
        </div>
        
        <div class="buttons">
            <button class="restart">Replay Quiz</button>
            <button class="quit">Complete</button>
        </div>
    </div>



</body>
</html>