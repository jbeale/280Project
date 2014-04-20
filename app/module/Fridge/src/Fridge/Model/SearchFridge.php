<?php
 namespace Fridge\Model;

 // Add these import statements
 use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;

 class SearchFridge implements InputFilterAwareInterface
 {
     //public $itemID;
     public $userID;
     public $searchValue;
     //public $itemAmount;
     //public $amoutType;
     //public $expireDate;
     //public $userid;
     
     protected $inputFilter;                       // <-- Add this variable

     public function exchangeArray($data)
     {
       //  $this->itemID     = (isset($data['itemID']))     ? $data['itemID']     : null;
         $this->userID     = (isset($data['userID']))     ? $data['userID']     : null;
         $this->searchValue     = (isset($data['searchValue']))     ? $data['searchValue']     : null;
         //$this->itemAmount = (isset($data['itemAmount'])) ? $data['itemAmount'] : null;
         //$this->amountType = (isset($data['amountType'])) ? $data['amountType'] : null;
         //$this->expireDate     = (isset($data['expireDate']))     ? $data['expireDate']     : null;
     }
     
     public function getArrayCopy()
     {
         return get_object_vars($this);
     }

     // Add content to these methods:
     public function setInputFilter(InputFilterInterface $inputFilter)
     {
         throw new \Exception("Not used");
     }

     public function getInputFilter()
     {
         if (!$this->inputFilter) {
             $inputFilter = new InputFilter();
             
//             $inputFilter->add(array(
//                 'name'     => 'searchValue',
//                 'required' => true,
//                 'filters'  => array(
//                     array('name' => 'Int'),
//                 ),
//             ));
              
             $inputFilter->add(array(
                 'name'     => 'userID',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
             ));


             $inputFilter->add(array(
                 'name'     => 'searchValue',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 100,
                         ),
                     ),
                 ),
             ));
//             $inputFilter->add(array(
//                 'name'     => 'itemAmount',
//                 'required' => true,
//                 'filters'  => array(
//                     array('name' => 'Int'),
//                    ),
//
//             ));
//             $inputFilter->add(array(
//                 'name'     => 'amountType',
//                 'required' => true,
//                 'filters'  => array(
//                     array('name' => 'StripTags'),
//                     array('name' => 'StringTrim'),
//                 ),
//                 'validators' => array(
//                     array(
//                         'name'    => 'StringLength',
//                         'options' => array(
//                             'encoding' => 'UTF-8',
//                             'min'      => 1,
//                             'max'      => 100,
//                         ),
//                     ),
//                 ),
//             ));
////             
////              $inputFilter->add(array(
////                 'name'     => 'itemAmount',
////                 'required' => true,
////                 'filters'  => array(
////                     array('name' => 'Int'),
////                 ),
////             ));
//              
//               $inputFilter->add(array(
//                 'name'     => 'expireDate',
//                 'required' => true,
//                 'filters'  => array(
//                     array('name' => 'StripTags'),
//                     array('name' => 'StringTrim'),
//                 ),
//                 'validators' => array(
//                     array(
//                         'name'    => 'StringLength',
//                         'options' => array(
//                             'encoding' => 'UTF-8',
//                             'min'      => 1,
//                             'max'      => 100,
//                         ),
//                     ),
//                 ),
//             ));
//
////
             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     }
 }