<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ratting extends Model
{
    protected $fillable = [
        'product_id', 'vendor_id', 'user_id', 'ratting', 'comment'
    ];

    public function users(){
        return $this->hasOne('App\Models\User','id','user_id')->select('id','name',\DB::raw("CONCAT('".url('/storage/app/public/images/profile/')."/', profile_pic) AS image_url"));
    }
}