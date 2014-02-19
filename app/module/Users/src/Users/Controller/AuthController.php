<?php

namespace Users\Controller;

use Users\Model\User;
use Users\Util\AuthenticationResult;
use Users\Util\LoginHandler;
use Users\Util\PasswordCryptographyProvider;
use Zend\Mvc\Controller\AbstractActionController;
use Users\Model\UserTable;
use Zend\View\Model\ViewModel;

class AuthController extends AbstractActionController
{
    protected $loginHandler;
    protected $userTable;

    public function loginAction()
    {
        $this->loginHandler = new LoginHandler($this->getUserTable());
        $vars = array();
        if (isset($_POST['username']))
        {

            //try to login
            $loginResult = $this->loginHandler->login($_POST['username'], $_POST['password']);
            echo $loginResult;
            if ($loginResult != AuthenticationResult::SUCCESS) {
                $vars['error'] = true;
            }
        }
        $vars['loggedIn'] = $this->loginHandler->authenticated();


        return new ViewModel($vars);
    }
    public function logoutAction()
    {
        $this->loginHandler = new LoginHandler($this->getUserTable());
        $this->loginHandler->logout();
    }

    public function registerAction()
    {
        if (isset($_POST['username']))
        {
            echo "SUBMITTED";
            $user = new User();
            $user->username = $_POST['username'];
            $user->password = PasswordCryptographyProvider::EncryptPassword($_POST['password']);
            $user->email = $_POST['email'];
            $userTable = $this->getUserTable();
            $userTable->createUser($user);
        }

    }

    public function getUserTable()
    {
        if (!$this->userTable) {
            $sm = $this->getServiceLocator();
            $this->userTable = $sm->get('Users\Model\UserTable');
        }
        return $this->userTable;
    }
}