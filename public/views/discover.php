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
    <link rel="stylesheet" type="text/css" href="public/css/myquizzes.css">
    <script type="text/javascript" src="./public/js/searchDiscover.js" defer></script>
    <script type="text/javascript" src="./public/js/quiz.js" defer></script>
    <title>Discover</title>
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
                Discover
                <div class="separator"></div>
                    <header>
                        <div class="search-bar">
                            <input placeholder="search">
                        </div>
                    </header>
                    <section class="discoverProjects">
                        <?php foreach($quizzes as $quiz): ?>
                            <div id="<?= $quiz->getId(); ?>">
                                <a href="quiz?quiz_id=<?= $quiz->getId(); ?>">PLAY</a>
                                <img width="200px" height="200px" src="public/uploads/<?=$quiz->getImage() ?>">
                                <h2><?= $quiz->getTitle() ?></h2>
                                <p><?= $quiz->getDescription() ?></p>
                            </div>
                        <?php endforeach; ?>
                    </section>
            </div>
        </div>
    </div>
</body>

<template id="quiz-template">
    <div >
        <a href="quiz?quiz_id=<?= $quiz->getId(); ?>">PLAY</a>
        <img width="200px" height="200px" src="">
        <h2>title</h2>
        <p>description</p>
    </div>
</template>