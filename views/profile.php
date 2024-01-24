<!DOCTYPE html>
<?php
    include('is-user-logged.php');
    header("Cache-Control: no-cache, no-store, must-revalidate");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/2310aedf41.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../public/js/logout.js" defer></script>
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
                    <ul>
                        <?php foreach($user->getSports() as $sport): ?>
                            <li> <?= $sport->getName(); ?> </li>
                        <?php endforeach; ?> 
                    </ul>
                </div>
            </section>
            <section class="training-panel">
                <div class="upcoming-trainings">
                    <p>Trainings</p>
                    <ul>
                        <?php foreach($trainings as $training): ?>
                            <li>
                                <div class="training-card"> 
                                    <?php
                                        $invitedUser = $training->getInvitedUser();
                                        $invitingUser = $training->getInvitingUser();
                                        $partnerUser = ($user->getUserId() === $invitedUser->getUserId()) ? $invitingUser : $invitedUser;
                                    ?>
                                    <div class="training-info">
                                        <p>Training with: <?= $partnerUser->getFirstName(); ?></p>
                                        <p>Date: <?= $training->getDate()->format('d-m-Y'); ?></p>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="invitations">
                    <p>Invitations</p>
                    <ul>
                        <?php foreach($invitations as $invitation): ?>
                            <li>
                                <div class="training-card">
                                    <?php
                                        $invitedUser = $invitation->getInvitedUser();
                                        $invitingUser = $invitation->getInvitingUser();
                                        $partnerUser = ($user->getUserId() === $invitedUser->getUserId()) ? $invitingUser : $invitedUser;
                                    ?>
                                    <div class="training-info">
                                        <p>Invitation from: <?= $partnerUser->getFirstName(); ?></p>
                                        <p>Date: <?= $invitation->getDate()->format('d-m-Y'); ?></p>
                                    </div>
                                    <form action="acceptInvite" method="POST">
                                        <input type="hidden" name="training-id" value="<?= $invitation->getTrainingId(); ?>">
                                        <button type="submit">
                                            <i class="fa-solid fa-check"></i>
                                        </button>
                                    </form>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
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