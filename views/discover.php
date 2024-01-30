<!DOCTYPE html>
<?php
    include('is-user-logged.php');
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
?>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/global.css">
    <link rel="stylesheet" href="../public/css/discover.css">
    <script src="https://kit.fontawesome.com/2310aedf41.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../public/js/logout.js" defer></script>
    <script type="text/javascript" src="../public/js/search.js" defer></script>
    <script type="text/javascript" src="../public/js/ratings.js" defer></script>
    <script type="text/javascript" src="../public/js/trainings.js" defer></script>
    <title>Discover</title>
</head>
<body>
    <div class="container">
        <nav>
            <p class="header">TRAINING BUDDY</p>
            <div class="link-panel">
                <a href="discover" class="discover-link"><u>DISCOVER</u></a>
                <a href="profile" class="profile-link">PROFILE</a>
                <?php   
                    if ($roleId === Role::ADMIN) {
                        echo '<a href="adminpanel" class="adminpanel">ADMIN PANEL</a>';
                    }
                ?>
                <a href="login" onClick="logout()">LOGOUT</a>
            </div>
        </nav>
        <main>
            <div class="discover-container">
                <div class="search-panel">
                    <input type="text" placeholder="City">
                </div>
                <section class="profiles">
                    <?php foreach($users as $user): ?> 
                        <div id="<?= $user->getUserId(); ?>" class="profile-card">
                            <div class="profile-picture">
                                <img src="../public/uploads/<?= $user->getPhotoUrl(); ?>" alt="">
                            </div>
                            <p class="name">
                                <?= $user->getFirstName(); ?>
                            </p>
                            <p class="profile-text">
                                <?= $user->getCity()->getName(); ?>
                            </p>
                            <div class="profile-text">
                                <?= $user->getBio(); ?>       
                            </div>
                            <ul>
                                <?php foreach($user->getSports() as $sport): ?>
                                    <li> <?= $sport->getName(); ?> </li>
                                <?php endforeach; ?> 
                            </ul>
                            <input class="date" type="date" name="training-date">
                            <input class="user-id" type="hidden" name="user-id" value="<?= $user->getUserId(); ?>">
                            <button class="invite-button">SEND</button>
                            <div class="ratings">
                                <i id="likes" class="fa-solid fa-thumbs-up"> <?= $user->getLikes(); ?></i>
                                <i id="dislikes" class="fa-solid fa-thumbs-down"> <?= $user->getDislikes(); ?></i>
                            </div>
                        </div>     
                    <?php endforeach; ?> 
                </section>
            </div>    
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
            <?php   
                if ($roleId === Role::ADMIN) {
                    echo '<div class="footer-search-panel">
                            <a href="adminpanel">
                                <i class="fa-solid fa-lock"></i>
                            </a>
                          </div>';
                }
            ?>
            <div class="footer-search-panel">
                <a href="login" onClick="logout()">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </a>
            </div>
        </footer>
    </div>
</body>
</html>

<template id="profile-template">
    <div class="profile-card">
        <div class="profile-picture">
            <img src="" alt="">
        </div>
        <p class="name"></p>
        <p class="profile-text" id="city"></p>
        <div class="profile-text" id="bio"></div>
        <ul></ul>
        <input class="date" type="date" name="training-date">
        <input class="user-id" type="hidden" name="user-id" value="<?= $user->getUserId(); ?>">
        <button class="invite-button">SEND</button>
        <div class="ratings">
            <i id="likes" class="fa-solid fa-thumbs-up"></i>
            <i id="dislikes" class="fa-solid fa-thumbs-down"></i>
        </div>
    </div>
</template>