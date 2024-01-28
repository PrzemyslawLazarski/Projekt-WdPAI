<!DOCTYPE html>

<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    $url = "http://$_SERVER[HTTP_HOST]";
    header("Location: {$url}/login");
    return;
}
?>
<?php
// Krok 1: Importowanie i inicjalizacja
include_once __DIR__ .'/../../src/repository/QuizRepository.php';
$quizRepo = new QuizRepository();

// Krok 2: Pobieranie pytań dla określonego quizu
$quizId = 132; // Tutaj możesz ustawić stałe ID lub pobrać je z żądania, np. z $_GET['id']
$questions = $quizRepo->getQuestionsForQuiz($quizId);
?>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto:wght@500&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="public/css/myquizzes.css">
    <title>Dashboard</title>
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
                <a href="/logout">Log Out</a>
            </div>
            
        </div>
        <div class="board">
            Home
            <div class="separator"></div>
            <div class="hello-message">
                <?php
                session_start();

                require_once 'src/repository/UserRepository.php';
                $userRepository = new UserRepository();

                if (isset($_SESSION['user_id'])) {
                    $nickname = $userRepository->getNicknameById($_SESSION['user_id']);
                    echo "Hello ". $nickname."!";

                } else {
                    echo "Użytkownik niezalogowany.";
                }
                ?>
            </div>
<div>
    <?php foreach ($questions as $question):
            echo " pytanie: ".$question['question_text']." odp: ";
               foreach ($question['answers'] as $answer):
                     echo $answer['answer_text']." ";
                endforeach;


     endforeach; ?>
</div>

            <div class="session">
                <?php
                echo "Session of user with ID: ".($_SESSION['user_id']);
                ?>
            </div>
        </div>
            
        
    </div>
</body>

