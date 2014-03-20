<?php

namespace Search\Model;

use ZendSearch\Lucene\Lucene;
use ZendSearch\Lucene\Document;

class LuceneIndex {

    protected $index;

    public function __construct($index) {
        $this->index = $index;
    }

    public function search($query) {
        $hits = $this->index->find($query);
        return $hits;
    }

    public function optimize() {
        $this->index->optimize();
    }

    public function addDocument($indexableDocument) {
        $luceneDocObject = $indexableDocument->buildLuceneDocument();
        $this->index->addDocument($luceneDocObject);
    }
}