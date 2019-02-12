<?php 

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class Helpers {
  
    public static function ValidateExistent($id){
        return count($id);
    }
    
    public static function ValidateExistentSlug($slug, $table){
        return $slug;
    }
}
