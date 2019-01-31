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
        $pages = Pages::get(['id','title','slug','status','created_at']);
        return $pages;
    }

    // GET PAGE (DISPLAY)
    public function get($id){
        $page = Pages::where('id',$id)->get();

        if (Helpers::ValidateExistent($page) > 0) {
            return [ 'success' => true, 'content' => $page];
        } else {
            return [ 'success' => false, 'message' => 'Esta página não existe!', 'redirect' => '/admin/pages'];
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
            ];
    
    
            Pages::create($data);

            return [ 'success' => true, 'message' => 'Página guardada com sucesso!' ];

        } catch (\Exception $e) {
            return [ 'success' => false, 'message' => 'Página não guardada, algo correu mal!'];
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
            ];
    
            $update = Pages::where('id',$request->id)->update($data);
    
            return ['success' => true, 'message' => 'Página editada com sucesso!'];

        } catch (\Exception $e) {
            return [ 'success' => false, 'message' => 'Página não editado, algo correu mal!'];
        }
    }

    public function delete(Request $request){
        Pages::where('id',$request->data)->delete();
        
        return ['success' => true, 'message' => 'Página eliminada com sucesso!'];
    }
}
