<?php

namespace App;

use App\ContractTodo;
use Illuminate\Database\Eloquent\Model;
use Propaganistas\LaravelPhone\PhoneNumber;

class Event extends Model
{
    const CREATED_AT = 'submitted';
    const UPDATED_AT = 'update_time';

    protected $table = 'clients';

    protected $fillable = [
        'social_title',
        'fname',
        'lname',
        'company',
        'phone',
        'phone_ext',
        'fax',
        'email',
        'contact_address',
        'contact_city',
        'contact_state',
        'contact_zip',
        'service_valet',
        'service_direction',
        'service_shuttle',
        'service_coordination',
        'event_type',
        'location_type',
        'location_name',
        'event_date',
        'start',
        'start_advertised',
        'end',
        'guests',
        'cars',
        'event_address',
        'event_city',
        'event_state',
        'event_zip',
        'annual_event',
        'contact_method',
        'referral',
        'client_message'
    ];

    public function getPhoneAttribute($value)
    {
        return PhoneNumber::make($value, 'US')->formatForCountry('US');
    }

    public function userQuestion()
    {
        return $this->belongsTo(Employee::class, 'questions');
    }

    public function todos()
    {
        return $this->hasMany(ContractTodo::class);
    }
}
