<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Banners;


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

        if ($this->ValidateExistent($banner) > 0) {
            return [ 'success' => true, 'content' => $banner];
        } else {
            return [ 'success' => false, 'message' => 'Esta página não existe!', 'redirect' => '/admin/banners'];
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

            return ['success' => true, 'message' => 'Banner criado com sucesso!'];

        } catch (\Exception $e) {
            return [ 'success' => false, 'message' => 'Banner não criado, algo correu mal!'];
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
            
            return [ 'success' => true, 'message' => 'Banner editado com sucesso!'];

        } catch (\Exception $e) {
            return [ 'success' => false, 'message' => 'Banner não editado, algo correu mal!'];
        }
    }

    public function delete(Request $request){
        Banners::where('id',$request->data)->delete();
        
        return ['success' => true];
    }
    
    function ValidateExistent($banner_id){
        return count($banner_id);
    }
}
