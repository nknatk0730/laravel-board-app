@extends('layout')

@section('content')
  <div class="p-4 max-w-96 space-y-8">
    <h1 class="font-bold text-lg">Board</h1>
    <a class="flex bg-emerald-500 hover:bg-emerald-700 transition duration-500 rounded p-1 justify-center items-center" href="{{ route('posts.create') }}">Create Post</a>
    {{-- search form --}}
    <form class="space-y-2" action="{{ route('posts.index') }}" method="GET">
      <select name="search_type">
        <option value="partial" {{ request('search_type') === 'partial' ? 'selected' : '' }}>部分一致</option>
        <option value="prefix" {{ request('search_type') === 'prefix' ? 'selected' : '' }}>前方一致</option>
        <option value="suffix" {{ request('search_type') === 'suffix' ? 'selected' : '' }}>後方一致</option>
      </select>
      <input type="text" name="search" class="border rounded w-full p-1" placeholder="Search" value="{{ request('search') }}">
      <select name="sort">
        <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Newest</option>
        <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest</option>
        <option value="asc" {{ request('sort') === 'asc' ? 'selected' : '' }}>Title ASC</option>
        <option value="desc" {{ request('sort') === 'desc' ? 'selected' : '' }}>Title DESC</option>
      </select>
      <button type="submit" class="flex bg-sky-300 hover:bg-sky-600 transition duration-500 rounded p-1 justify-center items-center w-full">Search</button>
    </form>
    <ul class="space-y-4">
      @foreach ($posts as $post)
        <li class="border p-1 rounded space-y-2 text-center">
          <a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
          <p>{{ $post->content }}</p>
          <a class="flex w-12 items-center justify-center mx-auto border rounded bg-sky-300 hover:bg-sky-600 p-1" href="{{ route('posts.show', ['post' => $post->id]) }}">Detail</a>
        </li>
      @endforeach
    </ul>
    {{-- pagination link --}}
    <div>
      {{ $posts->links() }}
    </div>
  </div>
@endsection
