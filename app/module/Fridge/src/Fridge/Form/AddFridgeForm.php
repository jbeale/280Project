<?php

namespace Fridge\Form;

 use Zend\Form\Form;

 class AddFridgeForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('fridgeItem');

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
             'attributes' => array(
                 'id' => 'addItemName',
             ),
         ));
         $this->add(array(
             'name' => 'itemAmount',
             'type' => 'Text',
             'attributes' => array(
                 'size' => '6',
             ),
             'options' => array(
                 'label' => 'ItemAmount',
             ),
         ));
         $this->add(array(
           'name' => 'amountType',
           'type' => 'Select',
           'attributes' => array(
                 'id' => 'amountType',
             ),
           'options' => array(
               'label' => 'amountType',
               'options' => array(
                    'lbs' => 'lbs',
                    'units' => 'units',
                    'oz' => 'oz',
                    'gallons' => 'gallons',
               ),
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
                 'id' => 'submitAdd',
             ),
         ));
         
     }
 }
