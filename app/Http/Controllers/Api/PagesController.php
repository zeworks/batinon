<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pages;
use App\Files;
use Helpers;

class PagesController extends Controller
{
    // INDEX
    public function index(){
        $pages = Pages::get(['id','title','slug','order','status','created_at']);

        return $pages;
    }

    // GET PAGE (DISPLAY)
    public function get($id){
        $page = Pages::where('id',$id)->get();

        if (Helpers::ValidateExistent($page) > 0) {
            return [ 'success' => true, 'content' => $page];
        } else {
            return [ 'success' => false, 'message' => __('notifications.no_info'), 'redirect' => '/admin/pages'];
        }
    }

    public function add(Request $request){

        try {

            if($request->status == ''){
                $status = 0;
            }else{
                $status = $request->status;
            }
    
            $data = [
                "title" => $request->title,
                "slug" => $request->slug,
                "status" => $status,
                "b_title" => $request->b_title,
                "b_summary" => $request->b_summary,
                "b_description" => $request->b_description,
                "b_image" => $request->b_image,
                "image" => $request->image,
                "order" => $request->order,
                "position" => $request->position,
            ];
    
            Pages::create($data);

            return [ 'success' => true, 'message' => __('notifications.add_success') ];

        } catch (\Exception $e) {
            return [ 'success' => false, 'message' => __('notifications.error_info')];
        }
    }

    public function editPage(Request $request){

        try {

            if($request->status == ''){
                $status = 0;
            }else{
                $status = $request->status;
            }
    
            $data = [
                "title" => $request->title,
                "slug" => $request->slug,
                "status" => $status,
                "b_title" => $request->b_title,
                "b_summary" => $request->b_summary,
                "b_description" => $request->b_description,
                "b_image" => $request->b_image,
                "image" => $request->image,
                "order" => $request->order,
                "position" => $request->position,
            ];
    
            $update = Pages::where('id',$request->id)->update($data);
    
            return ['success' => true, 'message' => __('notifications.edit_success')];

        } catch (\Exception $e) {
            return [ 'success' => false, 'message' => __('notifications.error_info')];
        }
    }

    public function delete(Request $request){
        Pages::where('id',$request->id)->delete();
        
        return ['success' => true, 'message' => __('notifications.remove_success')];
    }
}
