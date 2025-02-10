<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::query();
        if ($request->has('search') && $request->filled('search')) {
            $searchKeyword = $request->input('search');
            $searchType = $request->input('search_type');

            switch ($searchType) {
                case 'prefix':
                    $query->where('title', 'like', "{$searchKeyword}%");
                    break;
                case 'suffix':
                    $query->where('title', 'like', "%{$searchKeyword}");
                    break;
                case 'partial':
                    $query->where('title', 'like', "%{$searchKeyword}%");
                    break;
                default:
                    $query->where('title', 'like', "%{$searchKeyword}%");       
                    break;
            }
        }

        // sort
        $sortType = $request->input('sort', 'newest');

        switch ($sortType) {
            case 'asc':
                $query->orderBy('title', 'asc');
                break;
            case 'desc':
                $query->orderBy('title', 'desc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $posts = $query->get();

        return view('posts.index', ['posts' => $posts]);
    }

    public function create()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        return view('posts.create');
    }

    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|max:500',
        ]);

        $newPost = Post::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('posts.show', ['post' => $newPost->id]);

        // return redirect()->route('posts.index');
    }

    public function show(string $id)
    {
        $post = Post::with(['comments', 'user'])->findOrFail($id);
        return view('posts.show', ['post' => $post]);
    }

    public function edit(string $id)
    {
        $post = Post::findOrFail($id);

        if (auth()->id() !== $post->user_id) {
            return redirect()->route('posts.index');
        }

        return view('posts.edit', ['post' => $post]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|max:500',
        ]);

        $post = Post::findOrFail($id);

        if (auth()->id() !== $post->user_id) {
            return redirect()->route('posts.index');
        }

        $post->update($request->all());

        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);

        if (auth()->id() !== $post->user_id) {
            return redirect()->route('posts.index');
        }

        $post->delete();

        return redirect()->route('posts.index');
    }
}
