<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'status',
        'b_title',
        'b_summary',
        'b_description',
        'image',
        'b_image',
        'order',
        'position'
    ];  
}
