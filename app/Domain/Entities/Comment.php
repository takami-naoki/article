<?php

namespace App\Domain\Entities;

use Illuminate\Support\Facades\Auth;

class Comment {
    private $id;
    private $userName;
    private $comment;
    private $created;

    static function fromParams(array $params) {
        return new self(
            $params["id"] ?? "",
            $params["user_name"] ?? "",
            $params["comment"] ?? "",
            "",
        );
    }

    static function fromEloquent(\App\Models\Comment $eloquent) {
        $eloquent = $eloquent::with('user:id,name')->where('id', $eloquent->id)->get()->first();
        return new self(
            $eloquent->id,
            $eloquent->user->name,
            $eloquent->comment,
            $eloquent->created_at,
        );
    }

    function __construct($id,
                         $userName,
                         $comment,
                         $created) {
        $this->id = $id;
        $this->userName = $userName;
        $this->comment = $comment;
        $this->created = $created;
    }

    function id() {
        return $this->id;
    }

    function userName() {
        return $this->userName;
    }

    function comment() {
        return $this->comment;
    }

    function created() {
        return $this->created->format('Y-m-d');
    }

    function toArray(): array {
        return [
            'id' => $this->id(),
            'user_name' => $this->userName(),
            'comment' => $this->comment(),
            'created' => $this->created(),
        ];
    }

    function toJson(): String {
        return json_encode([
            'id' => $this->id(),
            'user_name' => $this->userName(),
            'comment' => $this->comment(),
            'created' => $this->created(),
        ]);
    }
}