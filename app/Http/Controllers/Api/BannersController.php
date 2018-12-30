<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Banners;


class BannersController extends Controller
{
    // INDEX
    public function index(){
        $banners = Banners::get();
        return $banners;
    }

    public function add(Request $request){
        
        if($request->status == ''){
            $status = 0;
        }else{
            $status = $request->status;
        }

        $data = [
            "title" => $request->title,
            "status" => $status,
            "summary" => $request->summary,
            "image" => $request->image,
        ];


        Banners::create($data);
        
        return ['success' => true];
    }

    // GET PAGE (DISPLAY)
    public function get($id){
        $banner = Banners::where('id',$id)->get();
        return $banner;
    }

    public function edit(Request $request){
        
        if($request->status == ''){
            $status = 0;
        }else{
            $status = $request->status;
        }

        $data = [
            "title" => $request->title,
            "status" => $status,
            "summary" => $request->summary,
            "image" => $request->image,
        ];

        Banners::where('id',$request->id)->update($data);
        
        return ['success' => true];
    }

    public function delete(Request $request){
        Banners::where('id',$request->data)->delete();
        
        return ['success' => true];
	}
}
