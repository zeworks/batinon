<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pages;

class PagesController extends Controller
{
    // INDEX
    public function index(){
        $pages = Pages::get();
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
        ];


        Pages::create($data);
        
        return ['success' => true];
    }

    // EDIT PAGE (DISPLAY)
    public function edit($id){
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
        ];

        Pages::where('id',$request->id)->update($data);
        
        return ['success' => true];
    }

    public function delete(Request $request){
        Pages::where('id',$request->data)->delete();
        
        return ['success' => true];
	}
}
