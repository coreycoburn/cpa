<?php

namespace App;

use App\ContractTodo;
use App\Employee;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    const CREATED_AT = 'submitted';
    const UPDATED_AT = 'update_time';

    protected $fillable = [

    ];

    public function userQuestion()
    {
        return $this->belongsTo(Employee::class, 'questions');
    }

    public function todos()
    {
        return $this->hasMany(ContractTodo::class);
    }
}
