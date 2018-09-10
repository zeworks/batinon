<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Files;

class FilesController extends Controller
{
    //
    public function index(){

        $files = Files::get();
        return $files;
    }

    public function add(){
        exit();
    }
}
