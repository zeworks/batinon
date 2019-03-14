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
