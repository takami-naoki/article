<?php

namespace App\Domain\Entities;

class Articles {

    private $articles;
    public static $num_per_page = 10;
    private $currentPage;
    private $prevPageUrl;
    private $nextPageUrl;
    private $lastPage;

    public function __construct() {
        $this->articles = new \ArrayObject();
    }

    public function add(Article $article) {
        $this->articles[] = $article;
    }

    public function currentPage() {
        return $this->currentPage;
    }

    public function lastPage() {
        return $this->lastPage;
    }

    public function prevPageUrl() {
        return $this->prevPageUrl;
    }

    public function nextPageUrl() {
        return $this->nextPageUrl;
    }

    public function setCurrentPage($currentPage) {
        $this->currentPage = $currentPage;
    }

    public function setLastPage($lastPage) {
        $this->lastPage = $lastPage;
    }

    public function setPrevPageUrl(?String $prevPageUrl) {
        $this->prevPageUrl = $prevPageUrl;
    }

    public function setNextPageUrl(?String $nextPageUrl) {
        $this->nextPageUrl = $nextPageUrl;
    }

    public function getIterator(): \ArrayIterator {
        return $this->articles->getIterator();
    }

    public function toJson(): String {
        $articles = [
            'data' => [],
            'pagination' => [
                'current_page' => $this->currentPage(),
                'last_page' => $this->lastPage(),
                'prev_page_url' => $this->prevPageUrl(),
                'next_page_url' => $this->nextPageUrl(),
            ]
        ];
        foreach($this->getIterator() as $articleEntity) {
            $articles['data'][] = $articleEntity->toArray();
        }
        return json_encode($articles);
    }
}