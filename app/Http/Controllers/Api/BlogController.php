<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Blog;

class BlogController extends Controller
{
    // INDEX
    public function index(){
        $blogs = Blog::get();
        return $blogs;
    }
}
