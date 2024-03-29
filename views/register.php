<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/register.css">
    <script type="text/javascript" src="../public/js/validation.js" defer></script>
    <title>Register</title>
</head>
<body>
    <div class="container">
        <div class="header-box">
            <p class="header">CREATE ACCOUNT</p>
            <div class="logo">
                <img src="../public/img/logo.svg" alt="Two people running">
            </div>
        </div>
        <div class="register-container">
            <form acton="register" id="register-form" class="register" method="POST" ENCTYPE="multipart/form-data">
                <div class="message">
                    <?php
                        if(isset($messages)) {
                            foreach($messages as $message) {
                                echo $message;
                            }
                        }
                    ?>
                </div>
                <input name="email" type="email" placeholder="Email" required>
                <input name="password" type="password" placeholder="Password" required>
                <input name="confirmedPassword" type="password" placeholder="Confirm Password" required>
                <input name="first-name" type="text" placeholder="First Name" required>
                <textarea name="bio" rows="5" cols="50" placeholder="Bio" maxlength="75" required></textarea>
                <label for="profile-photo">Profile photo</label>
                <input if="profile-photo" type="file" name="file" required>
                <select name="city">
                    <?php foreach($cities as $city): ?> 
                        <option value="<?= $city->getCityId(); ?>">
                            <?= $city->getName(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="sports-container">
                    <?php foreach($sports as $index => $sport): ?>
                        <label class="sport-label">
                            <input class="sport-input" 
                                type="checkbox" 
                                name="sports[]" 
                                value="<?= $sport->getSportId(); ?>"> <?= $sport->getName(); ?>
                        </label>
                    <?php endforeach; ?> 
                </div>
                <button type="submit">REGISTER</button>
            </form>
            <p class="login-text">Already have account? <a href="login">Sign in</a></p>
        </div>
    </div>
</body>
</html>