<?php

namespace Recipe\Form;

 use Zend\Form\Form;

 class RecipeForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('recipe');

         $this->add(array(
             'name' => 'recID',
             'type' => 'Hidden',
         ));
         $this->add(array(
             'name' => 'recName',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Title',
             ),
         ));
         $this->add(array(
             'name' => 'ingred',
             'type' => 'TextArea',
             'attributes' => array(
               'class' => 'recipe',
               'placeholder' => 'Ingredient and amount',
             ),
             'options' => array(
                 'label' => 'ingred',
             ),
         ));
         $this->add(array(
             'name' => 'instruct',
             'type' => 'TextArea',
             'attributes' => array(
               'class' => 'recipe',
               'placeholder' => 'Please be as detailed as possible',
             ),
             'options' => array(
                 'label' => 'instruct',
             ),
         ));
//         $this->add(array(
//             'name' => 'prepTime',
//             'type' => 'Select',
//             'options' => array(
//                 'label' => 'Prep Time',
//                 'options' =>array(
//                     '1' => '1',
//                     '2' => '2',
//                     '3' => '3',
//                 ),
//             ),
//         ));
//         $this->add(array(
//             'name' => 'cookTime',
//             'type' => 'Select',
//             'options' => array(
//                 'label' => 'Prep Time',
//                 'options' =>array(
//                     '1' => '1',
//                     '2' => '2',
//                     '3' => '3',
//                 ),
//             ),
//         ));
         $this->add(array(
             'name' => 'prepTime',
             'type' => 'Text',
             'options' => array(
                 'label' => 'prepTime',
             ),
         ));
         $this->add(array(
             'name' => 'cookTime',
             'type' => 'Text',
             'options' => array(
                 'label' => 'CookTime',
             ),
         ));
         $this->add(array(
             'name' => 'difficulty',
             'type' => 'Select',
             'options' => array(
                 'label' => 'Difficulty',
                 'options' =>array(
                     '1' => '1',
                     '2' => '2',
                     '3' => '3',
                     '4' => '4',
                     '5' => '5',
                     '6' => '6',
                     '7' => '7',
                     '8' => '8',
                     '9' => '9',
                     '10' => '10',
                 ),
             ),
         ));
         $this->add(array(
             'name' => 'glutfree',
             'type' => 'CheckBox',
             'options' => array(
                 'label' => 'Gluten Free',
             ),
         ));
         $this->add(array(
             'name' => 'lowcarb',
             'type' => 'CheckBox',
             'options' => array(
                 'label' => 'Low Carb',
             ),
         ));
         $this->add(array(
             'name' => 'lowcal',
             'type' => 'CheckBox',
             'options' => array(
                 'label' => 'Low calorie',
             ),
         ));
         $this->add(array(
             'name' => 'veget',
             'type' => 'CheckBox',
             'options' => array(
                 'label' => 'Vegetarian',
             ),
         ));
         $this->add(array(
             'name' => 'carnivore',
             'type' => 'CheckBox',
             'options' => array(
                 'label' => 'Carnivore',
             ),
         ));
         $this->add(array(
             'name' => 'image',
             'type' => 'File',
             'options' => array(
                 'label' => 'File',
             ),
         ));
                 
//         $this->add(array(
//             'name' => 'artist',
//             'type' => 'Text',
//             'options' => array(
//                 'label' => 'Artist',
//             ),
//         ));
         $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Go',
                 'id' => 'submitbutton',
             ),
         ));
     }
 }
