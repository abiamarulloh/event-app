<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $casts = [
        'additional_fee' => 'array', // Mengonversi kolom JSON ke array
        'donation' => 'array', // Mengonversi kolom JSON ke array
        'sponsor' => 'array', // Mengonversi kolom JSON ke array
    ];

    protected $fillable = ['user_id', 'event_organizer_id', 'event_id', 'quantity', 'total_price', 'unique_order_id', 'additional_fee', 'donation', 'sponsor'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event_organizer()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function latestTransaction()
    {
        return $this->hasOne(Transaction::class)->latestOfMany();
    }

}
