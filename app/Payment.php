<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Payment extends Model
{
    protected $fillable = ['amount'];

    protected $appends = ['formatted_payment_created', 'payment_made_in_dollars'];

    public function getPaymentMadeInDollarsFormattedAttribute()
    {
        return number_format($this->amount / 100, 2);
    }

    public function getPaymentMadeInDollarsAttribute()
    {
        return ($this->amount / 100);
    }

    public function getFormattedPaymentCreatedAttribute()
    {
        return Carbon::parse($this->created_at)->format('l, F j, Y');
    }
}
