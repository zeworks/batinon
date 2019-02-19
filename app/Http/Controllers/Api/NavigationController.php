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
        foreach ($request->items as $key => $value) {
          $menuItems = [
              "title" => $request->items[$key]['title'],
              "slug"  => $request->items[$key]['slug'],
              "parent_id" => $request->menu
          ];
          $navItem = NavigationItem::create($menuItems);
        }
        return ['success' => true];
    }

    public function get($id){
        $navigations = Navigation::where('id',$id)->get();
        $navigationItems = NavigationItem::where('parent_id',$id)->get();

        if(!count($navigationItems) > 1) {
            $navigationItems = NavigationItem::get();
        }
        
        return ['navigations' => $navigations, 'navigationItems' => $navigationItems];
    }

    public function edit(Request $request){
        foreach ($request->items as $key => $value) {
            $menuItems = [
                "title" => $request->items[$key]['title'],
                "slug"  => $request->items[$key]['slug'],
            ];

          $navItem = NavigationItem::where('parent_id',$request->menu)->update($menuItems);
        }

        return ['success' => true];
    }

    public function delete(Request $request){

        NavigationItem::where('parent_id', $request->data)->delete();

        Navigation::where('id',$request->data)->delete();

        return ['success' => true];
	}
}
