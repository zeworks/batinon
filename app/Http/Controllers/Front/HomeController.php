<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Banners;
use App\Blog;

class HomeController extends Controller
{
    public function index(){
        // get all data to homepage
        $data = $this->getHomeData();
        
        return view("front.homepage", compact('data'));
    }
    
    function getHomeData() {
        return response()
               ->json([
                   'banners' => Banners::where('status', 1)->get(),
                   'articles' => Blog::where('status', 1)->limit(4)->get()
               ]);
    }
}
