<?php

namespace App\Http\Controllers\Api;

use App\Domain\Services\ArticleService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class CommentsController extends Controller {

    private $articleService;

    public function __construct(ArticleService $articleService) {
        $this->articleService = $articleService;
    }

    public function udpate(Request $request) {
        Log::debug($request->all());
        $this->articleService->update($request->all());
    }
}