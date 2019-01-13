<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Banners;

class HomeController extends Controller
{
    function index(){
        // get banners from homepage
        $banners = HomeController::getBanners();
        return view("front.homepage", compact('banners'));
    }

    public static function getBanners(){
        $banners = Banners::where('status', 1)->get();

        return $banners;
    }
}
