<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalFee extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'additional_fees';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'name',
        'fee',
    ];

    /**
     * Get the formatted fee.
     *
     * @return string
     */
    public function getFormattedFeeAttribute()
    {
        return number_format($this->fee, 2);
    }
}
