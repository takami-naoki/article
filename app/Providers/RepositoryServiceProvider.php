<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {
    /**
     * Register services.
     *
     * @return void
     */
    public function register() {
        $this->app->bind(\App\Repositories\Article\ArticleRepositoryInterface::class, function($app) {
            return new \App\Repositories\Article\EloquentArticleRepository(new \App\Models\Article, new \App\Domain\Entities\Articles);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {
        //
    }
}
