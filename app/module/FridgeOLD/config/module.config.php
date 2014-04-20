<?php
return array(
     'controllers' => array(
         'invokables' => array(
             'Fridge\Controller\Fridge' => 'Fridge\Controller\FridgeController',
         ),
     ),
    'router' => array(
         'routes' => array(
             'fridge' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/fridge[/][:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Fridge\Controller\Fridge',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),
     'view_manager' => array(
         'template_path_stack' => array(
             'fridge' => __DIR__ . '/../view',
         ),
     ),
 );

