<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = [
        'vendor_id', 'bank_name', 'account_type', 'account_number', 'routing_number'
    ];
}
