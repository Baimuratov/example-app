@extends('layouts.main')
@section('content')
    <div class="mt-3 mb-3">
        <a href="{{ route('posts.index') }}" class="btn btn-primary">Back</a>
        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">Edit</a>
        <form action="{{ route('posts.destroy', $post->id) }}" method="post" class="d-inline-block">
            @csrf
            @method('delete')
            <input type="submit" value="Delete" class="btn btn-danger">
        </form>
    </div>
    <h1>{{ $post->title }}</h1>
    <p style="white-space: pre-wrap;">{{ $post->content }}</p>
    @if ($tags)
        <div>
            <span>Tags: </span>
            @foreach ($tags as $tag)
                <a href="#">#{{ $tag->title }}</a>
            @endforeach
        </div>
    @endif
@endsection