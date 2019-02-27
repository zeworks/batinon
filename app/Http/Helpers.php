<?php 

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

class Helpers {

    public static function ValidateExistent($id){
        return count($id);
    }
    
    public static function ValidateExistentSlug($slug, $table){

        // $validate = App\$table::where('slug', $slug)->get();
        
        return $validate;
    }

    public static function Store(){
        $store = false;
        
        return $store;
    }
}
