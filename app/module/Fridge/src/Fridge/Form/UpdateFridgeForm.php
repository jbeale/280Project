<?php

namespace Fridge\Form;

 use Zend\Form\Form;

 class UpdateFridgeForm extends Form
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
             'name' => 'userID',
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
             'name' => 'amountType',
             'type' => 'Text',
             'options' => array(
                 'label' => 'amountType',
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
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'update',
                 'id' => 'update',
                 'class' => 'btn btn-default',
                ),
             
         ));
         $this->add(array(
             'name' => 'submitPlus',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'plus',
                 'id' => 'plus',
                 'class' => 'btn btn-default',
                ),
             
         ));
         $this->add(array(
             'name' => 'submitMinus',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'minus',
                 'id' => 'minus',
                 'class' => 'btn btn-default',
             ),
         ));
         
         $this->add(array(
             'name' => 'submitRemove',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'remove',
                 'id' => 'remove',
                 'class' => 'btn btn-default',
             ),
         ));
     }
 }
