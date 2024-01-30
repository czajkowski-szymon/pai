<!DOCTYPE html>
<?php
    include(__DIR__.'/../src/utils/is-user-logged.php');
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/2310aedf41.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../public/js/logout.js" defer></script>
    <link rel="stylesheet" href="../public/css/global.css">
    <link rel="stylesheet" href="../public/css/profile.css">
    <title>Your Profile</title>
</head>
<body>
    <div class="container">
        <nav>
            <p class="header">TRAINING BUDDY</p>
            <div class="link-panel">
                <a href="discover" class="discover-link">DISCOVER</a>
                <a href="profile" class="profile-link"><u>PROFILE</u></a>
                <?php
                    if ($roleId === Role::ADMIN) {
                        echo '<a href="adminpanel" class="adminpanel">ADMIN PANEL</a>';
                    }
                ?>
                <a href="login" onClick="logout()">LOGOUT</a>
            </div> 
        </nav>
        <main>
            <section class="profile-panel">
                <div class="profile-card">
                    <div class="profile-picture">
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
                    <div class="ratings">
                        <i id="likes" class="fa-solid fa-thumbs-up"> <?= $user->getLikes(); ?></i>
                        <i id="dislikes" class="fa-solid fa-thumbs-down"> <?= $user->getDislikes(); ?></i>
                    </div>
                </div>
            </section>
            <section class="training-panel">
                <div class="trainings">
                    <div class="training-header">Trainings</div>
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
                    <div class="training-header">Invitations</div>
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
                                    <form action="deleteInvite" method="POST">
                                        <input type="hidden" name="training-id" value="<?= $invitation->getTrainingId(); ?>">
                                        <button type="submit">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </form>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="sent-invites">
                    <div class="training-header">Sent Invitations</div>
                    <ul>
                        <?php foreach($invites as $invite): ?>
                            <li>
                                <div class="training-card">
                                    <?php
                                        $invitedUser = $invite->getInvitedUser();
                                        $invitingUser = $invite->getInvitingUser();
                                        $partnerUser = ($user->getUserId() === $invitedUser->getUserId()) ? $invitingUser : $invitedUser;
                                    ?>
                                    <div class="training-info">
                                        <p>Invite sent to: <?= $partnerUser->getFirstName(); ?></p>
                                        <p>Date: <?= $invite->getDate()->format('d-m-Y'); ?></p>
                                    </div>
                                    <form action="deleteInvite" method="POST">
                                        <input type="hidden" name="training-id" value="<?= $invite->getTrainingId(); ?>">
                                        <button type="submit">
                                            <i class="fa-solid fa-xmark"></i>
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