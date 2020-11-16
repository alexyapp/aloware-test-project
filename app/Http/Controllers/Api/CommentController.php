<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCommentRequest;
use App\Http\Resources\Comment as CommentResource;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @return \App\Http\Resources\Comment
     */
    public function store(CreateCommentRequest $request, $entity)
    {
        $comment = $entity->addComment($request->only(['name', 'body']));

        if ($comment->level !== 3) {
            $comment->load('comments');
        }

        return new CommentResource($comment);
    }
}
