<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $fillable = ['id', 'user_id', 'amount', 'description', 'bank_iban', 'currency', 'comment', 'image'];

    public $incrementing = false;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function payments() {
        return $this->hasMany(Payment::class);
    }
}
