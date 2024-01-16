<?php

if (!isset($_COOKIE['username'])) {
    $url = "http://$_SERVER[HTTP_HOST]";
    header("Location: {$url}/login");
}