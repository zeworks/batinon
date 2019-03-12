<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Navigation;

class NavigationController extends Controller
{
    /**
     * 
     * Index Function to display navigation menu's to the BO
     */
    public function indexAction(){
        $requestNavigation = Navigation::get();

        return ['navigations' => $requestNavigation];
    }

    public function editAction(Request $request){

        if (isset($request->status) && count($request->status) > 1) {
            foreach ($request->status as $key => $status) {
    
                $data = [
                    "status" => $status['status'],
                ];
                
                $requestEditApi = Navigation::where('id', $status['id'])->update($data);
            }
        }
            
    }
}
