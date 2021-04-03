<?php

namespace App\Repositories\Article;
use App\Domain\Entities\Article;
use App\Domain\Entities\Articles;

interface ArticleRepositoryInterface {
    public function find($id): Article;
    public function list(): Articles;
    public function save(Article $article);
    public function delete($article);
}