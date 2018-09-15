<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Files;


class FilesController extends Controller
{
    //
    public function index(){

        $files = Files::get();
        return $files;
    }

    public function add(Request $request){
        if($request->file('image'))
        {
          $image = $request->file('image');
          $image_extension = $request->file('image')->getClientOriginalExtension();
          $name = $image->getClientOriginalName();
          $name_encoded = base64_encode($name).'.'.$image_extension;
          $image->storeAs('public/images', $name_encoded);
        }

       $image= new Files();
       $image->name = $name_encoded;
       $image->save();
    }
}