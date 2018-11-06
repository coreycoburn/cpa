<?php

namespace App;

use App\ContractTodo;
use App\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Propaganistas\LaravelPhone\PhoneNumber;

class Event extends Model
{
    const CREATED_AT = 'submitted';
    const UPDATED_AT = 'update_time';

    protected $table = 'clients';

    protected $guarded = [];

    // protected $fillable = [
    //     'social_title',
    //     'fname',
    //     'lname',
    //     'company',
    //     'phone',
    //     'phone_ext',
    //     'fax',
    //     'email',
    //     'contact_address',
    //     'contact_city',
    //     'contact_state',
    //     'contact_zip',
    //     'service_valet',
    //     'service_direction',
    //     'service_shuttle',
    //     'service_coordination',
    //     'event_type',
    //     'location_type',
    //     'location_name',
    //     'event_date',
    //     'start',
    //     'start_advertised',
    //     'end',
    //     'guests',
    //     'cars',
    //     'event_address',
    //     'event_city',
    //     'event_state',
    //     'event_zip',
    //     'annual_event',
    //     'contact_method',
    //     'referral',
    //     'client_message'
    // ];

    public function getPhoneAttribute()
    {
        return PhoneNumber::make($value, 'US')->formatForCountry('US');
    }

    public function getDepositDueInDollarsAttribute()
    {
        return ($this->deposit_due / 100);
    }

    public function getEstimatedTotalInDollarsAttribute()
    {
        return ($this->estimated_total / 100);
    }

    public function getFormattedDepositDueDateAttribute()
    {
        return Carbon::parse($this->deposit_due_date)->format('l, F j, Y');
    }

    public function getDepositDueForHumansAttribute()
    {
        return Carbon::parse($this->deposit_due_date)->diffForHumans();
    }

    public function userQuestion()
    {
        return $this->belongsTo(Employee::class, 'questions');
    }

    public function todos()
    {
        return $this->hasMany(ContractTodo::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
