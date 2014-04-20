<?php
 namespace Recipe\Model;

 // Add these import statements
 use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;

 class Recipe implements InputFilterAwareInterface
 {
     public $recID;
     public $recName;
     public $prepTime;
     public $cookTime;
     public $image;
     public $difficulty;
     public $glutfree;
     public $lowcarb;
     public $lowcal;
     public $carnivore;
     public $veget;
     public $instruct;
     public $ingred;
     
     protected $inputFilter;                       // <-- Add this variable

     public function exchangeArray($data)
     {
         $this->recID     = (isset($data['recID']))     ? $data['recID']     : null;
         $this->recName     = (isset($data['recName']))     ? $data['recName']     : null;
         $this->prepTime  = (isset($data['prepTime']))  ? $data['prepTime']  : null;
         $this->cookTime  = (isset($data['prepTime']))  ? $data['prepTime']  : null;
         $this->image     = (isset($data['image']))     ? $data['image']     : null;
         $this->difficulty     = (isset($data['difficulty']))     ? $data['difficulty']     : null;
         $this->glutfree     = (isset($data['glutfree']))     ? $data['glutfree']     : null;
         $this->lowcarb     = (isset($data['lowcarb']))     ? $data['lowcarb']     : null;
         $this->lowcal     = (isset($data['lowcal']))     ? $data['lowcal']     : null;
         $this->carnivore     = (isset($data['carnivore']))     ? $data['carnivore']     : null;
         $this->veget     = (isset($data['veget']))     ? $data['veget']     : null;
         $this->ingred     = (isset($data['ingred']))     ? $data['ingred']     : null;
         $this->instruct     = (isset($data['instruct']))     ? $data['instruct']     : null;
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


             $inputFilter->add(array(
                 'name'     => 'recName',
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
             $inputFilter->add(array(
                 'name'     => 'ingred',
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
                             //'max'      => 1000,
                         ),
                     ),
                 ),
             ));
             $inputFilter->add(array(
                 'name'     => 'instruct',
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
                             //'max'      => 1000,
                         ),
                     ),
                 ),
             ));
             $inputFilter->add(array(
                 'name'     => 'prepTime',
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
                             'max'      => 20,
                         ),
                     ),
                 ),
             ));
             $inputFilter->add(array(
                 'name'     => 'cookTime',
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
                             'max'      => 20,
                         ),
                     ),
                 ),
             ));
             $inputFilter->add(array(
                 'name'     => 'difficulty',
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
                             'max'      => 20,
                         ),
                     ),
                 ),
             ));
             $inputFilter->add(array(
                 'name'     => 'glutfree',
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
                             'max'      => 2,
                         ),
                     ),
                 ),
             ));
             $inputFilter->add(array(
                 'name'     => 'lowcarb',
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
                             'max'      => 2,
                         ),
                     ),
                 ),
             ));
             $inputFilter->add(array(
                 'name'     => 'lowcal',
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
                             'max'      => 2,
                         ),
                     ),
                 ),
             ));
             $inputFilter->add(array(
                 'name'     => 'veget',
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
                             'max'      => 2,
                         ),
                     ),
                 ),
             ));
             $inputFilter->add(array(
                 'name'     => 'carnivore',
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
                             'max'      => 2,
                         ),
                     ),
                 ),
             ));
             $inputFilter->add(array(
                 'name'     => 'image',
                 'required' => false,
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
//             
//
//             $inputFilter->add(array(
//                 'name'     => 'dishName',
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

             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     }
 }