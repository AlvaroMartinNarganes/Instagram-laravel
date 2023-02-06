<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class ImageController extends Controller
{
    public function store(Request $request){
        //Get the image
        $image=$request->file('file');
        $imageName=Str::uuid().'.'.$image->extension(); //Generate unique image id
        //Intervention
        $imageServer=Image::make($image);
        //Change format
        $imageServer->fit(1000,1000);
        //Move the image to server (public), never save the images on server, only the path
        $imagePath=public_path('uploads').'/'.$imageName; //Path to public
        $imageServer->save($imagePath);

        return response()->json($imageName);
    }
}
