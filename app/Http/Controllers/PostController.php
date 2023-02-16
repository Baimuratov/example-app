<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.create', compact('categories', 'tags'));
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'image' => 'string',
            'category_id' => '',
            'tags' => '',
        ]);

        $tags = key_exists('tags', $data) ? $data['tags'] : [];
        unset($data['tags']);

        $post = Post::create($data);
        $post->tags()->attach($tags);

        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        $tags = $post->tags;
        return view('posts.show', compact('post', 'tags'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Post $post)
    {
        $data = request()->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'image' => 'string',
            'category_id' => '',
        ]);

        $tagsData = request()->validate([
            'tags' => '',
        ]);
        $tags = key_exists('tags', $tagsData) ? $tagsData['tags'] : [];

        $post->update($data);
        $post->tags()->sync($tags);

        return redirect()->route('posts.show', $post->id);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index');
    }

    public function firstOrCreate()
    {
        $anotherPost = [
            'title' => 'Title from Code',
            'content' => 'Some content  from Code',
            'image' => 'Some image from Code',
            'likes' => 250,
            'is_published' => 0
        ];
        $post = Post::firstOrCreate([
            'title' => 'Title from Code'
        ], $anotherPost);

        dd($post);
    }

    public function updateOrCreate()
    {
        $anotherPost = [
            'title' => 'Update from Code',
            'content' => 'Update',
            'image' => 'Update',
            'likes' => 15000,
            'is_published' => 1
        ];
        $post = Post::updateOrCreate([
            'title' => 'Update from Code'
        ], $anotherPost);

        dd($post);
    }
}
