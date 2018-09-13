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
        dd($request);
    //     if($request->get('image'))
    //     {
    //       $image = $request->get('image');
    //       $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
    //       \Image::make($request->get('image'))->save(storage_path('public\images', $name));
    //     }

    //    $image= new Files();
    //    $image->name = $name;
    //    $image->save();
    }
}