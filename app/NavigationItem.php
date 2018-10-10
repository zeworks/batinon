<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NavigationItem extends Model
{
    protected $fillable = [
        'name','url','parent_id'
    ];
}
