<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Innersubcategory extends Model
{
    protected $fillable = [
        'cat_id','subcat_id','innersubcategory_name','status','slug'
    ];

    public function category(){
        return $this->hasOne('App\Models\Category','id','cat_id');
    }

    public function subcategory(){
        return $this->hasOne('App\Models\Subcategory','id','subcat_id');
    }
}
