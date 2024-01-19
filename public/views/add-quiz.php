<!DOCTYPE html>

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto:wght@500&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="public/css/addQuiz.css">
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
                <a href="profile">Profile</a></br>
                <a href="quizzes">My Quizzes</a></br>
                <a href="#">Discover</a></br>
                <a href="#">Statistics</a></br>
                <a href="login">Log Out</a>
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
                        <button type="submit">send</button>
                    </form>
                </section>
            </div>
           
        </div>
            
        
    </div>
</body>

