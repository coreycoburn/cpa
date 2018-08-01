<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Propaganistas\LaravelPhone\PhoneNumber;

class Employee extends Model
{
    use Notifiable;

    protected $table = 'myMembers';

    public function scopeOfficeManagers($query)
    {
        $query
            ->where('id', 1)
            ->orWhere('id', 2)
            ->orWhere('id', 3)
            ->orWhere('id', 4);
    }

    public function routeNotificationForNexmo($notification)
    {
        return PhoneNumber::make($this->cell_phone, 'US')->formatE164();
    }
}
