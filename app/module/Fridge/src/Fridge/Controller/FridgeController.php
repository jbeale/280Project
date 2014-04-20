<?php
namespace Fridge\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Fridge\Model\Fridge;
 use Fridge\Model\SearchFridge;
 use Fridge\Model\FridgeItem;
 use Fridge\Form\AddFridgeForm;
 use Fridge\Form\UpdateFridgeForm;
 use Fridge\Form\SearchFridgeForm;
 
 class FridgeController extends AbstractActionController
 {
     protected $fridgeTable;
     protected $update;
     protected $fridgeItems;
     
     
     public function indexAction()
     {
//         $post = $_POST;
//         foreach($post as $key => $value){
//             echo $key." : ".$value."<br>";
//         }
//         if($post['submitRemove'] == 'remove'){
//             echo "remove";
//         }
//         echo (isset($post['submitPlus']))     ? $post['submitPlus'] : "null";
//         echo (isset($post['submitMinus']))     ? $post['submitMinus'] : "null";
//         echo (isset($post['submitRemove']))     ? $post['submitRemove'] : "null";
         
         //Zend_View_Helper_PaginationControl::setDefaultViewPartial ( 'paginator.phtml');
         
         $update = "null";
                if (isset($_POST['submitPlus'])) {
                    $this->update = "plus";
                }

                if (isset($_POST['submitMinus'])) {
                    $this->update = "minus";
                }

                if (isset($_POST['submitRemove'])) {
                    $this->update = "remove";
                }

         //echo $this->update;
                
//                foreach($this->fridgeItems as $item){
//                    $itemNames[] = $item->itemName;
//                }
               
         return new ViewModel(array(
             'addForm' => (isset($_POST['submitAdd'])) ? $this->add() : new AddFridgeForm(),
             'updateForm' => (isset($this->update)) ? $this->update() : new UpdateFridgeForm(),            
             'searchForm' =>  $this->search(), //(isset($post['submitSearch'])) ?  $this->search() : new SearchFridgeForm(), 
             'fridgeItems' => $this->fridgeItems,
             //get item names on userid
             'itemNames' => $this->getNames(), //$this->getFridgeTable()->fetchAllNames(),
             'paginator' => $this->makePaginator(),
             
         ));
     }
    //function to add an item to the fridge
     public function add()
         {
             $addForm = new AddFridgeForm();
             $request = $this->getRequest();

             if ($request->isPost()) {
                 $fridgeItem = new FridgeItem();

                 $addForm->setInputFilter($fridgeItem->getInputFilter());
                 $addForm->setData($request->getPost());

                 if ($addForm->isValid()) {
                     //need to check if already exists
                     $fridgeItem->exchangeArray($addForm->getData());
                     $this->getFridgeTable()->saveFridge($fridgeItem);

                     $form = new AddFridgeForm();
                     return $form;
                 }
             }
             return $addForm;
         }

//function to search the users fridge for an item        
    public function search()
        {
            $searchForm = new SearchFridgeForm();
            $request = $this->getRequest();

            if ($request->isPost()) {
                $sFridge = new SearchFridge();

                $searchForm->setInputFilter($sFridge->getInputFilter());
                $searchForm->setData($request->getPost());

                if ($searchForm->isValid()) {
                    $sFridge->exchangeArray($searchForm->getData());
                    $this->fridgeItems = $this->getFridgeTable()->fetchSearch($sFridge, true);
                    
                    if($this->fridgeItems == '0'){
                        $this->fridgeItems = $this->getFridgeTable()->fetchAll(true);
                        
                    }
                    
                    $form = new SearchFridgeForm();
                    return $form;
                }
           }
         //return nothing returnd
           $this->fridgeItems = $this->getFridgeTable()->fetchAll(true);
           return $searchForm;
        }
     
     public function update()
     {
         $updateForm = new UpdateFridgeForm();
         $request = $this->getRequest();

         if ($request->isPost()) {
             $fridge = new Fridge();
             
             $updateForm->setInputFilter($fridge->getInputFilter());
             $updateForm->setData($request->getPost());
             
             

             if ($updateForm->isValid()) {
                $fridge->exchangeArray($updateForm->getData());
                switch($this->update){
                    case"plus":
                        $this->getFridgeTable()->addUpdateFridge($fridge);
                        break;
                    
                    case"minus":
                        $this->getFridgeTable()->minusUpdateFridge($fridge);
                        break;
                    
                    case"remove":
                        
                        break;
                }
                $form = new UpdateFridgeForm();
                return $form;
            }
        }
         return $updateForm;
     }
     
 public function getNames()
     {
     $fi = $this->getFridgeTable()->fetchAll();
     $itemNames = array(); 
        foreach($fi as $item){
                    $itemNames[] = $item->itemName;
                }
        return $itemNames;
     }
     
 public function makePaginator(){
     // grab the paginator from the FridgeTable
     $paginator = $this->fridgeItems;
     // set the current page to what has been passed in query string, or to 1 if none set
     $paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
     // set the number of items per page to 10
     $paginator->setItemCountPerPage(10);
     
     return $paginator;

 }                   
     
 public function getFridgeTable()
     {
         if (!$this->fridgeTable) {
             $sm = $this->getServiceLocator();
             $this->fridgeTable = $sm->get('Fridge\Model\FridgeTable');
         }
         return $this->fridgeTable;
     }     
}
