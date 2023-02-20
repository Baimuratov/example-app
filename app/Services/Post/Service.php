<?php

namespace App\Services\Post;

use App\Models\Post;

class Service
{
    public function store($data)
    {
        $tags = key_exists('tags', $data) ? $data['tags'] : [];
        unset($data['tags']);

        $post = Post::create($data);
        $post->tags()->attach($tags);
    }

    public function update($post, $data)
    {
        $tags = key_exists('tags', $data) ? $data['tags'] : [];
        unset($data['tags']);

        $post->update($data);
        $post->tags()->sync($tags);
    }
}
