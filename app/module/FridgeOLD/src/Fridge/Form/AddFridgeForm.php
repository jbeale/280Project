<?php

namespace Fridge\Form;

 use Zend\Form\Form;

 class AddFridgeForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('fridge');

         $this->add(array(
             'name' => 'itemID',
             'type' => 'Hidden',
         ));
         $this->add(array(
             'name' => 'itemName',
             'type' => 'Text',
             'options' => array(
                 'label' => 'ItemName',
             ),
         ));
         $this->add(array(
             'name' => 'itemAmount',
             'type' => 'Text',
             'options' => array(
                 'label' => 'ItemAmount',
             ),
         ));
         $this->add(array(
             'name' => 'expireDate',
             'type' => 'Date',
             'options' => array(
                 'label' => 'ExpireDate',
             ),
         ));
         $this->add(array(
             'name' => 'submitAdd',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Add',
                 'id' => 'submitbutton',
             ),
         ));
         
     }
 }
