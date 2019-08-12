<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    // Show All Comments
    public function index(Request $request) {
        $id = $request->id;
        $comments = Comment::where('post_id', $id)->get();
        echo json_encode($comments);
    }

    // Write Down the new comment
    public function store(Request $request) {
        $c = new Comment();
        $c->user_id =  Auth::user()->id;
        $c->post_id = $request->post_id;
        $c->text = $request->text;
        $c->save();
    }

    // Retrieve, change and save the comment record
    public function update(Request $request) {
        $id = $request->id;
        $c = Comment::find($id);
        $u = Auth::user();
        if($u->id == $c->user_id || $u->role == 'admin') {
            $c->text = $request->text;
            $c->save();
        }
    }

    // Perform delete query without retrieving
    public function destroy(Request $request) {
        $id = $request->id;
        $c = Comment::find($id);
        $u = Auth::user();
        if($u->id == $c->user_id || $u->role == 'admin') {
            $c->delete();
        }
    }
}



