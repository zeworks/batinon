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
        $limitArticles = 4;
        
        $banners = Banners::where('status', 1)->get();
        $articles = Blog::where('status', 1)->limit($limitArticles)->get();
        
        return [
            'banners' => $banners,
            'articles' => $articles
        ];
    }
}
