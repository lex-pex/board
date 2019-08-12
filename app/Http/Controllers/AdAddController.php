<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class AdAddController extends Controller
{
    private $folder = 'up/ads';

    public function __construct() {
        $this->middleware('auth');
    }

    public function create() {
        return view('ad.create');
    }

    public function store(Request $request) {

        $this->validate($request, [
            'title' => 'required|min:3|max:250',
            'text' => 'required|min:50|max:500',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except('_token', 'image');

        $ad = new Ad();

        $ad->fill($data);

        $ad->user_id = Auth::user()->id;

        if ($file = $request->image) {
            $this->imageSave($file, $ad);
        }

        $ad->save();

        return redirect(route('adShow', $ad->id));
    }

    // _________ Private Helpers: _________

    private function imageSave(UploadedFile $file, Ad $a) {
        $this->imageDelete($a->image);
        $dateName = date('dmyHis');
        $name = $dateName . '.' . $file->getClientOriginalExtension();
        $file->move($this->folder, $name);
        $a->image = "/$this->folder/$name";
    }
}
