<?php

$userRepository = new UserRepository();
$roleId = $userRepository->getRole();

if ($roleId != Role::ADMIN) {
    $url = "http://$_SERVER[HTTP_HOST]";
    header("Location: {$url}/discover");
}