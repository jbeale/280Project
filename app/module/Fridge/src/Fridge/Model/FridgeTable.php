<?php

namespace Fridge\Model;

 use Zend\Db\TableGateway\TableGateway;

 class FridgeTable
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     public function fetchAll()
     {
         $resultSet = $this->tableGateway->select();
         return $resultSet;
     }

     public function getFridge($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('itemID' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }


     public function saveFridge(Fridge $fridge)
     {
         $data = array(
             'itemName' => $fridge->itemName,
             'itemAmount' => $fridge->itemAmount,
             'expireDate' => $fridge->expireDate,

         );

         $id = (int) $fridge->itemID;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getFridge($id)) {
                 $this->tableGateway->update($data, array('itemID' => $id));
             } else {
                 throw new \Exception('fridge id does not exist');
             }
         }
     }

//     public function deleteAlbum($id)
//     {
//         $this->tableGateway->delete(array('id' => (int) $id));
//     }
 }

