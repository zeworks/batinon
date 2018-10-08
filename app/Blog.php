<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'b_title','slug','status','b_summary','b_description','b_image','image'
    ];  
}
