<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Users\Util\LoginSessionDelegate;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    protected $vars = array();
    public function buildView() {
        return new ViewModel($this->vars);
    }
    public function pushVar($key, $value) {
        $this->vars[$key] = $value;
    }

    public function __construct() {
        $loginService = new LoginSessionDelegate();
        $this->pushVar("userInfo", $loginService->getCurrentUser());
        $this->layout()->setVariable("userInfo", $loginService->getCurrentUser());
    }

    public function indexAction()
    {
        //echo $this->vars['userInfo']->username;
        return $this->buildView();
    }

    public function testingAction()
    {
        return $this->buildView();
    }
}
