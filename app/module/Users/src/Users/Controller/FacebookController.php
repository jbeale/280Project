<?php

namespace Users\Controller;

use Users\Model\User;
use Users\Util\AuthenticationResult;
use Users\Util\LoginHandler;
use Users\Util\PasswordCryptographyProvider;
use Zend\Json\Json;
use Zend\Mvc\Controller\AbstractActionController;
use Users\Model\FacebookTable;
use Users\Model\UserTable;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use Facebook;

class FacebookController extends AbstractActionController
{
    protected $loginHandler;
    protected $facebookTable;
    protected $userTable;

    protected $facebook;

    public function __construct() {

        $config = array(
            'appId' => '309223815892634',
            'secret' => '1e839317b386a08bd4dde801754ff641',
            'allowSignedRequest' => false // optional but should be set to false for non-canvas apps
        );
        $this->facebook = new Facebook($config);

    }

    public function init() {
        $this->loginHandler = new LoginHandler($this->getUserTable());
        $this->getFacebookTable();
    }

    public function authAction() {
        $this->init();

        $status = "err";
        if (isset($_POST['token'])) {
            $this->facebook->setAccessToken($_POST['token']);
            $fbUser = $this->facebook->getUser();
            if ($fbUser) {
                try {
                    $fbUser = $this->facebook->api('/me');
                } catch (\FacebookApiException $e ) {
                    //not a valid fb user
                    $fbUser = null;
                }
            } else {
                die($_POST['token']);
            }
            $facebookID = $fbUser['id'];

            if ($facebookID == null) {
                return new JsonModel(array(
                    "status" => "invalid_token"
                ));
            }
            $userId = $this->facebookTable->getUserIdFromFacebookId($facebookID);
            if ($userId == null) {
                //no facebook link yet
                $status = "nolink";

            } else {
                //facebook link exists
                $this->loginHandler->loginWithId($userId);
                $status = "success";
            }

        }

        return new JsonModel(array(
            "status" => $status,
            "fbId" => $facebookID
        ));
    }

    public function getUserTable()
    {
        if (!$this->userTable) {
            $sm = $this->getServiceLocator();
            $this->userTable = $sm->get('Users\Model\UserTable');
        }
        return $this->userTable;
    }

    public function getFacebookTable()
    {
        if (!$this->facebookTable) {
            $sm = $this->getServiceLocator();
            $this->facebookTable = $sm->get('Users\Model\FacebookTable');
        }
        return $this->facebookTable;
    }
}