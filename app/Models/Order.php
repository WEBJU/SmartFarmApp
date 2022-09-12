<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'product_id','vendor_id','order_number','product_name','image','qty','price','variation','tax','shipping_cost','order_total','order_notes','payment_type','full_name','email','mobile','landmark','street_address','pincode'
    ];

    public function vendors(){
        return $this->hasOne('App\Models\User','id','vendor_id')->select('id','name','store_address',\DB::raw("CONCAT('".url('/storage/app/public/images/profile/')."/', profile_pic) AS image_url"));
    }
}
