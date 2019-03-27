<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pages;
class PagesController extends Controller
{
    public function getPage($slug){
        $page = $this->fetchPage($slug);
        
        if($page === null || $page[0]->status === 0) {
            return redirect('404');
        } else {
            return view('front.institucional', compact('page'));
        }
    }

    function fetchPage($slug){
        $page = Pages::where('slug',$slug)->get();

        if(count($page) > 0){
            return $page;
        } else {
            return null;            
        }
    }

    public function errorAction(){
        return view('front.error');
    }
}
