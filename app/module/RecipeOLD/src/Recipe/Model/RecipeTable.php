<?php

namespace Recipe\Model;

 use Zend\Db\TableGateway\TableGateway;

 class RecipeTable
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

//     public function deleteAlbum($id)
//     {
//         $this->tableGateway->delete(array('id' => (int) $id));
//     }
 }

