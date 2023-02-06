<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        return view('profile.index', [
            'user' => $user,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => ['required',
                'unique:users,username,' . auth()->user()->id,
                'min:4',
                'max:20',
                'not_in:twitter,edit-profile']
        ]);

        if($request->image) {
            $image = $request->file('image');
            $imageName = Str::uuid() . '.' . $image->extension(); //Generate unique image id
            //Intervention
            $imageServer = Image::make($image);
            //Change format
            $imageServer->fit(1000, 1000);
            //Move the image to server (public), never save the images on server, only the path
            $imagePath = public_path('profiles') . '/' . $imageName; //Path to public
            $imageServer->save($imagePath);
        }
        //Save Images
        $user=User::find(auth()->user()->id);

        $user->username=$request->username;
        $user->image=$imageName ??auth()->user()->image??'';
        $user->save();

        return redirect()->route('posts.index',$user->username);

    }
}
