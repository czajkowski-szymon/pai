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
            <form acton="register" class="register" method="POST" ENCTYPE="multipart/form-data">
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
                <input name="first-name" type="text" placeholder="First Name" required>
                <textarea name="bio" rows="5" cols="50" placeholder="Bio"></textarea>
                <label for="profile-photo">Profile photo</label>
                <input if="profile-photo" type="file" name="file">
                <select name="city">
                    <?php foreach($cities as $city): ?> 
                        <option value="<?= $city->getCityId(); ?>">
                            <?= $city->getName(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">REGISTER</button>
            </form>
            <p class="login-text">Already have account? <a href="login">Sign in</a></p>
        </div>
    </div>
</body>
</html>