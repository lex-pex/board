<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Rating;
use App\Models\User;

class IndexController extends Controller
{
    public function index() {
        $ads = Ad::orderBy('id','DESC')->paginate(10);
        foreach ($ads as $a) {
            $rows = Rating::where('post_id', $a->id)->get();
            if($amount = count($rows)) {
                $sum = $rows->sum('rating');
                $a->rate = (int) round($sum / $amount);
            } else {
                $a->rate = 0;
            }
        }
        return view('main.index', [
            'ads' => $ads
        ]);
    }

    public function show(int $id) {
        if(!$ad = Ad::find($id)) abort(404);
        if(!$author = User::find($ad->user_id))
            $author = User::where('role', 'admin')->first();
        return view('ad.show', [
            'ad' => $ad,
            'author' => $author
        ]);
    }
}
