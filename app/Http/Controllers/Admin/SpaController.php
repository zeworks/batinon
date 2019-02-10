<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpaController extends Controller
{
    public function index()
    {
        return view('layouts.app', ['user' => \Auth::user()->id]);
    }
}
