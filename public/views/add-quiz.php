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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script type="text/javascript" src="/public/js/quiz.js" defer></script>
    <script type="text/javascript" src="/public/js/addQuestion.js" defer></script>
    <script type="text/javascript" src="/public/js/validateQuizForm.js" defer></script>
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
            <a href="dashboard"><i class="fas fa-home"></i>  Home</a></br></br>
            <a href="quizzes"><i class="fas fa-puzzle-piece"></i>  My Quizzes</a></br></br>
            <a href="discover"><i class="fas fa-compass"></i>  Discover</a></br></br>
            <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1): ?>
            <a href="adminPanel"><i class="fas fa-user-shield"></i>Admin Panel</a></br></br>
            <?php endif; ?>
            <a class="logout-button" href="/logout"><i class="fas fa-sign-out-alt"></i>  Log Out</a>
        </div>
    </div>
    <div class="right">
        <div class="board">
            AddQuiz
            <div class="separator"></div>
            <section class="project-form">
                <form action="validateQuiz" method="POST" ENCTYPE="multipart/form-data" onsubmit="return validateQuizForm()">
                    <div class="messages">
                        <?php
                        if(isset($messages)){
                            foreach($messages as $message) {
                                echo $message;
                            }
                        }
                        ?>
                    </div>
                    <div class="header">
                        <div class="quiz-header">
                            Quiz
                        </div>
                        <div class="template-header">
                            Questions
                        </div>
                    </div>
                    <div class="quiz">
                        <div class="template-container">

                            <input name="title" type="text" placeholder="title" value="<?php echo htmlspecialchars($formData['title'] ?? '') ?>">
                            <textarea name="description" rows=5 placeholder="description"><?php echo htmlspecialchars($formData['description'] ?? '') ?></textarea>

                            <input type="file" name="file"/><br/>
                        </div>
                        <div id="questions-container">
                            <div class="question">
                                <input name="questions[]" type="text" placeholder="Question 1">

                                <div class="answer">
                                    <input name="answers[]" type="text" placeholder="Answer">
                                    <input type="radio" name="correct_answer[0]" value="0">
                                </div>
                                <div class="answer">
                                    <input name="answers[]" type="text" placeholder="Answer">
                                    <input type="radio" name="correct_answer[0]" value="1">
                                </div>
                                <div class="answer">
                                    <input name="answers[]" type="text" placeholder="Answer">
                                    <input type="radio" name="correct_answer[0]" value="2">
                                </div>
                                <div class="answer">
                                    <input name="answers[]" type="text" placeholder="Answer">
                                    <input type="radio" name="correct_answer[0]" value="3">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-buttons">
                        <button type="submit">Send</button>
                        <button type="button" onclick="addQuestion()">Add question</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
</body>
