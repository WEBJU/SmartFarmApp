<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    protected $fillable = [
        'coupon_name', 'type', 'percentage', 'amount', 'quantity', 'times', 'start_date', 'end_date', 'status'
    ];
}
