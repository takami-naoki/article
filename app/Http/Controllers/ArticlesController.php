<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller {

    public function list() {
        return view('articles.list');
    }

    public function detail() {
        return view('articles.detail');
    }

    public function createOrEdit() {
        return view('articles.createOrEdit');
    }

    public function create() {
        return redirect()->route('articles.list');
    }
}