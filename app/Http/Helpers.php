<?php 

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

class Helpers {

    public static function ValidateExistent($id){
        return count($id);
    }
    /*
    *
    * @var {slug} slug of the element
    * @var {model} model of the element
    *
    * use mode: $valid = validateExistentSlug('abc/sxpto', "\\App\\Models\\Page");
    *
    */
    public function validateExistentSlug($slug, $model){
        $validate = $model::where('slug', $slug)->get();        
        
        return $validate;
    }

    public static function Store(){
        $store = false;
        
        return $store;
    }
}
