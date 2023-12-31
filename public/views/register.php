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
                <form class="login">
                    <input id="username" name="username"  type="text" placeholder="Username"></br>
                    <input id="email" name="email"  type="text" placeholder="Email"></br>
                    <input id="password" name="password" type="password" placeholder="Create Password"></br>
                    <input id="confirm-password" name="password" type="password" placeholder="Confirm Password"></br>
                    <div class="already-have"> Already have an account?<a href="login">Login</a></div>
                    <button  id="sign-up-button">Sign up</button>
                </form>
                <div class="alt-login">
                    <div class="or-login-with">
                        Or login with
                    </div>
                    <div class="facebook">
                        <a href="main">Facebook</a>
                    </div>
                    <div class="google">
                        <a href="main">Google</a>
                    </div>
                    
                    
                </div>
                
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