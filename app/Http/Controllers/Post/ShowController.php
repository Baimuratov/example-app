<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;

class ShowController extends Controller
{
    public function __invoke(Post $post)
    {
        $tags = $post->tags;
        return view('posts.show', compact('post', 'tags'));
    }
}