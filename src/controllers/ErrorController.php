<?php

require_once 'AppController.php';

class ErrorController extends AppController {
    public function pageNotFound() {
        return $this->render("page-not-found");
    }
}
