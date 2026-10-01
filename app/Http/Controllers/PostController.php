<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function deletePost(Post $userPost) {
        if(auth()->user()->id === $userPost['user_id']) {
            $userPost->delete();
        }

        return redirect('/'); 
    }

    public function editPost(Post $userPost, Request $request) {
        if(auth()->user()->id === $userPost['user_id']) {
                $data = $request->validate([
                'title' => 'required',
                'body' => 'required'
            ]);

            $userPost->update($data);
        }

        return redirect('/'); 
    }

    public function getPost(Post $userPost) {
        if(auth()->user()->id === $userPost['user_id']) {
            return view('editPost', ['userPost' => $userPost]);
        }

        return redirect('/'); 
    }

    public function createPost(Request $request) {
        $data = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $data['user_id'] = auth()->id();

        Post::create($data);

        return redirect('/');
    }
}
