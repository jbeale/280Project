<?php

namespace Fridge\Form;

 use Zend\Form\Form;

 class SearchFridgeForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('searchFridge');

//         $this->add(array(
//             'name' => 'itemID',
//             'type' => 'Hidden',
//         ));
//         
//         
//         $this->add(array(
//             'name' => 'itemAmount',
//             'type' => 'Text',
//             'attributes' => array(
//                 'size' => '6',
//             ),
//             'options' => array(
//                 'label' => 'ItemAmount',
//             ),
//         ));
//         $this->add(array(
//           'name' => 'amountType',
//           'type' => 'Select',
//           'attributes' => array(
//                 'id' => 'amountType',
//             ),
//           'options' => array(
//               'label' => 'amountType',
//               'options' => array(
//                    'lbs' => 'lbs',
//                    'units' => 'units',
//                    'oz' => 'oz',
//                    'gallons' => 'gallons',
//               ),
//           ),
//         ));
//         $this->add(array(
//             'name' => 'expireDate',
//             'type' => 'Date',
//             'options' => array(
//                 'label' => 'ExpireDate',
//             ),
//         ));
//         
         $this->add(array(
             'name' => 'userID',
             'type' => 'Hidden',
         ));
         $this->add(array(
             'name' => 'searchValue',
             'type' => 'Text',
             'options' => array(
                 'label' => 'SearchValue',
             ),
         ));
         
         $this->add(array(
             'name' => 'submitSearch',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Search',
                 'id' => 'submitbutton',
             ),
         ));
         $this->add(array(
             'name' => 'submitAll',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Show All',
                 'id' => 'submitbutton',
             ),
         ));
     }
 }
