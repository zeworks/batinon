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
     * Function to get the blog detail
     */
    public function getBlog($slug){
        $details = $this->validateSlug($slug);

        if($details === null) {
            return redirect('404');
        } else {
            return view('front.blogDetail', compact('details'));
        }
    }

    /**
     * 
     * Function to validate the slug on the url
     */
    function validateSlug($slug){
        
        $details = Blog::where('slug', $slug)->with('Files')->get();

        if(count($details) > 0){
            return $details;
        } else {
            return null;            
        }
    }
    
    /**
     * 
     * Function to fetch the blogs from the DB to display.
     */
    function fetchBlogs(){
        $blogs = Blog::where('status', 1)->get();

        return $blogs;
    }

    /**
     * 
     * Function to get the banner from the main page blog.
     */
    function getBlogPageBanner(){
        $blogBanner = Pages::where('slug', 'blog')->get();

        return $blogBanner;
    }
}
