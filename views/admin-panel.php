<!DOCTYPE html>
<?php
    include('is-user-logged.php');
    include('is-admin.php');
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/2310aedf41.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../public/js/logout.js" defer></script>
    <link rel="stylesheet" href="../public/css/global.css">
    <link rel="stylesheet" href="../public/css/admin-panel.css"> 
    <title>Admin</title>
</head>
<body>
    <div class="container">
        <nav>
            <p class="header">TRAINING BUDDY</p>
            <div class="link-panel">
                <a href="discover" class="discover-link">DISCOVER</a>
                <a href="profile" class="profile-link">PROFILE</a>
                <?php
                    if ($roleId != null && $roleId === Role::ADMIN) {
                        echo '<a href="adminpanel" class="adminpanel"><u>ADMIN PANEL</u></a>';
                    }
                ?>
                <a href="login" onClick="logout()">LOGOUT</a>
            </div>
        </nav>
        <main>
            <ul>
                <?php foreach($users as $user): ?> 
                    <li>
                        <div class="profile-container">
                            <p>First Name: <?= $user->getFirstName(); ?></p>
                            <p>City: <?= $user->getCity()->getName(); ?></p>
                            <p>Email: <?= $user->getEmail(); ?></p>
                            <form action="deleteUser" method="POST">
                                <input type="hidden" name="user-id" value="<?= $user->getUserId(); ?>">
                                <button type="submit">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>  
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
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