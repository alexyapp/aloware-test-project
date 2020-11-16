<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post as PostResource;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $post = Post::with(['comments' => function ($q) {
            $q->orderBy('created_at', 'desc')
                ->with(['comments' => function ($q) {
                    $q->orderBy('created_at', 'desc');

                    $q->with(['comments' => function ($q) {
                        $q->orderBy('created_at', 'desc');

                        $q->with(['comments' => function ($q) {
                            $q->orderBy('created_at', 'desc');
                        }]);
                    }]);
                }]);
        }])
            ->findOrFail($id);

        return new PostResource($post);
    }
}
