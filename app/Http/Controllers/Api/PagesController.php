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
            $status = 1;
        }

        $data = [
            "title" => $request->title,
            "slug" => $request->slug,
            "status" => $status,
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
            $status = 1;
        }

        $data = [
            "title" => $request->title,
            "slug" => $request->slug,
            "status" => $status,
        ];

        Pages::where('id',$request->id)->update($data);
        return ['success' => true];
    }

    public function delete(Request $request){
        Pages::where('id',$request->data)->delete();
        
        return ['success' => true];
	}
}
