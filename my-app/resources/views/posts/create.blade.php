@extends('layout')

@section('content')
    <div class="p-4 space-y-4">
      <h2 class="text-lg font-bold">New Post</h2>
      <form action="{{ route('posts.store') }}" method="POST" class="space-y-2">
        @csrf
        <div>
          <label for="title">Title</label>
          <input class="border p-1" type="text" name="title" required>
        </div>
        <div class="flex items-center gap-1">
          <label for="content">Content</label>
          <textarea name="content" class="border p-1" required></textarea>
        </div>
        <button class="border bg-sky-500 hover:bg-sky-700 transition duration-500 rounded p-1" type="submit">Post</button>
      </form>
      <a class="flex w-12 items-center justify-center bg-orange-300 hover:bg-orange-500 border rounded p-1" href="{{ route('posts.index') }}">Back</a>
    </div>
@endsection