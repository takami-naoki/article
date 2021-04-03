<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model {

    protected $fillable = ['title', 'user_id', 'short_description', 'full_description'];

    protected $dates = ['created_at'];

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function comments() {
        return $this->hasMany('App\Models\Comment');
    }
}