<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    protected $fillable = [
        'request_id', 'vendor_id', 'amount', 'commission_pr', 'commission', 'status', 'payment_method','paid_amount', 'paid_at'
    ];

    public function vendors(){
        return $this->hasOne('App\Models\User','id','vendor_id')->select('id','name');
    }
    public function bank(){
        return $this->hasOne('App\Models\Bank','vendor_id','vendor_id');
    }
}
