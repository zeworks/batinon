<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Products;
use App\Pages;
use Helpers;

class ProductsController extends Controller
{
    public function index(){
        $data = $this->getProductData();

        if(Helpers::validateActivePage($data['product'][0])) {
            return view("front.products", compact('data'));
        } else {
            return redirect('404');
        }
    }

    /**
     * 
     * Function to get the product detail
     */
    public function getProduct($slug){
        $details = $this->validateSlug($slug);

        if($details === null || $details[0]->status === 0) {
            return redirect('404');
        } else {
            return view('front.productDetail', compact('details'));
        }
    }

    /**
     * 
     * Function to validate the slug on the url
     */
    function validateSlug($slug){
        
        $details = Products::where('slug', $slug)->with('Files')->get();

        if(count($details) > 0){
            return $details;
        } else {
            return null;            
        }
    }

    function getProductData(){
        $products = Products::where('status', 1)->get();
        $productBanner = Pages::where('slug', 'produtos')->get();

        return [
            'products' => $products,
            'product' => $productBanner
        ];
    }
}
