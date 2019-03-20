<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;
use App\Products;
use App\ProductImages;
use Helpers;

class ProductsController extends Controller
{
    /**
     * 
     * List Products from API
     */
    public function indexAction(){
        $data = Products::get();

        return $data;
    }

    public function getAction($id){
        $content = Products::where('id', $id)->get();
        $files = ProductImages::where('product_id', $id)->get();

        if (Helpers::ValidateExistent($content) > 0) {
            return [ 'success' => true, 'content' => $content, 'files' => $files];
        } else {
            return [ 'success' => false, 'message' => __('notifications.no_info'), 'redirect' => '/admin/products'];
        }
    }

    /**
     * 
     * Add Product to API
     */
    public function addAction(Request $request){
       
        try {

            $valid = Helpers::validateExistentSlug($request->product['slug'], "\\App\\Products");

            if(!count($valid)) {

                $getProductId = Products::create($request->product)->id;

                if (is_array($request->productImages)) {
                    // create images
                    foreach($request->productImages as $images){
                        ProductImages::create([
                            "product_id" => $getProductId,
                            "file_name" => $images
                        ]);
                    }
                }
                
                return [ 'success' => true, 'message' => __('notifications.add_success') ];
            } else {
                // existe
                return [ 'success' => false, 'message' => __('notifications.slug_exist')];
                die;
            }
        } catch (\Throwable $th) {
            // validation to title and image, the only required
            if (!isset($request->product['title']) || !isset($request->product['image']) || !isset($request->product['category'])) {
                return [ 'success' => false, 'message' => __('notifications.error_fields') ];
            }

            return [ 'success' => false, 'message' => __('notifications.error_info')];            
        }
    }

    /**
     * 
     * Edit Product from API
     */
    public function editAction(Request $request, $id){
        try {
            Products::where('id', $id)->update($request->product);

            if (is_array($request->productImages)) {
                // delete previous images
                $this->deleteImages($id);
                // add old/new images
                foreach($request->productImages as $images){
                    ProductImages::create([
                        "product_id" => $id,
                        "file_name" => $images
                    ]);
                }
            }

            if (is_array($request->colors)) {
                $product = Products::find($id);

                if($product) {
                    $colors = array();
                    foreach($request->colors as $item){
                        $colors[] = $item;
                    }
                    $product->colors = json_encode($colors);
                    $product->save();
                }
                
            }

    
            return ['success' => true, 'message' => __('notifications.edit_success')];

        } catch (\Exception $e) {

            // validation to title and image, the only required
            if (!isset($request->product['title']) || !isset($request->product['image']) || !isset($request->product['category'])) {
                return [ 'success' => false, 'message' => __('notifications.error_fields') ];
            }
            
            return [ 'success' => false, 'message' => __('notifications.error_info')];
        }
    }

    /**
     * 
     * Delete Product from API
     */
    public function deleteAction($id){
        Products::where('id', $id)->delete();

        $this->deleteImages($id);
        
        return ['success' => true, 'message' => __('notifications.remove_success')];
    }

    /**
     * 
     * Delete Product Images
     */
    function deleteImages($id){
        $productImage = ProductImages::where('product_id', $id)->get();

        if(count($productImage) > 0) {
            foreach($productImage as $images){
                ProductImages::where('product_id', $id)->delete();
            }
        }
    }
}
