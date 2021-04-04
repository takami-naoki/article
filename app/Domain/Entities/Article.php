<?php

namespace App\Domain\Entities;

use Illuminate\Support\Facades\Auth;

class Article {
    private $id;
    private $isMine;
    private $title;
    private $authorName;
    private $shortDescription;
    private $fullDescription;
    private $created;
    private $comments;

    static function fromParams(array $params) {

        $commentsEntity = new Comments();
        if (isset($params["commentOnly"])) {
            $commentsEntity->add(Comment::fromParams($params));
        }
        return new self(
            $params["id"] ?? "",
            false,
            $params["title"] ?? "",
            "",
            $params["short_description"] ?? "",
            $params["full_description"] ?? "",
            "",
            $commentsEntity,
        );
    }

    static function fromEloquent(\App\Models\Article $eloquent) {

        $commentsEntity = new Comments();
        foreach ($eloquent->comments as $comment) {
            $commentsEntity->add(Comment::fromEloquent($comment));
        }
        return new self(
            $eloquent->id,
            $eloquent->user_id == Auth::user()->id,
            $eloquent->title,
            $eloquent->user->name,
            $eloquent->short_description,
            $eloquent->full_description,
            $eloquent->created_at,
            $commentsEntity,
        );
    }

    function __construct($id,
                         $isMine = false,
                         $title,
                         $authorName,
                         $shortDescription,
                         $fullDescription,
                         $created,
                         $comments) {
        $this->id = $id;
        $this->isMine = $isMine;
        $this->title = $title;
        $this->authorName = $authorName;
        $this->shortDescription = $shortDescription;
        $this->fullDescription = $fullDescription;
        $this->created = $created;

        $this->comments = $comments;
    }

    function id() {
        return $this->id;
    }

    function isMine() {
        return $this->isMine;
    }

    function title() {
        return $this->title;
    }

    function authorName() {
        return $this->authorName;
    }

    function shortDescription() {
        return $this->shortDescription;
    }

    function fullDescription() {
        return $this->fullDescription;
    }

    function created() {
        return $this->created->format('Y-m-d');
    }

    function updateIsMine(Bool $isMine) {
        $this->isMine = $isMine;
    }

    function comments() {
        return $this->comments;
    }

    function toArray(): array {
        return [
            'id' => $this->id(),
            'is_mine' => $this->isMine(),
            'title' => $this->title(),
            'short_description' => $this->shortDescription(),
            'full_description' => $this->fullDescription(),
            'author_name' => $this->authorName(),
            'comments' => $this->comments(),
            'created' => $this->created(),
        ];
    }

    function toJson(): String {
        return json_encode([
            'id' => $this->id(),
            'is_mine' => $this->isMine(),
            'title' => $this->title(),
            'short_description' => $this->shortDescription(),
            'full_description' => $this->fullDescription(),
            'author_name' => $this->authorName(),
            'comments' => $this->comments()->toArray(),
            'created' => $this->created(),
        ]);
    }
}