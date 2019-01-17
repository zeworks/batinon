<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pages;
class PagesController extends Controller
{
    public function getPage($slug){
        $page = $this->fetchPage($slug);
        if($page === null) {
            return view('front.error');
        } else {
            return view('front.institucional', compact('page'));
        }
    }

    public static function fetchPage($slug){
        $page = Pages::where('slug',$slug)->get();

        if(count($page) > 0){
            return $page;
        } else {
            return null;            
        }
    }
}
