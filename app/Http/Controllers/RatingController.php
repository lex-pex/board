<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function index(Request $request) {
        $rate = 0;
        $id = $request->id;
        if($rating = Rating::where('post_id', $id)->get()) {
            $total = $rating->sum('rating');
            $rate = $total / count($rating);
        }
        echo round($rate);
    }

    public function store(Request $request) {
        if(!$u = Auth::user()) {
            echo "* TO PARTICIPATE *\nYOU NEED TO LOGIN";
            exit();
        }
        $post_id = $request->id;
        $user_id = $u->id;
        $rating = $request->rating;
        if(!$r = Rating::where('user_id', $user_id)->where('post_id', $post_id)->first()) {
            $r = new Rating();
            $r->user_id = $user_id;
            $r->post_id = $post_id;
        }
        $r->rating = $rating;
        $r->save();
    }
}






























