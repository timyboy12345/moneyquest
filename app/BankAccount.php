<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    public function canDelete()
    {
        if (Request::where('bank_iban', $this->iban)->count() > 0)
            return false;

        return true;
    }
}
