<?php

namespace App\Models;

use App\Models\TaggableInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model implements TaggableInterface
{
    public $incrementing = false;

    protected $primaryKey = 'name';

    /** @return HasMany<CarTag> */
    public function tags(): HasMany
    {
        return $this->hasMany(CarTag::class);
    }
}
