<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_organizer_id', 
        'account_number', 
        'bank_name', 
        'account_holder_name'
    ];

    public function eventOrganizer()
    {
        return $this->belongsTo(User::class);
    }
}
