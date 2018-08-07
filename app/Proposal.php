<?php

namespace App;

use App\ContractTodo;
use App\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Proposal extends Model
{
    const CREATED_AT = 'submitted';
    const UPDATED_AT = 'update_time';

    protected $fillable = [

    ];

    public function getFormattedEventDateAttribute()
    {
        return Carbon::parse($this->event_date)->format('l, F j, Y');
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
