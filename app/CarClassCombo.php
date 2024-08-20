<?php

declare(strict_types=1);

namespace App;

use App\Models\Car;
use App\Models\Track;

class CarClassCombo
{
    public function __construct(
        public readonly Car $car,
        public readonly Track $track
    ) {}
}
