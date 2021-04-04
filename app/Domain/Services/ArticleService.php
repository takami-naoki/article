<?php

namespace App\Domain\Services;

use App\Domain\Entities\Article;
use App\Domain\Entities\Articles;
use App\Models\User;
use App\Repositories\Article\ArticleRepositoryInterface;
use Illuminate\Support\Facades\Log;

class ArticleService {
    protected $repository;

    public function __construct(ArticleRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function find($id): Article {
        return $this->repository->find($id);
    }

    public function list(): Articles {
        return $this->repository->list();
    }

    public function create(array $params) {
        $article = Article::fromParams($params);
        return $this->repository->save($article);
    }

    public function update(array $params) {
        $article = Article::fromParams($params);

        return $this->repository->save($article);
    }

    public function delete(Article $article) {
        return $this->repository->delete($article);
    }
}