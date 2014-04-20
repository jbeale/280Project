<?php
 namespace Recipe\Model;

 // Add these import statements
 use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;

 class RecipeAdd implements InputFilterAwareInterface
 {
     public $recID;
     
     
     protected $inputFilter;                       // <-- Add this variable

     public function exchangeArray($data)
     {
         $this->recID     = (isset($data['recID']))     ? $data['recID']     : null;
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
             
             $inputFilter->add(array(
                 'name'     => 'recID',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
             ));
         $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     }
 }