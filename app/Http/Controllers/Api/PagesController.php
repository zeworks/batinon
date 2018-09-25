<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pages;
use App\Blocks;

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

        $block = [
            "title" => $request->block_title,
            "summary" => $request->block_summary,
            "description" => $request->block_description,
            "page_id" => $request->id,
        ];

        Pages::where('id',$request->id)->update($data);
        
        // validar se ja existem blocos
        $validation = Blocks::where('page_id',$request->id)->get();
        
        if($validation -> isEmpty()){
            // se nao existir
            Blocks::create($block);
        }else{
            // se existir
            Blocks::where('page_id',$request->id)->update($block);
        }
        
        return ['success' => true];
    }

    public function delete(Request $request){
        Pages::where('id',$request->data)->delete();
        
        return ['success' => true];
	}
}
