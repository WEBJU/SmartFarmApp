<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable = [
        'firebase_key', 'currency', 'currency_position', 'logo', 'timezone', 'min_balance', 'admin_commission','copyright','address','contact','email','site_title','meta_title','meta_description','og_image'
    ];
}
