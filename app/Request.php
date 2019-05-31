<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $fillable = ['id', 'user_id', 'amount', 'description', 'bank_iban'];

    public $incrementing = false;

    public function user() {
        return $this->belongsTo(User::class);
    }
}
