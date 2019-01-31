<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Blog;
use App\Pages;

class BlogController extends Controller
{
    /***
     * 
     * Function to the main page, /blog
     */
    public function index(){
        $blogs = $this->fetchBlogs();
        $banner = $this->getBlogPageBanner();

        return view("front.blog", compact('blogs','banner'));
    }

    /**
     * 
     * Function to fetch the blogs from the DB to display.
     */
    public static function fetchBlogs(){
        $blogs = Blog::where('status', 1)->get();

        return $blogs;
    }

    /**
     * 
     * Function to get the banner from the main page blog.
     */
    public static function getBlogPageBanner(){
        $blogBanner = Pages::where('slug', 'blog')->get();

        return $blogBanner;
    }

    /**
     * 
     * Function to get the blog detail
     */
    public function getBlog($slug){
        $details = $this->validateSlug($slug);

        if($details === null) {
            return view('front.error');
        } else {
            return view('front.blogDetail', compact('details'));
        }
    }

    /**
     * 
     * Function to validate the slug on the url
     */
    public function validateSlug($slug){
        
        $details = Blog::where('slug', $slug)->with('Files')->get();

        if(count($details) > 0){
            return $details;
        } else {
            return null;            
        }
    }
}