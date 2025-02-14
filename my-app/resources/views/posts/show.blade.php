@extends('layout')

@section('content')
  <div class="p-4 space-y-4 border">
    <h2 class="text-lg font-semibold">Post Detail</h2>
    <div class="space-y-2">
      <h3>{{ $post->title }}</h3>
      <p>{{ $post->content }}</p>
      <a class="flex w-12 items-center justify-center bg-orange-300 hover:bg-orange-500 border rounded p-1"
        href="{{ route('posts.index') }}">Back</a>
      @if (auth()->check() && auth()->id() === $post->user_id)
        <a class="flex w-12 items-center justify-center bg-sky-300 hover:bg-sky-500 border rounded p-1"
          href="{{ route('posts.edit', $post->id) }}">Edit</a>
        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
          @csrf
          @method('DELETE')
          <button class="flex w-14 items-center justify-center bg-red-300 hover:bg-red-500 border rounded p-1"
            type="submit">Delete</button>
        </form>
      @endif
    </div>
    {{-- Likes button --}}
      <form action="{{ route('likes.toggle', $post->id) }}" method="POST">
        @csrf
        <button class="flex w-14 items-center justify-center border rounded p-1 {{ $post->likes->contains('user_id', auth()->id()) ? 'bg-white' : 'bg-green-500' }}"
          type="submit">{{ $post->likes->contains('user_id', auth()->id()) ? 'unLike' : 'Like' }}</button>
      </form>
      <p>{{ $post->likes->count() }} likes</p>
    {{-- comments --}}
    <h2 class="text-lg font-semibold">Comments</h2>
    @if ($comments->isEmpty())
      <p>No comments yet</p>
    @else
    @foreach ($comments as $comment)
        <div class="border p-2">
          <p>{{ $comment->content }}</p>
          <p class="text-sm text-gray-500">{{ $comment->user->name }}</p>
          <p class="text-sm text-gray-500">{{ $comment->created_at->format('Y-m-d H:i') }}</p>
        </div>
      @endforeach
    @endif
    <div>
      {{ $comments->links() }}
    </div>
    <div class="space-y-2">
    {{-- comment form --}}
    @auth
      <form action="{{ route('comments.store', $post->id) }}" method="POST">
        @csrf
        <div class="flex flex-col space-y-2">
          <label for="content">Comment</label>
          <textarea name="content" id="content" class="border rounded p-1" required></textarea>
          <button class="flex w-14 items-center justify-center bg-blue-300 hover:bg-blue-500 border rounded p-1"
            type="submit">Submit</button>
        </div>
      </form>
    @else
      <p class="text-red-500">Please login to comment</p>
    @endauth
  </div>
@endsection
