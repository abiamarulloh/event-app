<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'start_date',
        'end_date',
        'description',
        'category_id',
        'user_id',
        'status',
        'draft_at',
        'published_at',
        'closed_at',

        'location',
        'price',
        'quota',
        'poster_image',
        'link_registration',
        'terms_and_conditions',
        'speaker',
        'agenda',
        'image',
        'unique_code',
        'additional_fee_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function boot()
    {
        parent::boot();

        static::updating(function ($event) {
            if ($event->isDirty('status')) {
                switch ($event->status) {
                    case 'draft':
                        $event->draft_at = now();
                        break;
                    case 'published':
                        $event->published_at = now();
                        break;
                    case 'closed':
                        $event->closed_at = now();
                        break;
                }
            }
        });

        static::creating(function ($event) {
            $event->slug = createSlug($event->title, get_class($event));
        });

        static::updating(function ($event) {
            if ($event->isDirty('title')) {
                $event->slug = createSlug($event->title, get_class($event));
            }
        });

        static::creating(function ($event) {
            if (empty(trim($event->unique_code))) {
                $event->unique_code = self::generateUniqueCode();
            }
        });

        static::updating(function ($event) {
            if (empty(trim($event->unique_code))) {
                $event->unique_code = self::generateUniqueCode();
            }
        });
    }

    public static function generateUniqueCode()
    {
        $code = strtoupper(Str::random(6));

        // Ensure the code is unique
        while (self::where('unique_code', $code)->exists()) {
            $code = strtoupper(Str::random(6));
        }

        return $code;
    }

    // Relasi dengan EventRequest
    public function eventRequests()
    {
        return $this->hasMany(EventRequest::class);
    }

     // Relasi dengan AdditionalFee
     public function additionalFee()
     {
         return $this->belongsTo(AdditionalFee::class);
     }
}
