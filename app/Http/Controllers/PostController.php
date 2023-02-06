<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    //Antes de cargar el Dashboard podemos controlar que el usuario está logueado con el middleware
    public function __construct()
    {
        $this->middleware('auth')->except(['show','index']);
    }

    public function index(User $user)
    {
        //get posts
        $posts=Post::where('user_id',$user->id)->latest()->paginate(8);


        return view('dashboard', [
            'user' => $user,
            'posts'=>$posts
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required'
        ]);

        /* Post:1
                     Post::create([
                    'title'=>$request->title,
                    'description'=>$request->description,
                    'image'=>$request->image,
                    'user_id'=>auth()->user()->id
                ]);*/

        //Post: 2
        /*$post=new Post;
        $post->title=$request->title;
        $post->description=$request->description;
        $post->image=$request->image;
        $post->user_id=auth()->user()->id;
        $post->save();*/

        //Post: 3 with relation user/posts
        $request->user()->post()->create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user,Post $post){

        return view('posts.show',[
            'post'=>$post,
            'user'=>$user
        ]);
    }

    public function destroy(Post $post){
        $this->authorize('delete',$post);
        $post->delete();

        //Delete image from public
        $img_path=public_path('uploads/'. $post->image);
        if(File::exists($img_path)){
            unlink($img_path);
        }

        return redirect()->route('posts.index',auth()->user()->username);
    }
}
