<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id', 'order_id', 'order_number', 'return_number', 'order_status', 'message', 'is_read', 'type'
    ];
}
