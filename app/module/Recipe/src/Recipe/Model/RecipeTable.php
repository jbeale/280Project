<?php
//set userid from session and edit dbAdapter as needed
namespace Recipe\Model;

 use Zend\Db\TableGateway\TableGateway;
 use Zend\Db\Adapter\Adapter as DbAdapter;
 use Zend\Db\Sql\Sql;
 use Zend\Db\Sql\Select;
 

 class RecipeTable
 {
     protected $tableGateway;
     protected $userid = 1; 

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     public function fetchAll()
     {
         $resultSet = $this->tableGateway->select();
         return $resultSet;
     }
     
     public function fetchCookbook()
     {
        //SELECT * FROM recipe INNER JOIN cookbook ON recipe.recID=cookbook.recipeID WHERE cookbook.userID = 0;
        $joinTable = 'cookbook';

        $select = new Select();

        $select->from('recipe');
        $select->join($joinTable, "recipe.recID = {$joinTable}.recipeID");

        $where = array();
        $where[] = "{$joinTable}.userID = {$this->userid}";

        $select->where($where);

//        $sort[] = 'sort_order ASC';
//        $sort[] = 'value ASC';
//        $select->order($sort);

        $resultSet = $this->tableGateway->selectWith($select);

        return $resultSet;
     }

     public function getRecipe($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('recID' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }
     
     
     
//     public function getRecipe2($artist)
//     {
//         //$artist  = $artist;
//         $rowset = $this->tableGateway->select(array('artist' => $artist));
//         //$row = $rowset->current();
//         if (!$rowset) {
//             throw new \Exception("Could not find row $artist");
//         }
//         return $rowset;
//     }

     public function saveRecipe(Recipe $recipe)
     {
         $data = array(
             'recName' => $recipe->recName,
             'ingred' => $recipe->ingred,
             'instruct' => $recipe->instruct,
             'prepTime' => $recipe->prepTime,
             //'image' => $recipe->image,
             'difficulty' => $recipe->difficulty,
             
             /*
              * need to add function to call other module 
              * will take input of the categories
              */
             
         );

         $id = (int) $recipe->recID;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getRecipe($id)) {
                 $this->tableGateway->update($data, array('recID' => $id));
             } else {
                 throw new \Exception('recipe id does not exist');
             }
         }
     }
     
     public function saveToCookbook(RecipeAdd $recipeAdd){
         
         $data = array(
                'userID'=> $this->userid,
                'recipeID'=> $recipeAdd->recID,
                
        );
         
         $dbAdapter = new DbAdapter(array(
                                    'driver'        => 'Pdo',
                                    'dsn'            => 'mysql:dbname=food280;host=localhost',
                                    'username'       => 'root',
                                    'password'       => 'password',
                                 ));
         
         $cookbookTable = new TableGateway('cookbook', $dbAdapter);
         
         $cookbookTable->insert($data);
//        $sel = new Sql($dbAdapter);
//        $s = $sel->insert('cookbook');
//        $data = array(
//                'userID'=> $this->userid,
//                'recID'=> $recipeAdd->recID,
//                
//        );
//        $s->values($data);
//        $statement = $sel->prepareStatementForSqlObject($s);
//        $result= $statement->execute($data);      
//        //print_R($result);
//
//        return $result;
      
     }

//     public function deleteAlbum($id)
//     {
//         $this->tableGateway->delete(array('id' => (int) $id));
//     }
 }

