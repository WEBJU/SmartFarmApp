<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id', 'first_name','last_name','street_address','landmark','pincode','mobile','email'
    ];
}
