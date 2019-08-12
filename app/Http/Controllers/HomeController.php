<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;


class HomeController extends Controller
{
    private $folder = 'up/users';

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('cabinet.home');
    }

    public function edit() {
        if(!$user = Auth::user()) abort(404);
        return view('cabinet.edit', ['user'=>$user]);
    }

    public function update(Request $request, User $user) {
        $this->validate($request, [
            'name' => 'required|min:3|max:250',
            'email' => 'required|email',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data = $request->except('_token', 'image', 'image_del');
        $user->fill($data);
        if($request->has('image_del')) {
            $this->imageDelete($user->image);
            $user->image = '';
        } elseif ($file = $request->image) {
            $this->imageSave($file, $user);
        }
        $user->save();
        return redirect()->back()->with(['status' => 'Profile updated successfully']);
    }

    public function destroy(User $user) {
        $user->delete();
        return redirect('/');
    }

    // _________ Private Helpers: _________

    private function imageSave(UploadedFile $file, User $u) {
        $this->imageDelete($u->image);
        $dateName = date('dmyHis');
        $name = $dateName . '.' . $file->getClientOriginalExtension();
        $file->move($this->folder, $name);
        $u->image = "/$this->folder/$name";
    }

    private function imageDelete(string $path) {
        File::delete(trim($path, '/'));
    }
}




















