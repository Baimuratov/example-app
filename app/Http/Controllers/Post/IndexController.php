<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;

class IndexController extends BaseController
{
    public function __invoke()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }
}
