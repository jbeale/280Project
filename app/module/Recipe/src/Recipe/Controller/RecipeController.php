<?php
namespace Recipe\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Recipe\Model\Recipe;
 use Recipe\Model\RecipeAdd;
 use Recipe\Form\RecipeForm;
 use Recipe\Form\RecipeAddForm;
 use Recipe\Form\ShowbookForm;
 
 class RecipeController extends AbstractActionController
 {
     protected $recipeTable;
     
     public function indexAction()
     {
//         $post = $_POST;
//         foreach($post as $key => $value){
//             echo $key." : ".$value."<br>";
//         }
         
         return new ViewModel(array(
             'bookForm' =>  $this->saveToCookbook(),
             'recipes' => (isset($_POST['showBook'])) ? $this->getRecipeTable()->fetchCookbook() : $this->getRecipeTable()->fetchAll(),
         ));
     }

     public function addAction()
     {
         $form = new RecipeForm();
         $form->get('submit')->setValue('Add');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $recipe = new Recipe();
             
             //check image if null do nothing else send to file upload
             
             $form->setInputFilter($recipe->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $recipe->exchangeArray($form->getData());
                 $this->getRecipeTable()->saveRecipe($recipe);

                 // Redirect to list of albums
                 return $this->redirect()->toRoute('recipe');
             }
         }
         return array('form' => $form);
     }


     
    public function getRecipeTable()
     {
         if (!$this->recipeTable) {
             $sm = $this->getServiceLocator();
             $this->recipeTable = $sm->get('Recipe\Model\RecipeTable');
         }
         return $this->recipeTable;
     }     
     
//     public function showCookbook(){
//         
//             'recipes' => $this->getRecipeTable()->fetchCookbook(),
//         
//     }
//     
     public function saveToCookbook(){
         $form = new RecipeAddForm();
         
         $request = $this->getRequest();
         if ($request->isPost()) {
             $recipe = new RecipeAdd();
             
             //check image if null do nothing else send to file upload
             
             $form->setInputFilter($recipe->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $recipe->exchangeArray($form->getData());
                 $this->getRecipeTable()->saveToCookbook($recipe);

                 // Redirect to list of albums
                 //return $this->redirect()->toRoute('recipe');
             }
         }
         return $form;
                  
     }
}
