@extends('layout')

@section('content')
    <div class="p-4 space-y-4">
      <h2 class="text-lg font-bold">Post Edit</h2>
      <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST" class="space-y-2">
        @csrf
        @method('PUT')
        <div>
          <label for="title">Title</label>
          <input class="border p-1" type="text" name="title" required value="{{ $post->title }}">
        </div>
        <div class="flex items-center gap-1">
          <label for="content">Content</label>
          <textarea name="content" class="border p-1" required>{{ $post->content }}</textarea>
        </div>
        <button class="border bg-sky-500 hover:bg-sky-700 transition duration-500 rounded p-1" type="submit">update</button>
        <a class="flex w-12 items-center justify-center bg-orange-300 hover:bg-orange-500 border rounded p-1" href="{{ route('posts.show', $post->id) }}">back</a>
      </form>
    </div>
@endsection