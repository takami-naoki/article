<?php

namespace App\Domain\Entities;

use Illuminate\Support\Facades\Log;

class Comments {

    private $comments;

    public function __construct() {
        $this->comments = new \ArrayObject();
    }

    public function add(Comment $comment) {
        $this->comments[] = $comment;
    }

    public function getIterator(): \ArrayIterator {
        return $this->comments->getIterator();
    }

    public function toArray(): array {
        $comments = [];
        foreach($this->getIterator() as $comment) {
            $comments[] = $comment->toArray();
        }
        return $comments;
    }

    public function has(): bool {
        return count($this->comments) > 0;
    }

    public function first() {
        return $this->comments[0];
    }

    public function toJson(): String {
        $comments = [];
        foreach($this->getIterator() as $comment) {
            $comments[] = $comment->toArray();
        }
        return json_encode($comments);
    }
}