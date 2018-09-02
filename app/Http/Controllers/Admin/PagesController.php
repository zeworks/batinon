<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pages;

class PagesController extends Controller
{
    public function index(){
        return view('admin.pages._index');
    }
    public function new(){
        return view('admin.pages._new');
    }
    public function edit($id){
        return view('admin.pages._edit', compact('id'));
    }
    public function update($id){
        // return redirect()->back()->with(["message" => "Updated with success!", "type" => "success"]);
    }
}
