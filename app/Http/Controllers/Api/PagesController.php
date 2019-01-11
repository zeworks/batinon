<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pages;
use App\Files;

class PagesController extends Controller
{
    // INDEX
    public function index(){
        $pages = Pages::get(['id','title','slug','status','created_at']);
        return $pages;
    }

    public function add(Request $request){
        
        if($request->status == ''){
            $status = 0;
        }else{
            $status = $request->status;
        }

        $data = [
            "title" => $request->title,
            "slug" => $request->slug,
            "status" => $status,
            "b_title" => $request->b_title,
            "b_summary" => $request->b_summary,
            "b_description" => $request->b_description,
            "b_image" => $request->b_image,
            "image" => $request->image,
        ];


        Pages::create($data);
        
        return ['success' => true];
    }

    // GET PAGE (DISPLAY)
    public function get($id){
        $page = Pages::where('id',$id)->get();
        return $page;
    }

    public function editPage(Request $request){
        
        if($request->status == ''){
            $status = 0;
        }else{
            $status = $request->status;
        }

        $data = [
            "title" => $request->title,
            "slug" => $request->slug,
            "status" => $status,
            "b_title" => $request->b_title,
            "b_summary" => $request->b_summary,
            "b_description" => $request->b_description,
            "b_image" => $request->b_image,
            "image" => $request->image,
        ];

        Pages::where('id',$request->id)->update($data);
        
        return ['success' => true];
    }

    public function delete(Request $request){
        Pages::where('id',$request->data)->delete();
        
        return ['success' => true];
	}
}
