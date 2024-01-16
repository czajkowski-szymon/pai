<!DOCTYPE html>
<?php
    include('is-user-logged.php');
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/2310aedf41.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../public/css/profile.css">
    <title>Profile page</title>
</head>
<body>
    <div class="container">
        <nav>
            <p class="header">TRAINING BUDDY</p>
            <div class="link-panel">
                <a href="discover" class="discover-link">DISCOVER</a>
                <a href="profile" class="profile-link"><u>PROFILE</u></a>
                <?php
                    $userRepository = new UserRepository();
                    $roleId = $userRepository->getRole();
        
                    if ($roleId === 1) {
                        echo '<a href="adminpanel" class="adminpanel">ADMIN PANEL</a>';
                    }
                ?>
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
        <footer>
            <div class="footer-search-panel">
                <a href="discover">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </a>
            </div>
            <div class="footer-search-panel">
                <a href="profile">
                    <i class="fa-solid fa-user"></i>
                </a>
            </div>
            <div class="footer-search-panel">
                <a href="login" onClick="deleteCookies()">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </a>
            </div>
        </footer>
    </div>
</body>
</html>