<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/profile.css">
    <title>Profile page</title>
</head>
<body>
    <div class="container">
        <nav>
            <p class="header">TRAINING BUDDY</p>
            <div class="link-panel">
                <a href="discover" class="discover-link">DISCOVER</a>
                <a href="profile" class="profile-link">PROFILE</a>
                <a href="login" onClick="deleteCookies()">LOGOUT</a>
            </div> 
        </nav>
        <main>
            <section class="profile-panel">
                <div class="profile-card">
                    <div class="profile-picture">
                        <?php 
                            if(isset($_COOKIE['username'])) {
                                $username = $_COOKIE['username'];
                                $userRepository = new UserRepository();
                                $user = $userRepository->getUserByUsername($username);
                            }
                        ?>
                        <img src="../public/uploads/<?= $user->getPhotoUrl(); ?>" alt="">
                    </div>
                    <p class="name">
                        <?= $user->getFirstName(); ?>
                    </p>
                    <p class="profile-text">
                        <?= $user->getCity()->getName(); ?>
                    </p>
                    <p class="profile-text">
                        <?= $user->getBio(); ?>
                    </p>
                </div>
            </section>
        </main>
    </div>
</body>
</html>