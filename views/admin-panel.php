<!DOCTYPE html>
<?php
    include('is-admin.php');
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/2310aedf41.js" crossorigin="anonymous"></script>
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
                    $userRepository = new UserRepository();
                    $roleId = $userRepository->getRole();
        
                    if ($roleId === 1) {
                        echo '<a href="adminpanel" class="adminpanel"><u>ADMIN PANEL</u></a>';
                    }
                ?>
                <a href="login" onClick="deleteCookies()">LOGOUT</a>
            </div>
        </nav>
        <main>
            <table>
                <thead>
                    <tr>
                        <th>NAME</th>
                        <th>CITY</th>
                        <th>USERNAME</th>
                        <th>DELETE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($users as $user): ?> 
                        <tr>
                            <td><?= $user->getFirstName(); ?></td>
                            <td><?= $user->getCity(); ?></td>
                            <td><?= $user->getUsername(); ?></td>
                            <td>
                                <form method="POST" action="deleteUser">
                                    <input type="hidden" name="user_id" value="<?= $user->getUserId(); ?>">
                                    <button type="submit">DELETE</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
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