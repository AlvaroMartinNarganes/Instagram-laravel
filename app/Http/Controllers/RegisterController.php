<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;


class RegisterController extends Controller
{
    //
    public function index()
    {
        return view('auth.register');
    }


    public function store(Request $request)
    {
        //Validation
        $this->validate($request, ['name' => 'required|max:20',
            'username' => 'required|unique:users|min:4|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6|max:15']);
        //Insert
        User::create(['name' => $request->name,
            'username' => Str::slug($request->username),
            'email' => $request->email,
            'password' => Hash::make($request->password)]);
        //Auth
        /*        auth()->attempt([
                    'email'=>$request->email,
                    'password'=>$request->password
                ]);*/

        //Otra forme de auth
        auth()->attempt($request->only('email', 'password'));

        //Redirect
        return redirect()->route('posts.index');

    }


}
