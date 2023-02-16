@extends('layouts.main')
@section('content')
<h1>Create new post</h1>
<form method="post" action="{{ route('posts.store') }}">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input name="title" type="text" value="{{ old('title') }}" class="form-control" id="title">
        @error('title')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea name="content" class="form-control" id="content">{{ old('content') }}</textarea>
        @error('content')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input name="image" type="text" value="{{ old('image') }}" class="form-control" id="image">
        @error('image')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="category">Category</label>
        <select name="category_id" id="category" class="form-select">
            @foreach ($categories as $category)
            <option {{ old('category_id') == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->title }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="tags">Tags</label>
        <select name="tags[]" id="tags" class="form-select" multiple>
            @foreach ($tags as $tag)
            <option
                @if (old('tags'))
                    {{ in_array($tag->id, old('tags'), false) ? ' selected' : '' }}
                @endif
             value="{{ $tag->id }}">{{ $tag->title }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-success">Create</button>
</form>
@endsection