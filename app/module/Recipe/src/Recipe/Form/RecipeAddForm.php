<?php

namespace Recipe\Form;

 use Zend\Form\Form;

 class RecipeAddForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('recipeAdd');

         $this->add(array(
             'name' => 'recID',
             'type' => 'Hidden',
         ));
         
         
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
