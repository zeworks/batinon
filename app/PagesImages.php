<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Files;

class PagesImages extends Model
{
    protected $fillable = ['page_id','file_name'];
    
    public function Files(){
        return $this->belongsTo('App\Files', 'file_name', 'id');
    }
}
