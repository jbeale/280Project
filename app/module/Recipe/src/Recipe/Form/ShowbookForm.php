<?php

namespace Recipe\Form;

 use Zend\Form\Form;

 class ShowbookForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct();

         $this->add(array(
             'name' => 'submitBook',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Add to Cookbook',
                 'id' => 'submitbutton',
             ),
         ));
     }
 }
