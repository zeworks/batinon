<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Products;

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

    /**
     * 
     * Add Product to API
     */
    public function addAction(){

    }

    /**
     * 
     * Edit Product from API
     */
    public function editAction(){
        
    }

    /**
     * 
     * Delete Product from API
     */
    public function deleteAction(){
        
    }
}
