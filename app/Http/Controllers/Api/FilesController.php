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
    // ADD NEW FILE - SINGLE FILE
    public function add(Request $request){

        try{
            if($request->file('image'))
            {
                $image = $request->file('image');
                $image_extension = $request->file('image')->getClientOriginalExtension();
                $name = $image->getClientOriginalName();
                $name_encoded = base64_encode($name).'.'.$image_extension;
                
                if($this->ValidateExistImage($name_encoded)){
                    $image->storeAs('public/images', $name_encoded);
                } else {
                    return ['success' => false, 'message' => __('files.files_exist')];
                }
    
            }
            
            // if uploaded successfullly
            if($request->file('image')->isValid()){
    
                $image= new Files();
                $image->name = $name_encoded;
                $image->save();
                
                return ['success' => true, 'message' => __('notifications.add_success')];
            }
        } catch (\Exception $e) {
			return ['success' => false, 'message' => __('files.files_size_large')];
        }
    }
    
	public function delete(Request $request){
        $files = Files::where('id',$request->data)->get();

        foreach ($files as $file) {
            Storage::delete('public/images/'.$file->name);
            $file->delete();
        }
        
        return ['success' => true, 'message' => __('notifications.remove_success')];
    }
    
    /***
     * 
     * VALIDATION OF IMAGE IF EXISTS OR NOT
     */
    public static function ValidateExistImage($imageName){
       $validation = count(Files::where('name', $imageName)->get());

       if($validation > 0) {
           return false;
       } else {
           return true;
       }
    }
}
