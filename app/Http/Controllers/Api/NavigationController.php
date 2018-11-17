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
            "title" => $request->menu_title,
        ];

        $nav = Navigation::create($navigation)->id;

        foreach ($request->navigation_item as $key => $value) {
          $navigationItem = [
              "name" => $request->navigation_item[$key]['title'],
              "url"  => $request->navigation_item[$key]['slug'],
              "parent_id" => $nav
          ];
          $navItem = NavigationItem::create($navigationItem);
        }

        return ['success' => true, 'returnId' => $nav];
    }

    public function get($id){
        $navigations = Navigation::where('id',$id)->get();
        $navigationItems = NavigationItem::where('parent_id',$id)->get();
        return ['navigations' => $navigations, 'navigationItems' => $navigationItems];
    }

    public function delete(Request $request){

        NavigationItem::where('parent_id', $request->data)->delete();

        Navigation::where('id',$request->data)->delete();

        return ['success' => true];
	}
}
