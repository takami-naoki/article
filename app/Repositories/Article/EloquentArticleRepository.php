<?php

namespace App\Repositories\Article;
use App\Domain\Entities\Article;
use App\Domain\Entities\Articles;
use App\Models\Article as ArticleEloquent;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EloquentArticleRepository implements ArticleRepositoryInterface {

    protected $articleEloquent;
    protected $articles;

    public function __construct(
        ArticleEloquent $article,
        Articles $articles
    ) {
        $this->articleEloquent = $article;
        $this->articles = $articles;
    }

    public function find($id): Article {
        $eloquentArticle = $this->articleEloquent::with(['user:id,name', 'comments'])->find($id);
        return Article::fromEloquent($eloquentArticle);
    }

    public function list(): Articles {
        $eloquentArticles = $this->articleEloquent::with('user:id,name')->orderBy('created_at', 'desc')->paginate(Articles::$num_per_page);

        $this->articles->setCurrentPage($eloquentArticles->currentPage());
        $this->articles->setPrevPageUrl($eloquentArticles->previousPageUrl());
        $this->articles->setLastPage($eloquentArticles->lastPage());
        $this->articles->setNextPageUrl($eloquentArticles->nextPageUrl());

        foreach ($eloquentArticles as $eloquentArticle) {
            $this->articles->add(Article::fromEloquent($eloquentArticle));
        }
        return $this->articles;
    }

    public function save(Article $article) {

        $articleEloquent = $this->articleEloquent::find($article->id());
        if ($articleEloquent != null && $article->id() == $articleEloquent->id) {
            $articleEloquent->fill(
                [
                    'title' => $article->title(),
                    'user_id' => Auth::user()->id,
                    'short_description' => $article->shortDescription(),
                    'full_description' => $article->fullDescription(),
                ]
            )->save();

            if ($article->comments()->has()) {
                Log::debug($article->id());
                Comment::create(
                    [
                        'comment' => $article->comments()->first()->comment(),
                        'article_id' => $article->id(),
                        'user_id' => Auth::user()->id,
                    ]
                );
            }
        } else {
            $this->articleEloquent::create(
                [
                    'title' => $article->title(),
                    'user_id' => Auth::user()->id,
                    'short_description' => $article->shortDescription(),
                    'full_description' => $article->fullDescription(),
                ]
            );
        }
    }

    public function delete($article) {
        $this->articleEloquent::findOrFail($article->id())->delete();
    }
}