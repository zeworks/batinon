<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Banners;
use Helpers;


class BannersController extends Controller
{
    // INDEX
    public function index(){
        $banners = Banners::get();
        
        return $banners;
    }

    // GET PAGE (DISPLAY)
    public function get($id){
        $banner = Banners::where('id',$id)->get();

        if (Helpers::ValidateExistent($banner) > 0) {
            return [ 'success' => true, 'content' => $banner];
        } else {
            return [ 'success' => false, 'message' => __('notifications.no_info'), 'redirect' => '/admin/banners'];
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
                "status" => $status,
                "summary" => $request->summary,
                "image" => $request->image,
            ];
    
            Banners::create($data);

            return ['success' => true, 'message' => __('notifications.add_success')];

        } catch (\Exception $e) {
            return [ 'success' => false, 'message' => __('notifications.edit_error')];
        }
    }

    public function edit(Request $request){

        try {

            if($request->status == ''){
                $status = 0;
            }else{
                $status = $request->status;
            }
    
            $data = [
                "title" => $request->title,
                "status" => $status,
                "summary" => $request->summary,
                "image" => $request->image,
            ];
    
            Banners::where('id',$request->id)->update($data);
            
            return [ 'success' => true, 'message' => __('notifications.edit_success')];

        } catch (\Exception $e) {
            return [ 'success' => false, 'message' => __('notifications.edit_error')];
        }
    }

    public function delete(Request $request){
        Banners::where('id',$request->id)->delete();
        
        return ['success' => true, 'message' => __('notifications.remove_success')];
    }
}
