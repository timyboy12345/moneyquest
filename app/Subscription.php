<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = ['id', 'user_id', 'request_id', 'mollie_subscription_id', 'interval', 'payments', 'amount', 'state'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
