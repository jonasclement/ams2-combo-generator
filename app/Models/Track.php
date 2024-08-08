<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Track extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $primaryKey = 'name';

    public function tags(): HasMany
    {
        return $this->hasMany(TrackTag::class);
    }
}
