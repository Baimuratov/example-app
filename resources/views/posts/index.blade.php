@extends('layouts.main')
@section('content')
<h1 class="mt-1">Posts</h1>
<div class="row">
    <div class="col">
        <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">New post</a>
        <ul class="list-group list-group-flush me-3">
            @foreach ($posts as $post)
            <li class="list-group-item">
                <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
            </li>
            @endforeach
        </ul>
        <div class="mt-3">
            {{ $posts->withQueryString()->links() }}
        </div>
    </div>
    <div class="col-2">
        <form method="get" action="{{ route('posts.index') }}" class="border rounded p-3">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input name="title" type="text" class="form-control" id="title">
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea name="content" class="form-control" id="content"></textarea>
            </div>
            <div class="mb-3">
                <label for="category">Category</label>
                <select name="category_id" id="category" class="form-select">
                    <option selected value="">Select a category</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('posts.index') }}" class="btn btn-primary">Reset</a>
            </div>
        </form>
    </div>
</div>
@endsection