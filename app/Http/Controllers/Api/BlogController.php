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

    // GET BLOG POST (DISPLAY)
    public function get($id){
        $blog = Blog::where('id',$id)->get();
        return $blog;
    }

    // REMOVE BLOG POST
    public function delete(Request $request){
        Blog::where('id',$request->data)->delete();
        
        return ['success' => true];
    }
    
    public function add(Request $request){
        
        if($request->status == ''){
            $status = 0;
        }else{
            $status = $request->status;
        }

        $data = [
            "slug" => $request->slug,
            "status" => $status,
            "b_title" => $request->b_title,
            "b_summary" => $request->b_summary,
            "b_description" => $request->b_description,
            "b_image" => $request->b_image,
            "image" => $request->image,
        ];


        Blog::create($data);
        
        return ['success' => true];
    }

    public function editBlog(Request $request){
        
        if($request->status == ''){
            $status = 0;
        }else{
            $status = $request->status;
        }

        $data = [
            "slug" => $request->slug,
            "status" => $status,
            "b_title" => $request->b_title,
            "b_summary" => $request->b_summary,
            "b_description" => $request->b_description,
            "b_image" => $request->b_image,
            "image" => $request->image,
        ];

        Blog::where('id',$request->id)->update($data);
        
        return ['success' => true];
    }
}
