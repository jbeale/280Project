<?php

namespace Search\Model;

use ZendSearch\Lucene\Document;

abstract class IndexedDocumentType
{
    const Recipe = 0;
    const User = 1;
    const Article = 2;
    const Ingredient = 3;
}

class IndexedDocument {
    public $name;
    public $type;
    public $lastModified;
    public $url;
    public $author;
    public $tags;
    public $content;

    public function buildLuceneDocument() {
        $doc = new Document();
        $doc->addField(Document\Field::text('name', $this->getName()));
        $doc->addField(Document\Field::text('type', $this->getType()));
        $doc->addField(Document\Field::unIndexed('lastModified', $this->getLastModified()));
        $doc->addField(Document\Field::text('url', $this->getUrl()));
        $doc->addField(Document\Field::text('author', $this->getAuthor()));
        $doc->addField(Document\Field::keyword('tags', $this->getTags()));
        $doc->addField(Document\Field::unStored('content', $this->getContent()));
        return $doc;
    }

    public static function extractDocument($hit) {
        $doc = new IndexedDocument();
        $doc->setName($hit->getDocument()->name);
        $doc->setType($hit->getDocument()->type);
        $doc->setLastModified($hit->getDocument()->lastModified);
        $doc->setUrl($hit->getDocument()->url);
        $doc->setAuthor($hit->getDocument()->author);
        $doc->setTags($hit->getDocument()->tags);

        return $doc;
    }

    public function toArray() {
        $ret = array();
        $ret['name'] = $this->getName();
        return $ret;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $lastModified
     */
    public function setLastModified($lastModified)
    {
        $this->lastModified = $lastModified;
    }

    /**
     * @return mixed
     */
    public function getLastModified()
    {
        return $this->lastModified;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }




}