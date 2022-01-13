<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class CommentController extends Controller
{
    //

    public function comment(Request $request ,$id)
    {
        $post = Post::find($id);
        $post->comments()->create([
            'comment' => $request->comment,
            'user_id' => auth()->id()
        ]);
        return back()->withSuccess('Done');
    }

    public function reply(Request $request , $id)
    {
        $post = Post::find($id);
        $post->comments()->create([
            'comment' => $request->reply,
            'parent_id' => $request->comment_id,
            'user_id' => auth()->id()
        ]);
        return back()->withSuccess('Done');
    }


}
