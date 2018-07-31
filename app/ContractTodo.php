<?php

namespace App;

use App\Confirmation;
use App\Event;
use App\Proposal;
use Illuminate\Database\Eloquent\Model;

class ContractTodo extends Model
{
    protected $fillable = [
        'comment',
        'completed'
    ];

    public function events()
    {
        return $this->belongsTo(Event::class);
    }

    public function confirmations()
    {
        return $this->belongsTo(Confirmation::class);
    }

     public function proposals()
    {
        return $this->belongsTo(Proposal::class);
    }
}
