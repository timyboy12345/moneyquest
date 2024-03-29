<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'id', 'request_id', 'user_id', 'amount', 'mollie_payment_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
