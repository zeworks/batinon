<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banners extends Model
{
    protected $fillable = [
        'title','summary','image','status'
    ];  
}
