<?php

namespace Fridge\Model;

 use Zend\Db\TableGateway\TableGateway;
 use Zend\Db\Sql\Select;
 use Zend\Db\Sql\Sql;
 use Zend\Db\Adapter\Adapter as DbAdapter;
 use Zend\Mail\Protocol\Smtp\Auth\Login;
 use Zend\Paginator\Paginator;
 use Zend\Paginator\Adapter\DbSelect;
 use Zend\Db\ResultSet\ResultSet;
 use Users\Util\LoginSessionDelegate;
 
 class FridgeTable
 {
     protected $tableGateway;
     protected $userid;//to be set from session

     public function __construct(TableGateway $tableGateway)
     {
         $lsd = new LoginSessionDelegate();
         $this->userid = $lsd->getCurrentUser()->id;
         $this->tableGateway = $tableGateway;
     }

     public function fetchAll($paginated=false)
     {
         
         if ($paginated) {
             // create a new Select object for the table fridge
             $select = new Select('fridge');
             // create a new result set based on the fridge entity
             $resultSetPrototype = new ResultSet();
             $resultSetPrototype->setArrayObjectPrototype(new Fridge());
             // create a new pagination adapter object
             $paginatorAdapter = new DbSelect(
                 // our configured select object
                 $select,
                 // the adapter to run it against
                 $this->tableGateway->getAdapter(),
                 // the result set to hydrate
                 $resultSetPrototype
             );
             $paginator = new Paginator($paginatorAdapter);
             
             return $paginator;
         }

         //need to select on userid
         $resultSet = $this->tableGateway->select(array('userID' => $this->userid));
         return $resultSet;
     }
     
//     public function fetchAllNames()
//     {
//        $dbAdapter = new DbAdapter(array(
//                                    'driver'        => 'Pdo',
//                                    'dsn'            => 'mysql:dbname=test;host=localhost',
//                                    'username'       => 'root',
//                                    'password'       => '',
//                                 ));
//         
//        $sql = new Sql($dbAdapter);
//        $select = $sql->select();
//        $select->from('fridge')
//               ->columns(array('itemName'))
//               ->where(array('userID = ?' => $this->userid));
//        
//        $selectString = $sql->getSqlStringForSqlObject($select);
//        $results = $dbAdapter->query($selectString, $dbAdapter::QUERY_MODE_EXECUTE);
//        
//        return $results;
//        
//          //need to select on userid
////         $resultSet = $this->tableGateway->select(array('itemName','userID = ?' => $this->userid));
////         return $resultSet;
//     }
     
     public function fetchSearch(SearchFridge $sFridge, $paginated=false)
     {
         if ($paginated) {
             // create a new Select object for the table fridge
             $select = new Select('fridge');
             //$select->where(array('userID' => $this->userid, 'itemName' => $sFridge->searchValue));
             // create a new result set based on the fridge entity
             $resultSetPrototype = new ResultSet();
             $resultSetPrototype->setArrayObjectPrototype(new Fridge());
             // create a new pagination adapter object
             $paginatorAdapter = new DbSelect(
                 // our configured select object
                 //$select,
                 $select->where(array('userID' => $this->userid, 'itemName' => $sFridge->searchValue)),
                 // the adapter to run it against
                 $this->tableGateway->getAdapter(),
                 // the result set to hydrate
                 $resultSetPrototype
             );
             $paginator = new Paginator($paginatorAdapter);
             return $paginator;
         }
         
         $resultSet = $this->tableGateway->select(array('userID' => $this->userid, 'itemName' => $sFridge->searchValue));
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


     public function saveFridge(FridgeItem $fridge)
     {
         $data = array(
             'itemName' => $fridge->itemName,
             'userID' => $this->userid,
             'itemAmount' => $fridge->itemAmount,
             'amountType' => $fridge->amountType,
             'expireDate' => $fridge->expireDate,

         );
         $this->tableGateway->insert($data);
     }

        public function addUpdateFridge(Fridge $fridge){
             $id = (int) $fridge->itemID;
            if ($this->getFridge($id)) {
                $data = array(
                 'itemAmount' => $fridge->itemAmount + 1,
                 );
                 $this->tableGateway->update($data, array('itemID' => $id));
             } else {
                 throw new \Exception('fridge id does not exist');
             }
        }
        
         public function minusUpdateFridge(Fridge $fridge){
             $id = (int) $fridge->itemID;
             $val = $fridge->itemAmount - 1;
            if ($this->getFridge($id)) {
                $data = array(
                 'itemAmount' => ($val >= 0 ? $val : 0),
                 );
                 $this->tableGateway->update($data, array('itemID' => $id));
             } else {
                 throw new \Exception('fridge id does not exist');
             }
        }
//     public function deleteAlbum($id)
//     {
//         $this->tableGateway->delete(array('id' => (int) $id));
//     }
 }

