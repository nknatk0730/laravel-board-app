@extends('layout')

@section('content')
    <div class="p-4 space-y-4 border">
      <h2 class="text-lg font-semibold">Post Detail</h2>
      <div class="space-y-2">
        <h3>{{ $post->title }}</h3>
        <p>{{ $post->content }}</p>
        <a class="flex w-12 items-center justify-center bg-orange-300 hover:bg-orange-500 border rounded p-1" href="{{ route('posts.index') }}">Back</a>
        <a class="flex w-12 items-center justify-center bg-sky-300 hover:bg-sky-500 border rounded p-1" href="{{ route('posts.edit', $post->id) }}">Edit</a>
        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
          @csrf
          @method('DELETE')
          <button class="flex w-14 items-center justify-center bg-red-300 hover:bg-red-500 border rounded p-1" type="submit">Delete</button>
        </form>
      </div>
    </div>
@endsection