<?php

namespace Users\Util;

use Zend\Session\Container;

class LoginSessionDelegate {
    private $sessionContainer;

    public function __construct () {
        $this->sessionContainer = new Container("login");
    }

    public function getCurrentUser() {
        if (!isset($this->sessionContainer->currentUser)) return null;
        return $this->sessionContainer->currentUser;
    }
}


