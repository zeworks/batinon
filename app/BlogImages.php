<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Files;

class BlogImages extends Model
{
    protected $fillable = ['blog_id','file_name'];
    
    public function Files(){
        return $this->belongsTo('App\Files', 'file_name', 'id');
    }
}
