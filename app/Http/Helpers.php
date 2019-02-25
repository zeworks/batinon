<?php 

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class Helpers {

    public static function ValidateExistent($id){
        return count($id);
    }
    
    public static function ValidateExistentSlug($slug, $table){
        $validate = DB::table($table)->where('slug', $slug)->get();
        
        return $validate;
    }

    public static function Store(){
        $store = false;
        
        return $store;
    }
}
