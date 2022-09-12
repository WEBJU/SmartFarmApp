<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = [
        'cat_id', 'subcategory_name','status','slug'
    ];

    public function category(){
        return $this->hasOne('App\Models\Category','id','cat_id');
    }
    
}
