<?php

namespace exceptions;
use Exception;

class UserNotFoundException extends Exception {
    public function __construct() {
        parent::__construct('User does not exist');
   }
}