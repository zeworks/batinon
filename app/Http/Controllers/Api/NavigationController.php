<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Navigation;
use App\NavigationItem;

class NavigationController extends Controller
{
    /**
     * 
     * Index Function to display navigation menu's to the BO
     */
    public function indexAction(){
        $requestNavigation = Navigation::get();
        $requestNavigationItems = NavigationItem::get();

        return ['navigations' => $requestNavigation, 'navigationItems' => $requestNavigationItems];
    }

    /**
     * Add Function
     * @var {$request}
     */
    public function addAction(Request $request){

        try {
            foreach ($request->items as $key => $value) {

                $data = [
                    "title" => $request->items[$key]['title'],
                    "slug"  => $request->items[$key]['slug'],
                    "parent_id" => $request->menu
                ];
                
                $requestCreateApi = NavigationItem::create($data);
            }
    
            if($requestCreateApi) {
                return ['success' => true, 'message' => __('notifications.add_success') ];
            } else {
                return ['success' => false, 'message' => __('notifications.add_error') ];
            }
        } catch (\Throwable $th) {
            return ['success' => false, 'message' => __('notifications.error_info') ];
        }
        
    }

    public function getAction($id){
        $requestNavigation = Navigation::where('id',$id)->get();
        $requestNavigationItems = NavigationItem::where('parent_id',$id)->get();

        if(!count($requestNavigationItems) > 1) {
            $requestNavigationItems = NavigationItem::get();
        }
        
        return ['navigations' => $requestNavigation, 'navigationItems' => $requestNavigationItems];
    }

    public function editAction(Request $request){

        if (isset($request->status) && count($request->status) > 1) {
            foreach ($request->status as $key => $status) {
    
                $data = [
                    "status" => $status['status'],
                ];
                
                $requestEditApi = Navigation::where('id', $status['id'])->update($data);
            }
        } else {
            NavigationItem::where('parent_id', $request->menu)->delete();
    
            foreach ($request->items as $key => $value) {
    
                $data = [
                    "title" => $request->items[$key]['title'],
                    "slug"  => $request->items[$key]['slug'],
                    "parent_id" => $request->menu
                ];
                
                $requestEditApi = NavigationItem::create($data);
            }
    
            return ['success' => true, 'message' => __('notifications.edit_success') ];
        }
            
    }

}
