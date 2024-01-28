<!DOCTYPE html>

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="public/css/register.css">
    <title>Register</title>
    <link rel="shortcut icon" type="image/x-icon" href="public/img/small-logo.png" />
    <script type="text/javascript" src="./public/js/validate.js" defer></script>
</head>

<body>
    <div class="container">
        <div class="left">
            <div class="logo">
                <a href="main" ><img src="public/img/logo.svg"></a>
            </div>
            <div class="welcome-message">
                Welcome!</br>
                Kindly fill in this form to register.
            </div>
            <div class="login-container">

                <form method="POST" action="/addUser" class="register">

                    <div class="messages">
                        <?php
                        if(isset($messages)){
                            foreach($messages as $message) {
                                echo $message;
                            }
                        }
                        ?>
                    </div>

                    <input name="nickname" type="text" placeholder="nickname">
                    <input name="email" type="text" placeholder="email@email.com">
                    <input name="password" type="password" placeholder="password">
                    <input name="confirmedPassword" type="password" placeholder="confirm password">

                    <div class="already-have"> Already have an account?<a href="login">Login</a></div>
                    <button type="submit" name='sign-up-button' id="sign-up-button">Sign up</button>
                </form>

                
            </div>
        </div>
        <div class="right">
            <div class="image">
                <img src="public/img/people2.svg">
            </div>
            <div class="go-back-button">
                <a href="main">Go back</a>
            </div>
            
        </div>
        
    </div>
</body>