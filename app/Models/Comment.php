<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

    protected $fillable = ['user_id', 'article_id', 'comment'];

    protected $dates = ['created_at'];

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function article() {
        return $this->belongsTo('App\Models\Article');
    }
}
