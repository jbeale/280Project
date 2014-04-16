<?php

namespace Users\Controller;

use Users\Model\User;
use Users\Util\AuthenticationResult;
use Users\Util\LoginHandler;
use Users\Util\PasswordCryptographyProvider;
use Zend\Mvc\Controller\AbstractActionController;
use Users\Model\FacebookTable;
use Zend\View\Model\ViewModel;
use Facebook;

class FacebookController extends AbstractActionController
{
    protected $loginHandler;
    protected $facebookTable;

    protected $facebook;

    public function __construct() {
         $config = array(
            'appId' => '309223815892634',
            'secret' => '1e839317b386a08bd4dde801754ff641',
            'allowSignedRequest' => false // optional but should be set to false for non-canvas apps
        );
        $this->facebook = new Facebook($config);
    }

    public function authAction() {
        if (isset($_POST['token'])) {
            $user = null;
            try {
                $this->facebook->setAccessToken($_POST['token']);
                $user = $this->facebook->getUser();
            } catch (\FacebookApiException $e ) {
                //not a valid fb user?
            }

            $facebookID = $user->id;
            //look up token on Facebook
            $user = $this->facebook->getUser();

            //$res = $this->facebookTable->,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,r.................................................g
        }
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