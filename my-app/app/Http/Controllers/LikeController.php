<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Notifications\LikeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggleLike(Post $post)
    {
        // 未ログインの場合、ログインページにリダイレクト
        if (Auth::guest()) {
            return redirect()->route('login');
        }

        $user = Auth::id();
        $like = $post->likes()->where('user_id', $user)->first();

        if ($like) {
            $like->delete();
        } else {
            $post->likes()->create(['user_id' => $user]);

            // いいねがついたら通知
            // $post->user->notify(new LikeNotification($post));
        }
        
        return redirect()->back();

        // return response()->json([
        //     'liked' => $like ? true : false,
        //     'likes' => $post->likes()->count(),
        // ]);
    }
}