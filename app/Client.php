<?php

namespace App;

use Propaganistas\LaravelPhone\PhoneNumber;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function getPhoneAttribute($value)
    {
        return PhoneNumber::make($value, 'US')->formatForCountry('US');
    }
}
