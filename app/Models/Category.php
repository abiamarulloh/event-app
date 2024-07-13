<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'color',
        'description',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->slug = createSlug($category->name, get_class($category));
        });

        static::updating(function ($category) {
            if ($category->isDirty('name')) {
                $category->slug = createSlug($category->name, get_class($category));
            }
        });
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
