<!DOCTYPE html>

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="public/css/login.css">
    <title>Login</title>
    <link rel="shortcut icon" type="image/x-icon" href="public/img/small-logo.png" />
</head>

<body>
    <div class="container">
        <div class="left">
            <div class="logo">
                <a href="main" ><img src="public/img/logo.svg"></a>
            </div>
            <div class="welcome-message">
                Welcome  back!</br>
                Please login/Signup to your account.
            </div>
            <div class="login-container">

                <form class="login" action="login" method="POST">

                    <div class="messages">
                        <?php 
                        if(isset($messages)){
                            foreach($messages as $message)
                            {
                                echo $message;
                            }
                        }
                        ?>

                    </div>
                    <input name="email"  type="text" placeholder="Email Address"></br>
                    <input name="password" type="password" placeholder="Password"></br>
                    <input type="checkbox" id="remember-me" name="remember-me" value="Remember Me">
                    <label for="remember-me">Remember Me</label>
                    <a class="forgot-password" href="#">Forgot Password?</a></br>
                    <div class="log">
                    <button type="submit" class="login-button">Login</button>
                    <a href="register" class="sign-up-button">Sign up</a>
                    </div>
                </form>
                <div class="alt-login">
                    <div class="or-login-with">
                        Or login with
                    </div>
                    <div class="facebook">
                        <a href="#">Facebook</a>
                    </div>
                    <div class="google">
                        <a href="#">Google</a>
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