<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Helpers;
use App\Blog;
use App\Pages;

class BlogController extends Controller
{
    /***
     * 
     * Function to the main page, /blog
     */
    public function index(){
        $data = $this->getBlogData();

        if(Helpers::validateActivePage($data['page'][0])) {
            return view("front.blog", compact('data'));
        } else {
            return redirect('404');
        }
    }

    /**
     * 
     * Function to get the blog detail
     */
    public function getBlog($slug){
        $details = $this->validateSlug($slug);

        if($details == null || $details[0]->status === 0) {
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

    function getBlogData(){
        $blogPage = Pages::where('slug', 'blog')->get();
        $blogs = Blog::where('status', 1)->get();
        
        return [
            'page' => $blogPage,
            'articles' => $blogs
        ];
    }
}
