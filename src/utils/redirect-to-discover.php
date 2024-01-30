<?php

$url = "http://$_SERVER[HTTP_HOST]";
header("Location: {$url}/discover");
return $this->render(
    'discover', [
        'users' => $this->userRepository->getUsersForDiscover(),
        'roleId' => $this->userRepository->getRole()
    ]
);