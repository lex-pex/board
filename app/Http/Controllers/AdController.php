<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;

class AdController extends Controller
{
    private $folder = 'up/ads';

    public function __construct() {
        $this->middleware('edit');
    }

    public function edit(int $id) {
        if(!$ad = Ad::find($id)) abort(404);
        return view('ad.edit', ['ad'=>$ad]);
    }

    public function update(Request $request, Ad $ad) {
        $this->validate($request, [
            'title' => 'required|min:3|max:250',
            'text' => 'required|min:50|max:500',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data = $request->except('_token', 'image', 'image_del');
        $ad->fill($data);
        if($request->has('image_del')) {
            $this->imageDelete($ad->image);
            $ad->image = '';
        } elseif ($file = $request->image) {
            $this->imageSave($file, $ad);
        }
        $ad->save();
        return redirect()->back()->with(['status' => 'Ad updated successfully']);
    }

    public function destroy(Ad $ad) {
        $ad->delete();
        return redirect('/');
    }

    // _________ Private Helpers: _________

    private function imageSave(UploadedFile $file, Ad $a) {
        $this->imageDelete($a->image);
        $dateName = date('dmyHis');
        $name = $dateName . '.' . $file->getClientOriginalExtension();
        $file->move($this->folder, $name);
        $a->image = "/$this->folder/$name";
    }

    private function imageDelete(string $path) {
        File::delete(trim($path, '/'));
    }
}























