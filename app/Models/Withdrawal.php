<?php 


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    protected $fillable = ['event_organizer_id', 'bank_account_id', 'amount', 'status', 'reason'];

    public function eventOrganizer()
    {
        return $this->belongsTo(User::class, 'event_organizer_id');
    }

    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class, 'bank_account_id');
    }
}
