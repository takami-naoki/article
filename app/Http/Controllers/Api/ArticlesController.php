<?php

namespace App\Http\Controllers\Api;

use App\Domain\Services\ArticleService;
use App\Http\Requests\ArticleCreateOrEditRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ArticlesController extends Controller {

    private $articleService;

    public function __construct(ArticleService $articleService) {
        $this->articleService = $articleService;
    }

    public function index() {
        $articles = $this->articleService->list();
        return $articles->toJson();
    }

    public function show($id) {
        $article = $this->articleService->find($id);
        return $article->toJson();
    }

    public function store(ArticleCreateOrEditRequest $request) {
        $this->articleService->create($request->all());
    }

    public function update(ArticleCreateOrEditRequest $request) {
        $this->articleService->update($request->all());
    }

    public function destroy($id) {
        $article = $this->articleService->find($id);
        $this->articleService->delete($article);
    }
}