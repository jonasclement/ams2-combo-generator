<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarTag extends Model
{
    protected $fillable = ['tag'];

    /** @return BelongsTo<Car, CarTag> */
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}
