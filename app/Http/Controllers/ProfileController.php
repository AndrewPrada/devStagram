<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('profile.index');
    }

    public function store(Request $request)
    {
        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request, [
            'username' => ["required", "unique:users,username," . auth()->user()->id, "min:3", "max:20", "not_in:twitter,edit-profile"],
            'email' => ["required", "unique:users,email," . auth()->user()->id, "email", "max:60"],
        ]);

        if ($request->image) {

            $imagePath = public_path('profiles') . '/' . auth()->user()->image;

            if (File::exists($imagePath)) {
                unlink($imagePath);
            };

            $image = $request->file('image');
            $imageName = Str::uuid() . "." . $image->extension();

            $serverImage = Image::make($image);
            $serverImage->fit(1000, 1000);

            $imagePath = public_path('profiles') . '/' . $imageName;
            $serverImage->save($imagePath);
        }

        $user = User::find(auth()->user()->id);

        $user->username = $request->username;
        $user->image = $imageName ?? auth()->user()->image ?? null;
        $user->save();

        if ($request->current_password || $request->password) {
            $this->validate($request, [
                'password' => 'required|confirmed',
            ]);

            if (Hash::check($request->current_password, auth()->user()->password)) {
                $user->password = Hash::make($request->password) ?? auth()->user()->password;
                $user->save();
            } else {
                return back()->with('message', 'No ingreso la contraseña actual o es incorrecta');
            }
        }

        return redirect()->route('posts.index', $user->username);
    }
}
