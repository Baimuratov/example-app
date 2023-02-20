<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;

class ShowController extends BaseController
{
    public function __invoke(Post $post)
    {
        $tags = $post->tags;
        return view('posts.show', compact('post', 'tags'));
    }
}
