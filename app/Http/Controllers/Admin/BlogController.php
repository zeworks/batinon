<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index(){
        return view('admin.blog._index');
    }
    public function new(){
        return view('admin.blog._new');
    }
    public function edit($id){
        return view('admin.blog._edit', compact('id'));
    }
}
