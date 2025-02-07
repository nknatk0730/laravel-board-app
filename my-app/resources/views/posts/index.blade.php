@extends('layout')

@section('content')
  <div class="p-4 max-w-96 space-y-8">
    <h1 class="font-bold text-lg">Board</h1>
    <a class="flex bg-emerald-500 hover:bg-emerald-700 transition duration-500 rounded p-1 justify-center items-center" href="{{ route('posts.create') }}">Create Post</a>
    <ul class="space-y-4">
      @foreach ($posts as $post)
        <li class="border p-1 rounded space-y-2 text-center">
          <a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
          <p>{{ $post->content }}</p>
          <a class="flex w-12 items-center justify-center mx-auto border rounded bg-sky-300 hover:bg-sky-600 p-1" href="{{ route('posts.show', ['post' => $post->id]) }}">Detail</a>
        </li>
      @endforeach
    </ul>
  </div>
@endsection
