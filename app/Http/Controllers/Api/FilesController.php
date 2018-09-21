<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Files;

use Illuminate\Support\Facades\Storage;


class FilesController extends Controller
{
    // INDEX
    public function index(){

        $files = Files::get();
        return $files;
    }
    // ADD NEW FILE
    public function add(Request $request){
        if($request->file('image'))
        {
          $image = $request->file('image');
          $image_extension = $request->file('image')->getClientOriginalExtension();
          $name = $image->getClientOriginalName();
          $name_encoded = base64_encode($name).'.'.$image_extension;
          $image->storeAs('public/images', $name_encoded);
        }

      
		// if uploaded successfullly
		if($request->file('image')->isValid()){

			$image= new Files();
			$image->name = $name_encoded;
			$image->save();
			
			return ['success' => true];
		}else{
			return ['success' => false];
		}
	}
	
	public function delete($id){
		echo $id;
	}
}