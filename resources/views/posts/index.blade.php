@extends('layouts.main')
@section('content')
    <h1>Posts</h1>
    <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">New post</a>
    <ul class="list-group list-group-flush">
    @foreach ($posts as $post)
        <li class="list-group-item">
            <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
        </li>
    @endforeach
    </ul>
 @endsection