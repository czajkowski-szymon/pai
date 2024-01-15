<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/discover.css">
    <script src="https://kit.fontawesome.com/2310aedf41.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../public/js/logout.js" defer></script>
    <title>Discover</title>
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
            <div class="search-panel">
                <form>
                    <input type="text" placeholder="City">
                </form>
            </div>
            <section class="profiles">
                <?php foreach($users as $user): ?> 
                    <div class="profile-card">
                        <div class="profile-picture">
                            <img src="../public/uploads/<?= $user->getPhotoUrl(); ?>" alt="">
                        </div>
                        <p class="name">
                            <?= $user->getFirstName(); ?>
                        </p>
                        <p class="profile-text">
                            <?= $user->getCity(); ?>
                        </p>
                        <p class="profile-text">
                            <?= $user->getBio(); ?>       
                        </p>
                        <button>CONTACT</button>
                    </div>     
                <?php endforeach; ?> 
            </section>
        </main>
        <footer>
            <div class="footer-search-panel">
                <a href="discover">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </a>
            </div>
            <div class="footer-search-panel">
                <a href="discover">
                    <i class="fa-solid fa-user"></i>
                </a>
            </div>
        </footer>
    </div>
</body>
</html>