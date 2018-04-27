<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    public function store(Request $request, $id){

//        dd($request->username);
        $request->validate([
            'username' => 'required',
            'email' => 'required',
            'comment' => 'required',
        ]);

        $post = Post::findOrFail($id);
        $comment = new Comment();
        $comment->username = $request->username;
        $comment->email = $request->email;
        $comment->website = $request->website;
        $comment->comment = $request->comment;
        $comment->post()->associate($post);
        $comment->save();

        return redirect(route('blog.article', $post->id));
    }
}
