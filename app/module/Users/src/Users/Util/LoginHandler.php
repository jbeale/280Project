<?php

namespace Users\Util;

use Users\Model\UserTable;
use Users\Model\User;
use Zend\Session\Container;

class LoginHandler implements AbstractLoginHandler
{
    private $userTable;
    private $sessionContainer;

    public function __construct(UserTable $usertable)
    {
        $this->userTable = $usertable;
        $this->sessionContainer = new Container("login");
    }

    public function login($username, $password)
    {
        $user = $this->userTable->findUser($username);
        if (PasswordCryptographyProvider::VerifyPassword($password, $user->password))
        {
            $this->setSession($user);
            return AuthenticationResult::SUCCESS;
        }
        return AuthenticationResult::INVALID_CREDENTIALS;
    }

    public function logout()
    {
        $this->sessionContainer->currentUser = null;
    }

    private function setSession(User $user)
    {
        $this->sessionContainer->currentUser = $user;
    }

    public function authenticated() {
        return $this->sessionContainer->currentUser != null;
    }
}

abstract class AuthenticationResult
{
    const SUCCESS = 0;
    const INVALID_CREDENTIALS = 1;
    const INACTIVE_ACCOUNT = 2;
    const BANNED = 3;
}