<?php

namespace App\Http\Controllers\Post;

use App\Http\Resources\Post\PostResource;
use App\Models\Post;

class ShowController extends BaseController
{
    public function __invoke(Post $post)
    {
        return new PostResource($post);
        // $tags = $post->tags;
        // return view('posts.show', compact('post', 'tags'));
    }
}
