<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link rel="stylesheet" href="../public/css/login.css">
    <title>Login page</title>
</head>
<body>
    <div class="container">
        <div class="header-box">
            <p class="header">TRAINING BUDDY</p>
            <div class="logo">
                <img src="../public/img/logo.svg" alt="Two people running">
            </div>
        </div>
        <div class="login-container">
            <form action="login" class="login" method="POST">
                <input name="username" type="username" placeholder="Username">
                <input name="password" type="password" placeholder="Password">
                <div class="message">
                    <?php
                        if(isset($messages)) {
                            foreach($messages as $message) {
                                echo $message;
                            }
                        }
                    ?>
                </div>
                <button type="submit">LOGIN</button>
            </form>
            <p class="register-text">Don`t you have account? <a href="register">Sign up</a></p>
        </div>
    </div>
</body>
</html>