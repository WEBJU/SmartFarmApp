<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id', 'order_id','order_number','wallet','payment_id','transaction_type','username','type'
    ];
}
