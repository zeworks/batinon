<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Products;
use App\Pages;

class ProductsController extends Controller
{
    public function index(){
        $products = $this->fetchProducts();
        $banner = $this->getProductPageBanner();

        return view('front.products', compact('products','banner'));
    }

    /**
     * 
     * Function to get the product detail
     */
    public function getProduct($slug){
        $details = $this->validateSlug($slug);

        if($details === null) {
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

    /**
     * 
     * Function to fetch the products from the DB to display.
     */
    function fetchProducts(){
        $products = Products::where('status', 1)->get();

        return $products;
    }

    /**
     * 
     * Function to get the banner from the main page products.
     */
    function getProductPageBanner(){
        $productBanner = Pages::where('slug', 'produtos')->get();

        return $productBanner;
    }
}
