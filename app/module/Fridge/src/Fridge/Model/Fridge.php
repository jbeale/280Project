<?php
 namespace Fridge\Model;

 // Add these import statements
 use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;
 use Zend\Db\Adapter\Adapter as DbAdapter;

 class Fridge implements InputFilterAwareInterface
 {
     public $itemID;
     public $userID;
     public $itemName;
     public $itemAmount;
     public $amoutType;
     public $expireDate;
     //public $userid;
     
     protected $inputFilter;                       // <-- Add this variable
     
     public function exchangeArray($data)
     {
         $this->itemID     = (isset($data['itemID']))     ? $data['itemID']     : null;
         $this->userID     = (isset($data['userID']))     ? $data['userID']     : null;
         $this->itemName     = (isset($data['itemName']))     ? $data['itemName']     : null;
         $this->itemAmount = (isset($data['itemAmount'])) ? $data['itemAmount'] : null;
         $this->amountType = (isset($data['amountType'])) ? $data['amountType'] : null;
         $this->expireDate     = (isset($data['expireDate']))     ? $data['expireDate']     : null;
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
             
             $dbAdapter = new DbAdapter(array(
                                    'driver'        => 'Pdo',
                                    'dsn'            => 'mysql:dbname=test;host=localhost',
                                    'username'       => 'root',
                                    'password'       => '',
                                 ));
             
             $inputFilter->add(array(
                 'name'     => 'itemID',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
             ));
              
             $inputFilter->add(array(
                 'name'     => 'userID',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
             ));
//
//$adapter = new Zend\Db\Adapter\Adapter(array(
//    'driver' => 'Mysqli',
//    'database' => 'test',
//    'username' => 'root',
//    'password' => ''
// ));
             $inputFilter->add(array(
                 'name'     => 'itemName',
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
                     //validate item input is not already there
//                     array(
//                         'name'    => 'DB\NoRecordExists',
//                         'options' => array(
//                             'table' => 'fridge_username',
//                             'field' => 'itemName',
//                             'adapter' => $dbAdapter,
////                             'exclude' => array(
////                                            'field' => 'userID',
////                                            'value' => $this->userID,
////                                        ),
//                             
//                         ),
//                     ),
                 ),
             ));
             //            $select = new Zend\Db\Sql\Select();
//            $select->from('users')
//                   ->where->equalTo('id', $user_id)
//                   ->where->equalTo('email', $email);
//
//            $validator = new Zend\Validator\Db\RecordExists($select);
//
//            // We still need to set our database adapter
//            $validator->setAdapter($dbAdapter);
//
//            // Validation is then performed as usual
//            if ($validator->isValid($username)) {
//                // username appears to be valid
//            } else {
//                // username is invalid; print the reason
//                $messages = $validator->getMessages();
//                foreach ($messages as $message) {
//                    echo "$message\n";
//                }
//            }

             
             $inputFilter->add(array(
                 'name'     => 'itemAmount',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'Int'),
                    ),

             ));
             $inputFilter->add(array(
                 'name'     => 'amountType',
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
//             
//              $inputFilter->add(array(
//                 'name'     => 'itemAmount',
//                 'required' => true,
//                 'filters'  => array(
//                     array('name' => 'Int'),
//                 ),
//             ));
              
               $inputFilter->add(array(
                 'name'     => 'expireDate',
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

//
             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     }
 }