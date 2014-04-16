<?php

namespace Search\Controller;

use Search\Helper\LuceneHelper;
use Search\Model\IndexedDocument;
use Search\Model\IndexedDocumentType;
use Search\Model\LuceneIndex;
use Zend\Json\Json;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class SearchController extends AbstractActionController {

    protected $luceneIndex;

    protected $recipeTable;

    public function __construct() {
        //$this->luceneIndex = LuceneHelper::GetLuceneIndex();
    }

    public function indexAction()
    {
        return new ViewModel(array(
            'recipes' => $this->getRecipeTable()->fetchAll(),
        ));
    }

    public function indexopsAction()
    {

        $this->luceneIndex = LuceneHelper::NewLuceneIndex(LuceneHelper::DEFAULT_LUCENE_PATH);
        //Running this page will cause the site to be indexed.
        //TODO break these out from here because having them here is NOOB TERRITRY

        //Get all Recipes and index them (easy way but if this was a real site we would run out of memory doing it this way)
        $recipes = $this->getRecipeTable()->fetchAll();

        foreach($recipes as $recipe) {
            $indexedDoc = new IndexedDocument();
            $indexedDoc->setName($recipe->recName);
            $indexedDoc->setAuthor("Test User"); //TODO user integration
            $indexedDoc->setUrl("/recipe/permalink?id=".$recipe->recID);
            $indexedDoc->setContent($recipe->instruct);
            $indexedDoc->setType(IndexedDocumentType::Recipe);
            $indexedDoc->setTags("test");
            $this->luceneIndex->addDocument($indexedDoc);
        }
        return new ViewModel();
    }

    public function resultsAction() {


        $this->luceneIndex = LuceneHelper::GetLuceneIndex();
        $results = $this->luceneIndex->search($_GET['q']);
        $viewmodel = new ViewModel(array(
            'results' => $results
        ));
        $viewmodel->setTerminal(true); //DO NOT load layout for this page

        $hits = array();
        foreach($results as $hit) {
            $hit->document = IndexedDocument::extractDocument($hit);
            array_push($hits, $hit);
        }

        header("Content-Type: application/json");
        $json = Json::encode($hits);
        echo Json::prettyPrint($json, array('indent' =>"  "));
        return $viewmodel;
    }

    public function resultAction() {
        $this->luceneIndex = LuceneHelper::GetLuceneIndex();

        $results = $this->luceneIndex->search($_GET['q']);

        $hits = array();
        foreach($results as $hit) {
            $hit->document = IndexedDocument::extractDocument($hit);
            array_push($hits, $hit);
        }

        $viewmodel = new ViewModel(array(
            'hits' => $hits
        ));

        return $viewmodel;
    }


    //TODO THIS SHOULD NOT BE IN HERE
    public function getRecipeTable()
    {
        if (!$this->recipeTable) {
            $sm = $this->getServiceLocator();
            $this->recipeTable = $sm->get('Recipe\Model\RecipeTable');
        }
        return $this->recipeTable;
    }


}