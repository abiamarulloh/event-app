<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRequest extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'event_id', 'order_id', 'status'];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
