<?php
namespace Fridge\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Fridge\Model\Fridge;
 use Fridge\Form\AddFridgeForm;
 
 class FridgeController extends AbstractActionController
 {
     protected $fridgeTable;
     
     public function indexAction()
     {
         
         //$form = $this->addAction();
         $id = (int) $this->params()->fromRoute('id', 0);
         return new ViewModel(array(
             'fridgeItems' => $this->getFridgeTable()->fetchAll(),
             'form' =>  $this->addAction(),
         ));
     }

     public function addAction()
     {
         $form = new AddFridgeForm();
         
         $request = $this->getRequest();
         if ($request->isPost()) {
             $fridge = new Fridge();
             
             $form->setInputFilter($fridge->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $fridge->exchangeArray($form->getData());
                 $this->getFridgeTable()->saveFridge($fridge);

                 // Redirect to list of albums
                 return $this->redirect()->toRoute('fridge');
             }
//             else
//             {
//                 return new ViewModel(array(
//                    'fridgeItems' => $this->getFridgeTable()->fetchAll(),
//                    'form' =>  $form,
//                ));
//             }
             
         }
         return $form;
     }
     
     public function updateAction()
     {
         $form = new UpdateFridgeForm();
         
         $request = $this->getRequest();
         if ($request->isPost()) {
             $fridge = new Fridge();
             
             $form->setInputFilter($fridge->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $fridge->exchangeArray($form->getData());
                 $this->getFridgeTable()->saveFridge($fridge);

                 // Redirect to list of albums
                 //return $this->redirect()->toRoute('fridge');
             }
             
             return $this->redirect()->toRoute('fridge');
         }
         return $form;
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
