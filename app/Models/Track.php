<?php

namespace App\Models;

use App\Models\TaggableInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Track extends Model implements TaggableInterface
{
    public $incrementing = false;

    protected $primaryKey = 'name';

    /** @return HasMany<TrackTag> */
    public function tags(): HasMany
    {
        return $this->hasMany(TrackTag::class);
    }
}
