<?php

$userRepository = new UserRepository();
$roleId = $userRepository->getRole();

if ($roleId != 1) {
    $url = "http://$_SERVER[HTTP_HOST]";
    header("Location: {$url}/login");
}