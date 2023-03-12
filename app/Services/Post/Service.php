<?php

namespace App\Services\Post;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class Service
{
    public function store($data)
    {
        try {
            DB::beginTransaction();

            $tags = key_exists('tags', $data) ? $data['tags'] : [];
            $category = $data['category'];
            unset($data['tags'], $data['category']);

            $data['category_id'] = $this->getCategoryId($category);

            $post = Post::create($data);

            $post->tags()->attach($this->getTagIds($tags));

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }

        return $post;
    }

    public function update($post, $data)
    {
        try {
            DB::beginTransaction();

            $tags = key_exists('tags', $data) ? $data['tags'] : [];
            $category = $data['category'];
            unset($data['tags'], $data['category']);

            $data['category_id'] = $this->getCategoryIdWithUpdate($category);

            $post->update($data);

            $post->tags()->sync($this->getTagIdsWithUpdate($tags));

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }

        return $post->fresh();
    }

    private function getCategoryId($category)
    {
        $category = key_exists('id', $category) ? Category::find($category['id']) : Category::create($category);
        return $category->id;
    }

    private function getTagIds($tags)
    {
        return array_reduce($tags, function ($tagIds, $tag) {
            $tag = key_exists('id', $tag) ? Tag::find($tag['id']) : Tag::create($tag);
            $tagIds[] = $tag->id;
            return $tagIds;
        }, []);
    }

    private function getCategoryIdWithUpdate($category)
    {
        if (key_exists('id', $category)) {
            $currentCategory = Category::find($category['id']);
            $currentCategory->update($category);
            $currentCategory = $currentCategory->fresh();
        } else {
            $currentCategory = Category::create($category);
        }

        return $currentCategory->id;
    }

    private function getTagIdsWithUpdate($tags)
    {
        return array_reduce($tags, function ($tagIds, $tag) {
            if (key_exists('id', $tag)) {
                $currentTag = Tag::find($tag['id']);
                $currentTag->update($tag);
                $currentTag = $currentTag->fresh();
            } else {
                $currentTag = Tag::create($tag);
            }

            $tagIds[] = $currentTag->id;
            return $tagIds;
        }, []);
    }
}
