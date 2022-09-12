<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    protected $fillable = [
        'product_id','price','discounted_variation_price','variation','qty'
    ];
}
