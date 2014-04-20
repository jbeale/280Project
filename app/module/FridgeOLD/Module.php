<?php

namespace Fridge;

use Fridge\Model\Fridge;
use Fridge\Model\FridgeTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;


 class Module
 {
     public function getAutoloaderConfig()
     {
         return array(
             'Zend\Loader\ClassMapAutoloader' => array(
                 __DIR__ . '/autoload_classmap.php',
             ),
             'Zend\Loader\StandardAutoloader' => array(
                 'namespaces' => array(
                     __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                 ),
             ),
         );
     }

     public function getConfig()
     {
         return include __DIR__ . '/config/module.config.php';
     }
 public function getServiceConfig()
     {
         return array(
             'factories' => array(
                 'Fridge\Model\FridgeTable' =>  function($sm) {
                     $tableGateway = $sm->get('FridgeTableGateway');
                     $table = new FridgeTable($tableGateway);
                     return $table;
                 },
                 'FridgeTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Fridge());
                     return new TableGateway('fridge_username', $dbAdapter, null, $resultSetPrototype);
                 },
             ),
         );
     }
 }

