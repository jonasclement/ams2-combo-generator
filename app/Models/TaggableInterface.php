<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

interface TaggableInterface
{
    // @phpstan-ignore missingType.generics
    public function tags(): HasMany;
}
