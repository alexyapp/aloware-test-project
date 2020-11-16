<?php

namespace App\Traits;

use App\Models\Comment;

trait HasComments
{
    /**
     * Define the relationship.
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * Define the relationship.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Define the commentable_type attribute.
     *
     * @return string
     */
    public function getCommentableTypeAttribute()
    {
        return $this->getMorphClass();
    }

    /**
     * Adds a comment to an entity.
     *
     * @return \App\Models\Comment
     */
    public function addComment(array $data)
    {
        $comment = new Comment();
        $comment->name = $data['name'];
        $comment->body = $data['body'];

        return $this->comments()->save($comment);
    }
}
