@extends('layouts.main')
@section('content')
<h1>Edit post</h1>
<form method="post" action="{{ route('posts.update', $post->id) }}">
    @csrf
    @method('patch')
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input name="title" type="text" class="form-control" id="title" value="{{ old('title') ?? $post->title }}">
        @error('title')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea name="content" class="form-control" id="content">{{ old('content') ?? $post->content }}</textarea>
        @error('content')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input name="image" type="text" class="form-control" id="image" value="{{ old('image') ?? $post->image }}">
        @error('image')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="category">Category</label>
        <select name="category_id" id="category" class="form-select">
            @foreach ($categories as $category)
                @php($selectedCategory = old('category_id') ?? $post->category_id)
                <option {{ $category->id == $selectedCategory ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="tags">Tags</label>
        <select name="tags[]" id="tags" class="form-select" multiple>
            @foreach ($tags as $tag)
            <option
                <?php
                    $selectedTags = old('tags');
                    if (!$selectedTags) {
                        foreach ($post->tags as $postTag) {
                            $selectedTags[] = $postTag->id;
                        }
                    }
                ?>
                @if ($selectedTags)
                    {{ in_array($tag->id, $selectedTags, false) ? ' selected ' : '' }}
                @endif
                 value="{{ $tag->id }}">{{ $tag->title }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection