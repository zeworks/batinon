<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProductImages;
use App\Files;

class Products extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category',
        'description',
        'details',
        'status',
        'hightlight', // significa se é novo ou nao
        'image',
        'reference',
        'product_weight',
        'product_size',
        'colors'
    ];
    
    public function Files(){
        return $this->hasMany('App\ProductImages','product_id','id');
    }
}
