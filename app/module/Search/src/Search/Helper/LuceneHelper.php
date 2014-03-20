<?php

namespace Search\Helper;

use Search\Model\LuceneIndex;
use ZendSearch\Lucene\Lucene;

class LuceneHelper {

    const DEFAULT_LUCENE_PATH = "/Users/jbeale/Code/280Project/lucene/food280.ldx";

    public static function GetLuceneIndex() {
        return LuceneHelper::GetLuceneIndexFromPath(LuceneHelper::DEFAULT_LUCENE_PATH);
    }

    public static function GetLuceneIndexFromPath($path) {
        $index = Lucene::open($path);
        return new LuceneIndex($index);
    }

    public static function NewLuceneIndex($path) {
        $index = Lucene::create($path);
        return new LuceneIndex($index);
    }
}