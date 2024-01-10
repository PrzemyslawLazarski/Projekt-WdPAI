<!DOCTYPE html>

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto:wght@500&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="public/css/myquizzes.css">
    <title>My Quizzes</title>
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
                <a href="profile">Profile</a></br>
                <a href="myquizzes">My Quizzes</a></br>
                <a href="#">Discover</a></br>
                <a href="#">Statistics</a></br>
                <a href="login">Log Out</a>
            </div>
            
        </div>
        <div class="right">
            <div class="board">
                My Quizzes
                <div class="separator"></div>
                <div class="Add">
                    <a href="addQuiz">Add</a>
                </div>
                <section class="projects">
                <div class="quizzes">
                    <img width="200px" src="public/uploads/<?=$quiz->getImage() ?>">
                    <h2><?= $quiz->getTitle() ?></h2>
                    <p><?= $quiz->getDescription() ?></p>
                </div>
                </section>
            </div>
           
        </div>
            
        
    </div>
</body>

