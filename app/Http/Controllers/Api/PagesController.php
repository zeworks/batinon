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
    // EDIT PAGE (DISPLAY)
    public function edit($id){
        $page = Pages::where('id',$id)->get();
        return $page;
    }

    public function editPage(Request $request){
        
        $data = [
            "name" => $request->input('title'),
            "status" => $request->input('status')
        ];

        Pages::where('id',$request->id)->update($data);
        return ['success' => true];
    }
}
