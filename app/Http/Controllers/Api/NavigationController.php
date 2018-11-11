<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Navigation;
use App\NavigationItem;

class NavigationController extends Controller
{

    public function index(){
        $navigations = Navigation::get();
        $navigationItems = NavigationItem::get();
        return ['navigations' => $navigations, 'navigationItems' => $navigationItems];
    }

    public function add(Request $request){
        
        $navigation = [
            "title" => $request->title,
        ];

        $nav = Navigation::create($navigation)->id;
        
        $navigationItem = [
            "name" => $request->name,
            "url"  => $request->url,
            "parent_id" => $nav
        ];
        
        $navItem = NavigationItem::create($navigationItem);

        return ['success' => true, 'returnId' => $nav];
    }
    
    public function delete(Request $request){

        NavigationItem::where('parent_id', $request->data)->delete();
        
        Navigation::where('id',$request->data)->delete();
        
        return ['success' => true];
	}
}
