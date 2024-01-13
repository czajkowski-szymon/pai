<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/register.css">
    <title>Register</title>
</head>
<body>
    <div class="container">
        <div class="header-box">
            <p class="header">TRAINING BUDDY</p>
            <div class="logo">
                <img src="../public/img/logo.svg" alt="Two people running">
            </div>
        </div>
        <div class="register-container">
            <form class="register">
                <div class="messages">
                    <?php
                        if(isset($messages)) {
                            foreach($messages as $message) {
                                echo $message;
                            }
                        }
                    ?>
                </div>
                <input name="username" type="text" placeholder="Username" required>
                <input name="password" type="password" placeholder="Password" required>
                <input name="password" type="password" placeholder="Confirm Password" required>
                <input name="first-name" type="text" placeholder="First Name" required>
                <textarea name="bio" rows="2" cols="50" placeholder="Tell us about yourself"></textarea>
                <input type="file" name="file">
                <button type="submit">REGISTER</button>
            </form>
            <!-- <p class="register-text">Don`t you have account? <a href="#">Sign up</a></p> -->
        </div>
    </div>
</body>
</html>