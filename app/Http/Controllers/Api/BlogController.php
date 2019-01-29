<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Blog;
use App\BlogImages;
use Helpers;

class BlogController extends Controller
{
    // INDEX
    public function index(){
        $blogs = Blog::get();
        return $blogs;
    }

    // GET BLOG POST (DISPLAY)
    public function get($id){
        $blog = Blog::where('id',$id)->with('Files')->get();
        
        if (Helpers::ValidateExistent($blog) > 0) {
            return [ 'success' => true, 'content' => $blog];
        } else {
            return [ 'success' => false, 'message' => 'Esta página não existe!', 'redirect' => '/admin/blog'];
        }
    }

    // REMOVE BLOG POST
    public function delete(Request $request){
        Blog::where('id',$request->data)->delete();

        $this->deleteBlogImages($request->data);
        
        return ['success' => true];
    }
    
    public function add(Request $request){
        
        try {
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
                "image" => $request->image,
            ];
    
    
            $id = Blog::create($data)->id;
    
            if($request->multiple_images){
                $this->deleteBlogImages($request->id);
            }
    
            foreach($request->multiple_images as $images){
                BlogImages::create([
                    "blog_id" => $id,
                    "file_name" => $images
                ]);
            }

            return [ 'success' => true, 'message' => 'Blog criado com sucesso!'];

        } catch (\Exception $e) {
            return [ 'success' => false, 'message' => 'Blog não criado, algo correu mal!'];
        }
    }

    public function editBlog(Request $request){

        try {
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
                "image" => $request->image,
            ];
    
            Blog::where('id',$request->id)->update($data);
            
            if($request->multiple_images){
                $this->deleteBlogImages($request->id);
            }
    
            foreach($request->multiple_images as $images){
                BlogImages::create([
                    "blog_id" => $request->id,
                    "file_name" => $images
                ]);
            }

            return [ 'success' => true, 'message' => 'Blog editado com sucesso!'];

        } catch (\Exception $e) {
            return [ 'success' => false, 'message' => 'Blog não editado, algo correu mal!'];
        }
    }

    function deleteBlogImages($blogid){
        $blogImage = BlogImages::where('blog_id',$blogid)->get();

        if(count($blogImage) > 0) {
            foreach($blogImage as $images){
                BlogImages::where('blog_id',$blogid)->delete();
            }
        }
    }
}