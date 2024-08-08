<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrackTag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['tag'];

    /** @return BelongsTo<Track, TrackTag> */
    public function track(): BelongsTo
    {
        return $this->belongsTo(Track::class);
    }
}
