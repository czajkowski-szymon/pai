<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/discover.css">
    <script src="https://kit.fontawesome.com/2310aedf41.js" crossorigin="anonymous"></script>
    <title>Discover</title>
</head>
<body>
    <div class="container">
        <nav>
            <p class="header">TRAINING BUDDY</p>
            <div class="link-panel">
                <a href="discover" class="discover-link">DISCOVER</a>
                <a href="#" class="profile-link">PROFILE</a>
            </div>
        </nav>
        <main>
            <div class="search-panel">
                <form>
                    <input type="text" placeholder="City">
                </form>
            </div>
            <section class="profiles">
                <!-- <div class="profile-card">
                    <div class="profile-picture">
                        <img src="../public/img/profilepic.jpg" alt="">
                    </div>
                    <p class="name">John</p>
                    <p class="profile-text">Cracow</p>
                    <p class="profile-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro, consequuntur.</p>
                    <button>CONTACT</button>
                </div> -->

                <?php foreach($users as $user): ?> 
                    <div class="profile-card">
                        <div class="profile-picture">
                            <img src="<?= $user->getPhotoUrl(); ?>" alt="">
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