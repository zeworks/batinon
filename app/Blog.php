<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BlogImages;

class Blog extends Model
{
    protected $fillable = [
        'b_title','slug','status','b_summary','b_description','image'
    ];  

    public function Files(){
        return $this->hasMany('App\BlogImages','blog_id','id');
    }
}
