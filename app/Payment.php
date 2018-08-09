<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Payment extends Model
{
    protected $fillable = ['amount'];

    protected $appends = ['formatted_payment_created'];

    public function getPaymentMadeInDollarsAttribute()
    {
        return number_format($this->amount / 100, 2);
    }

    public function getFormattedPaymentCreatedAttribute()
    {
        return Carbon::parse($this->created_at)->format('l, F j, Y');
    }
}
