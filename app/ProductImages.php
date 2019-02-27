<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Files;

class ProductImages extends Model
{
    protected $fillable = ['product_id','file_name'];
    
    public function Files(){
        return $this->belongsTo('App\Files', 'file_name', 'id');
    }
}

