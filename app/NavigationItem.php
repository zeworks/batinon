<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NavigationItem extends Model
{
    protected $fillable = [
        'title','slug','parent_id'
    ];
}
