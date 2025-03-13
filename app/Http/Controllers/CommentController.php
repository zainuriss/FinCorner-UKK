<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request){

        $comment = new Comment;
        $comment->rating = $request->rating;
        $comment->user_id = Auth::user()->id ?? '';
        $comment->film_id = $request->film_id;
        $comment->comment = $request->comment;
        $comment->save();

        return redirect()->route('films.show', ['id' => $request->film_id]);
    }

    public function edit(Request $request){
        $comment = Comment::find($request->id);

        return redirect()->route('films.show', [
            'comment' => $comment,
        ]);
    }

    public function update(Request $request, $id){
        $comment = Comment::find($id);
        $comment->comment = $request->comment;
        $comment->rating = $request->rating;
        $comment->save();

        return redirect()->route('films.show', ['id' => $comment->film_id]);
    }

    public function delete($id){
        $comment = Comment::find($id);
        $comment->delete();
        return redirect()->route('films.show', ['id' => $comment->film_id]);
    }
}
